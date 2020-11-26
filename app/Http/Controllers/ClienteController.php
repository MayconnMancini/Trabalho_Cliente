<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all(); //
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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

        );

        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->save();

        return redirect()->route('clientes.index')->with('msg_sucess', 'Cliente Cadastrado');
    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', 
            compact(['cliente'])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view(
            'clientes.edit', 
            compact(['cliente'])
        );   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(
            [ 
                'nome' => [
                    'required',
                    'min:2',
                    Rule::unique('clientes')->ignore($cliente->id)
                ],
                'cpf' =>[
                    'required',
                    'min:2',
                    Rule::unique('clientes')->ignore($cliente->id)
                ]
            ],
            [
              'nome.required' => 'O nome do Cliente é obrigatório'  ,
              'nome.min' => 'O nome do Cliente deve ter no mínimo 2 letras'  ,
              'nome.unique' => 'Este Cliente já está cadastrado'  ,
            ],
            [
                'cpf.require' =>'Campo CPF não preenchido',
                'cpf.min' => 'Numero de caracteres Invalidos',
                'cpf.unique'=>'cpf cadastrado',
            ]
            
        );

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('msg_success', 'Cliente atualizado com sucesso');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('msg_success', 'Cliente removido com sucesso.');
    }    

}

