@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Clientes</h2>
    </div>
    <div class="row mb-2">
        <div class="col-md-12" >
            <a href="{{ route('clientes.create')}}" class="btn btn-primary active" 
                role="button" aria-pressed="true">Novo Cliente</a>
        </div>
    </div>

    @if (session('msg_success'))
    <div class="alert alert-success" role="alert">
        {{ session('msg_success') }}
    </div>
    @endif

    @if (session('msg_error'))
    <div class="alert alert-danger" role="alert">
        {{ session('msg_error') }}
    </div>
    @endif

    @if(count($clientes)>0)
    <div class="row">
        <div class="col-md-12" >

            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                @foreach($clientes as $c)
                <tr>
                    <th scope="row">{{ $c->id}}</th>
                    <td>{{$c->nome}}</td>
                    <td>
                        <form action="{{ route('clientes.destroy', $c->id) }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Apagar
                            </button>                            
                            <a class="btn btn-primary btn-sm active" 
                                href="{{ route('clientes.show', $c->id) }}">
                                Detalhes
                            </a>
                            <a class="btn btn-secondary btn-sm active" 
                                href="{{ route('clientes.edit',$c->id) }}">
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