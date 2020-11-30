@extends('layouts.principal')

@section('main')

<div class="container"><!-- Inicio container -->
    <div class="py-5 text-center">
        <h2>Cadastro de Vendas</h2>
    </div>
    <div class="row"><!-- inicio row  principal -->
        <div class="col-md-12" > <!-- grid principal -->

            <form action="{{ route('vendas.store') }}" class="" method="POST"><!-- Inicio form principal -->
                @csrf
                
                <div class="form-row border p-3 mt-2"> <!-- inicio 1 row -->

                    <div class="form-group col-md-4">
                        <label for="nome">Nome do Vendedor</label>
                        <input type="text" class="form-control" id="nomeVendedor" 
                            name="nomeVendedor" placeholder="Vendedor" required>
                    </div>
    
                    <div class="form-group col-md-4">
                    <label for="cliente">Cliente</label>
                        <select name="cliente" class="form-control" id = "cliente" required>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->nome }}
                                </option>
                            @endforeach
                        </select> 
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="nome">Status</label>
                        <input type="text" class="form-control" id="status" 
                            name="status" readonly>
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="nome">Valor Total</label>
                        <input type="number" class="form-control" id="valorTotal" 
                            name="valorTotal" value = "0" readonly> 
                    </div>
    
                    <div class="form-group col-md-12">
                      
                        <button type="submit" name="btn-finalizar-venda" class="btn btn-primary">
                            Salvar Venda
                        </button>
                            <a href="{{ route('vendas.index')}}" 
                                class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                    </div>

                </div><!-- Fim 1 row -->

               
                <div class="form-row border p-3 mt-2"><!-- inicio 2 row -->

                    <div class="form-group col-md-4">
                        <label for="produto">Selecione o produto</label>
                        <select name="produto" class="form-control" id = "produto">
                            @foreach($produtos as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->nome }}
                                </option>
                            @endforeach
                        </select> 
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" 
                            name="quantidade" placeholder="quantidade">
                    </div>
    
                    <div class="form-group col-md-4 d-flex align-items-end">
                     
                        <button type="submit" name="btn-adcionar-item" class="btn btn-success ">
                            Adicionar ao carrinho
                        </button>
                
                    </div>

                </div><!-- Fim 2 row -->

                <div class="col-md-12"> <!-- utilizado COL-7 para ficar uma linha abaixo -->
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

            </form> <!-- Inicio form principal -->


            <h3>Carrinho de compras</h3><!-- inicio Lista de itens -->

        


        </div><!-- fim grid principal -->
    </div><!-- Fim row principal -->
</div><!-- Fim container -->

@endsection