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

                <div class="form-row p-3 mt-2">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome" 
                            name="nome" placeholder="Nome do Produto" 
                            value="{{ $produto->nome  }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="preco">Preço</label>
                        <input type="text" class="form-control" id="preco" 
                            name="preco" placeholder="preco" 
                            value="{{ $produto->preco}}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="estoque">Estoque</label>
                        <input type="text" class="form-control" id="estoque" 
                            name="estoque" placeholder="estoque" 
                            value="{{ $produto->estoque}}" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                      
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                    <a href="{{ route('produtos.index')}}" 
                        class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
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
                
            </form>
        </div>
    </div>
</div>

@endsection