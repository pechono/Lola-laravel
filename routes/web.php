<?php

use App\Http\Controllers\ImprimirPedidoController;
use App\Http\Controllers\ReportVenta;
use App\Livewire\Report\PedidoProveedor;
use Illuminate\Support\Facades\Route;
use App\Livewire\ReportVentaO;





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
    Route::get('/venta/list', function () {return view('venta.list'); })->name('venta.list');
    Route::get('/venta/repote', function () {return view('venta.reporte'); })->name('venta.reporte');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/operacion', function () {return view('operacion.index'); })->name('operacion.index');
    Route::get('/operacion/list', function () {return view('operacion.list'); })->name('operacion.list');

});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/stock', function () {return view('stock.index'); })->name('stock.index');
    Route::get('/stock/pedido', function () {return view('stock.pedido'); })->name('stock.pedido');
    Route::get('/stock/pedido/confirmar', function () {return view('stock.confirmarPedido'); })->name('stock.confirmarPedido');


});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/report/comprobante', [ReportVentaO::class,'generateReport'])->name('comprobante');
   // Route::get('/stock/list', function () {return view('operacion.list'); })->name('operacion.list');

});

