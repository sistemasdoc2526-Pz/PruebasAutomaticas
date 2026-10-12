<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('layouts/app');
});

Route::resource('productos', ProductoController::class)
    ->only(['index', 'store', 'destroy']);



Route::resource('clientes', ClienteController::class)
    ->only(['index', 'store', 'destroy']);

Route::resource('categorias', CategoriaController::class)
    ->only(['index', 'store']);