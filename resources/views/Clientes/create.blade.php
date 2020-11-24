@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Clientes</h2>
    </div>
    <div class="row">
        <div class="col-md-12" >

            <form action="{{ route('clientes.store') }}" class="card p-2 my-4" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" placeholder="Nome do Cliente" 
                        class="form-control" name="nome" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            Salvar
                        </button>
                    </div>
                </div>
                @error("nome")
               <div class="alert alert-danger my-2" role="alert">
                    {{ $message }}
                </div>
                @enderror         
            </form>
            <a href="{{ route('clientes.index')}}" 
            class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

        </div>
    </div>
</div>

@endsection