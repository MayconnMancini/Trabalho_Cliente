<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $vendas = Venda::all();

        return view('index', compact(['clientes','vendas','produtos']));
    }
}
