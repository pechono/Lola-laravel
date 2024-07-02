<?php

use App\Http\Controllers\ImprimirPedidoController;
use App\Http\Controllers\ReportVenta;
use App\Http\Controllers\ReportVentaController;
use App\Livewire\Report\PedidoProveedor;
use Illuminate\Support\Facades\Route;
use App\Livewire\Print\ReportVentaO;
use App\Livewire\Print\PrintPedido;
// use App\Livewire\Print\StockImprimir as PrintStockImprimir;
use App\Livewire\Print\StockImprimir;

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
    Route::get('/venta/cuentacorriente', function () {return view('venta.cuentaCorriente'); })->name('venta.cuentaCorriente');
    Route::get('/venta/listcuentacorriente', function () {return view('venta.ListCuentaCorriente'); })->name('venta.ListCuentaCorriente');
    Route::get('/venta/express', function () {return view('venta.ventaExpress'); })->name('venta.ventaExpress');

});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/cierre', function () {return view('cierre.cierreCaja'); })->name('cierre.cierreCaja');
});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/operacion', function () {return view('operacion.index'); })->name('operacion.index');
    Route::get('/operacion/list', function () {return view('operacion.list'); })->name('operacion.list');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/stock', function () {return view('stock.index'); })->name('stock.index');
    Route::get('/stock/pedido', function () {return view('stock.pedido'); })->name('stock.pedido');
    Route::get('/stock/pedido/confirmar', function () {return view('stock.confirmarPedido'); })->name('stock.confirmarPedido');
    Route::get('/stock/pedido/pedido/{id}', [PrintPedido::class,'generateReport'])->name('pedidoImprimir');
    Route::get('/stock/pedidorealizados', function () {return view('stock.pedidoRealizado'); })->name('stock.pedidoRealizado');
    Route::get('/stock/stock', [StockImprimir::class,'generateReport'])->name('stockImprimir');

});
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('report/comprobante/reporteVenta/{operacion}/{volver}',[ReportVentaController::class,'pasar'])->name('venta.reporte');
    Route::get('/report/comprobante/{operacion}', [ReportVentaO::class,'generateReport'])->name('comprobante');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/informes/masvendidos', function () {return view('informes.masVendidos'); })->name('informes.masVendidos');
});


