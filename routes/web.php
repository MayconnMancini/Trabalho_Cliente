<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IndexController;


Route::get('/', IndexController::class)->name('index'); // configura a rota do /.
Route::resource('clientes', ClienteController::class);  // configura a rota de clientes.