<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/cliente', function () {return view('cliente.index'); })->name('cliente.index');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/articulo', function () {return view('articulo.index'); })->name('articulo.index');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/venta', function () {return view('venta.index'); })->name('venta.index');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/operacion', function () {return view('operacion.index'); })->name('operacion.index');
    Route::get('/operacion/list', function () {return view('operacion.list'); })->name('operacion.list');

});
