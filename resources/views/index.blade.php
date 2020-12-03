@extends('layouts.principal')

@section('main')

<div class="container">
  <div class="py-5 text-center">
    <h2>Dashboard</h2>
  </div>
  <div class="row">

    
    <div class="col-md-4" >
      <h3>Vendas</h3>

      @if(count($vendas)>0)
        <ul>
          @foreach($vendas as $v)
            <li>
              [{{ $v->id }}] - {{ $v->nomeVendedor }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>

    
    <div class="col-md-4" >
      <h3>Clientes</h3>
      
      @if(count($clientes)>0)
        <ul>
          @foreach($clientes as $c)
            <li>
              [{{ $c->id }}] - {{ $c->nome }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>


    <div class="col-md-4" >
      <h3>Produtos</h3>
      @if(count($produtos)>0)
        <ul>
          @foreach($produtos as $p)
            <li>
              [{{ $p->id }}] - {{ $p->nome }}
            </li>
          @endforeach
        </ul>
      @endif
    </div>



  </div>
</div>



@endsection