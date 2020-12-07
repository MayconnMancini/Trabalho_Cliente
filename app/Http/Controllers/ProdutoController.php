<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ProdutoController extends Controller
{

    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [ 'nome' => [
                'required',
                'min:2',
                'unique:produtos'
            ],
             'preco' => [
                'required', 
             ],

            'estoque' => [
                'required', 
            ]
            
            ],

            [ 
                'nome.require' =>'Preencha o nome do Produto',
                'nome.min' => 'O nome nao tem mais que um caractere',
                'nome.unique'=>'ja cadastrado',
            ],
            [
                'preco.require' =>'Campo preco não preenchido',
            ],
            [
                'estoque.require' =>'Campo preco não preenchido',
            ]
        );

        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->estoque = $request->estoque;
        $produto->preco = $request->preco;
        $produto->save();

        return redirect()->route('produtos.index')->with('msg_sucess', 'Produto Cadastrado');
    
    }


    public function show(Produto $produto)
    {
        return view('produtos.show', 
            compact(['produto'])
        );
    }

 
    public function edit(Produto $produto)
    {
        return view(
            'produtos.edit', 
            compact(['produto'])
        );   
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate(
            [ 'nome' => [
                'required',
                'min:2',
                Rule::unique('produtos')->ignore($produto->id)
            ],
             'preco' => [
                'required', 
             ],

            'estoque' => [
                'required', 
            ]
            
            ],

            [ 
                'nome.require' =>'Preencha o nome do Produto',
                'nome.min' => 'O nome nao tem mais que um caractere',
                'nome.unique'=>'ja cadastrado',
            ],
            [
                'preco.require' =>'Campo preco não preenchido',
            ],
            [
                'estoque.require' =>'Campo preco não preenchido',
            ]
        );

        $produto->nome = $request->nome;
        $produto->estoque = $request->estoque;
        $produto->preco = $request->preco;
        $produto->save();

        return redirect()->route('produtos.index')
        ->with('msg_success', 'Produto alterado com sucesso.');       
    }

    public function destroy(Produto $produto)
    {


        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('msg_success', 'Produto removido com sucesso.');
    }    

}

