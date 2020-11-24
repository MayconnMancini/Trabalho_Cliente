<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProdutoController;

Route::get('/', IndexController::class)->name('index'); // configura a rota do /.
Route::resource('clientes', ClienteController::class);  // configura a rota de clientes.
Route::resource('produtos', ProdutoController::class);  // configura a rota de produtos