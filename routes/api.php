<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;


//use App\Http\Controllers\CarController;

Route::prefix('carrito')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::post('/agregar', [CarController::class, 'agregar']);
    Route::post('/actualizar', [CarController::class, 'actualizarCantidad']);
    Route::delete('/eliminar/{codigo}', [CarController::class, 'eliminar']);
});

Route::get('/articulo/{codigo}', [CarController::class, 'buscarArticulo']);
