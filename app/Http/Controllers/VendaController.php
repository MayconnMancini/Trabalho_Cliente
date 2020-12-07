<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
date_default_timezone_set('AMERICA/CUIABA');

class VendaController extends Controller
{
    

    private function calcularVenda(Venda $venda) {

        $itens = $venda->produtos;
        $venda->valorTotal = $venda->calcularTotal($itens);
        $venda->save();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = Venda::all();
        return view('vendas.index', compact('vendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        return view('vendas.create', compact(['produtos','clientes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [ 'nomeVendedor' => [
                'required',
                'min:2'
            ],
             'quantidade' => [
                'required'
             ],
            
            ],

            [ 
                'nomeVendedor.require' =>'Preencha o nome do Vendedor',
                'nomeVendedor.min' => 'O nome nao tem mais que um caractere',
            ],
            [
                'quantidade.require' =>'Campo preco não preenchido',
            ],
           
        );

        /*  
            Entra nesse bloco na primeira vez em que a tela de nova venda for chamada.
            Se o usuário clicar em salvar venda e não tiver nenhum
            produto associado à venda.
        */
        if (isset($_POST['btn-finalizar-venda'])) {

            return redirect()->route('vendas.create')->with('msg_error', 'Nenhum produto selecionado');

        }
        // Caso ele tenha clicado no botão "Adcionar ao carrinho"
        else if (isset($_POST['btn-adcionar-item'])) {

            //Irá gerar uma nova venda e salvar no bd
            $venda = new Venda();
            $venda->data = date("d/m/y H:i:s");
            $venda->nomeVendedor = $request->nomeVendedor;
            $venda->valorTotal = $request->valorTotal;
            $venda->cliente_id = $request->cliente;
            $venda->save();

            $id = $venda->id; // retorna o id da venda

            $id_produto = $request->produto;
            $quantidade = $request->quantidade;

            // adiciona o produto na tabela produto_venda
            $venda->produtos()->attach([$id_produto => ['quantidade' => $quantidade]]); 
            // calcula o valor total da venda
            $this->calcularVenda($venda);
            
            // redireciona para view de edit para o usuário continuar adicionando mais itens
            return redirect()->route('vendas.edit', $id)->with('msg_success', 'Item adcionado');
        }
    }


    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show(Venda $venda)
    {
        $itens = $venda->produtos;
        
        return view('vendas.show', compact(['venda','itens']) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        $itens = $venda->produtos;
        
        return view('vendas.edit', compact(['venda','clientes','produtos','itens']) );   
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        $request->validate(
            [ 'nomeVendedor' => [
                'required',
                'min:2'
            ],
             'quantidade' => [
                'required'
             ],
            
            ],

            [ 
                'nomeVendedor.require' =>'Preencha o nome do Vendedor',
                'nomeVendedor.min' => 'O nome nao tem mais que um caractere',
            ],
            [
                'quantidade.require' =>'Campo preco não preenchido',
            ],
           
        );


        if (isset($_POST['btn-finalizar-venda'])) {
            
            $venda->data = date("d/m/y H:i:s");
            $venda->nomeVendedor = $request->nomeVendedor;
            $venda->valorTotal = $request->valorTotal;
            $venda->cliente_id = $request->cliente;
            $venda->save();

            $this->calcularVenda($venda);

            return redirect()->route('vendas.index')->with('msg_success', 'Venda Salva com sucesso');
        }

        // entra nesse bloco se foi clicado o botão de adicionar item
        $venda->data = date("d/m/y H:i:s");
        $venda->nomeVendedor = $request->nomeVendedor;
        $venda->valorTotal = $request->valorTotal;
        $venda->cliente_id = $request->cliente;
        $venda->save();

        $id = $venda->id; // retorna o id da venda

        $id_produto = $request->produto;
        $quantidade = $request->quantidade;

        // adiciona o produto na tabela produto_venda

        try {

            $venda->produtos()->attach([$id_produto => ['quantidade' => $quantidade]]);
            $this->calcularVenda($venda);  
            return redirect()->route('vendas.edit', $id)->with('msg_success', 'Item adcionado');

        } catch (\Exception $e) {

            return redirect()->route('vendas.edit', $id)
            ->with('msg_error', 'E R R O !! Este item ja foi adicionado ao carrinho: -  ' . $e->getMessage());
        }

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {   
     
        $venda->delete();   
        
        return redirect()->route('vendas.index')   
        ->with('msg_success', 'Venda removido com sucesso.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    // essa função é responsavel por apagar um produto da lista
    // de produtos da venda. (Apaga um item da venda)
    public function deleteItens(Venda $venda, Produto $produto)
    {   
        
        $venda->produtos()->detach($produto->id);

        $this->calcularVenda($venda);  

        return redirect()->route('vendas.edit', $venda->id)
            ->with('msg_success', 'Item removido com sucesso.');
    }
}
