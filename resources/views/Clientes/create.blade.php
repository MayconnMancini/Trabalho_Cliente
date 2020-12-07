@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Clientes</h2>
    </div>
    <div class="row">
        <div class="col-md-12" >

            <form action="{{ route('clientes.store') }}" class="form-row" method="POST">
                @csrf <!-- cria um token do formulario -->
                <div class="col-7">
                    <input type="text" placeholder="Nome do Cliente" 
                        class="form-control" name="nome" required>
                </div>
                <div class="col">
                    <input type="number" placeholder="CPF" 
                        class="form-control" name="cpf" required>
                </div>
                <div class="col-7">
                    <hr>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                    <a href="{{ route('clientes.index')}}" 
                        class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                </div>
                <div class="col-7"> <!-- utilizado COL-7 para ficar uma linha abaixo -->
                    @error("nome")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                        @enderror         
                        @error("cpf")
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