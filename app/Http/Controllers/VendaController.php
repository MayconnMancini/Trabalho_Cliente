<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

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
        /*$request->validate(
            [ 'nome' => [
                'required',
                'min:2'
                ],
             'cpf' => [
                'required', 
                'min:2',
                'unique:clientes'
                ]
            ],

            [ 
                'nome.require' =>'Preencha o nome do Cliente',
                'nome.min' => 'O nome nao tem mais que um caractere',
          
                'cpf.require' =>'Campo CPF não preenchido',
                'cpf.min' => 'Numero de caracteres Invalidos',
                'cpf.unique'=>'cpf cadastrado',
            ]

        ); */
        if (isset($_POST['btn-finalizar-venda'])) {

            return redirect()->route('vendas.create')->with('msg_error', 'Nenhum produto selecionado');

        }
        else if (isset($_POST['btn-adcionar-item'])) {

            $venda = new Venda();
            $venda->data = date(now());
            $venda->nomeVendedor = $request->nomeVendedor;
            $venda->valorTotal = $request->valorTotal;
            $venda->cliente_id = $request->cliente;
            $venda->save();
            $id = $venda->id; // retorna o id da venda

            $id_produto = $request->produto;
            $quantidade = $request->quantidade;

            $venda->produtos()->attach([$id_produto => ['quantidade' => $quantidade]]); // adiciona o produto na tabela produto_venda
            
            $this->calcularVenda($venda);
            
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
       /* $request->validate(
            [ 'nome' => [
                'required',
                'min:2'
                ],
             'cpf' => [
                'required', 
                'min:2',
                Rule::unique('clientes')->ignore($cliente->id)
                ]
            ],

            [ 
                'nome.require' =>'Preencha o nome do Cliente',
                'nome.min' => 'O nome nao tem mais que um caractere',
          
                'cpf.require' =>'Campo CPF não preenchido',
                'cpf.min' => 'Numero de caracteres Invalidos',
                'cpf.unique'=>'cpf cadastrado',
            ]

        ); */
        if (isset($_POST['btn-finalizar-venda'])) {
            
            $venda->data = date(now());
            $venda->nomeVendedor = $request->nomeVendedor;
            $venda->valorTotal = $request->valorTotal;
            $venda->cliente_id = $request->cliente;
            $venda->save();

            $this->calcularVenda($venda);

            return redirect()->route('vendas.index')->with('msg_success', 'Venda Cadastrada');
        }

        $venda->data = date(now());
        $venda->nomeVendedor = $request->nomeVendedor;
        $venda->valorTotal = $request->valorTotal;
        $venda->cliente_id = $request->cliente;
        $venda->save();

        $id = $venda->id; // retorna o id da venda

        $id_produto = $request->produto;
        $quantidade = $request->quantidade;

        $venda->produtos()->attach([$id_produto => ['quantidade' => $quantidade]]); // adiciona o produto na tabela produto_venda

        $this->calcularVenda($venda);                                                                                  
        
       return redirect()->route('vendas.edit', $id)->with('msg_success', 'Item adcionado');
    
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
    public function deleteItens(Venda $venda, Produto $produto)
    {   
        
        $venda->produtos()->detach($produto->id);

        $this->calcularVenda($venda);  

        return redirect()->route('vendas.edit', $venda->id)
            ->with('msg_success', 'Item removido com sucesso.');
    }
}
