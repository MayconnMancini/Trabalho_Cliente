<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;

Route::delete('/vendas/{venda}/{produto}', [VendaController::class, 'deleteItens'])->name('vendas.deleteItens');

Route::get('/', IndexController::class)->name('index'); // configura as rotas do /.
Route::resource('clientes', ClienteController::class);  // configura as rotas de clientes.
Route::resource('produtos', ProdutoController::class);  // configura as rotas de produtos

Route::resource('vendas', VendaController::class);  // configura as rotas de venda




