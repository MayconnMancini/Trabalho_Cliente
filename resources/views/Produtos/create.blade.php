@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Produtos</h2>
    </div>
    <div class="row">
        <div class="col-md-12" >

            <form action="{{ route('produtos.store') }}" class="form-row" method="POST">
                @csrf
                <div class="col-7">
                    <input type="text" placeholder="Nome do Produto" 
                        class="form-control" name="nome" required>
                </div>
                <div class="col">
                    <input type="number" step="any" placeholder="preço" 
                        class="form-control" name="preco" required>
                </div>
                <div class="col">
                    <input type="number" placeholder="estoque" 
                        class="form-control" name="estoque" required>
                </div>
                <div class="col-7">
                    <hr>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                    <a href="{{ route('produtos.index')}}" 
                        class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                </div>
                <div class="col-7"> <!-- utilizado COL-7 para ficar uma linha abaixo -->
                    @error("nome")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror         
                    @error("preco")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror  
                    @error("estoque")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror  
                </div>
            </form>
        </div>

    </div>
</div>

@endsection