@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Produto</h2>
    </div>

    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Estoque</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $produto->id }}</th>
            <td>  {{ $produto->nome }}</td>
            <td> R$ {{ $produto->preco }}</td>
            <td> {{ $produto->estoque }}</td>
        </tr>
    </table>
    </tbody>

        <div class="table">
            <a href="{{ route('produtos.index') }}" 
                class="btn btn-primary" role="button" aria-pressed="true">Voltar</a>
        </div>
    

</div>
@endsection

