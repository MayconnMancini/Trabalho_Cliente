@extends('layouts.principal')

@section('main')

<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Cliente</h2>
    </div>
    <div class="row">
        <div class="col-md-12" >

            <form action="{{ route('clientes.update', $cliente->id) }}" 
                class="card p-2 my-4" method="POST"
            ><!-- passar cliente como parametro -->
                @csrf
                @method('PUT')

                <div class="form-row  p-3 mt-2">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome do Cliente</label>
                        <input type="text" class="form-control" id="nome" 
                            name="nome" placeholder="Vendedor" 
                            value="{{ $cliente->nome }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cpf">CPF</label>
                        <input type="number" class="form-control" id="cpf" 
                            name="cpf" placeholder="cpf" 
                            value="{{ $cliente->cpf}}" required>
                    </div>
                </div>

                <div class="form-group col-md-12">
                      
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                    <a href="{{ route('clientes.index')}}" 
                        class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                </div>

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
            </form>
            
        </div>
    </div>
</div>

@endsection