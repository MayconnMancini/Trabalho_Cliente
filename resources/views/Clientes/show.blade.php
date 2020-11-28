@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cliente</h2>
    </div>

    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $cliente->id }}</th>
            <td>  {{ $cliente->nome }}</td>
            <td> {{ $cliente->cpf }}</td>
        </tr>
    </table>
    </tbody>

        <div class="table">
            <a href="{{ route('clientes.index') }}" 
                class="btn btn-primary" role="button" aria-pressed="true">Voltar</a>
        </div>

        <br> <hr> <br>
        <h3>Lista de vendas</h3>
        <br>
        @if(count($vendas)>0)
        <div class="row">
            <div class="col-md-12" >
    
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
    
                @foreach($vendas as $v) 
                    <tr>
                        <th scope="row">{{ $v->id}}</th>
                        <td>{{$v->data }}</td>
                        <td>{{$v->nomeVendedor}}</td>
                        <td>{{$v->cliente->nome}}</td>
                        <td>{{$v->valorTotal}}</td>
                        <td>{{$v->status}}</td>
                        <td>
                            <form action="{{ route('vendas.destroy', $v->id) }}" method="POST"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Apagar
                                </button>                            
                                <a class="btn btn-primary btn-sm active" 
                                    href="{{ route('vendas.show', $v->id) }}">
                                    Detalhes
                                </a>
                                <a class="btn btn-secondary btn-sm active" 
                                    href="{{ route('vendas.edit',$v->id) }}">
                                    Editar
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
    
                </tbody>
                </table>
    
            </div>
        </div>
        @endif
    

</div>
@endsection

