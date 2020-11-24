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
    

</div>
@endsection

