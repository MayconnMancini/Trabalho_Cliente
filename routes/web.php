<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\IndexController;


Route::get('/', IndexController::class)->name('index'); 
Route::resource('clientes', ClienteController::class);