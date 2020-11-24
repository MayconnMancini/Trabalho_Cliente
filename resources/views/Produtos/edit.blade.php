@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Alteração de Produtos</h2>
    </div>
    <div class="row">
        <div class="col-md-12" >

            <form action="{{ route('produtos.update', $produto->id) }}" 
                class="card p-2 my-4" method="POST"
            ><!-- passar produtos como parametro -->
                @csrf
                @method('PUT')

                <div class="input-group">
                    <input type="text" placeholder="Nome do Produto" 
                        value="{{ $produto->nome }}"
                        class="form-control" name="nome" required>
                        
                    <input type="text" placeholder="Preço" 
                        value="{{ $produto->preco }}"
                        class="form-control" name="preco" required>

                    <input type="text" placeholder="estoque" 
                        value="{{ $produto->estoque }}"
                        class="form-control" name="estoque" required>
                </div>
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
                <hr>
                <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            Salvar
                        </button>
                </div>
            </form>
            <a href="{{ route('produtos.index') }}" 
                class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
        </div>
    </div>
</div>

@endsection