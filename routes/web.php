<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

//Route::get('vendas/{venda}/{id}', 'VendaController@deleteItens');
Route::resource('vendas', VendaController::class);  // configura as rotas de venda
Route::get('/', IndexController::class)->name('index'); // configura as rotas do /.
Route::resource('clientes', ClienteController::class);  // configura as rotas de clientes.
Route::resource('produtos', ProdutoController::class);  // configura as rotas de produtos


