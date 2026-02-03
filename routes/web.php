<?php

use App\Http\Controllers\ImprimirPedidoController;
use App\Http\Controllers\ReportVentaController;
use App\Livewire\Print\PrintPedido;
use App\Livewire\Print\ReportVentaO;
use App\Livewire\Print\StockImprimir;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CargarImagenes;
Route::get('/', function () {
    return view('welcome');
});



// Agrupa todas las rutas que requieren autenticación y verificación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
   
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Agrupación por prefijo para clientes, artículos, y ventas
    Route::prefix('cliente')->group(function () {
        Route::get('/', fn() => view('cliente.index'))->name('cliente.index');
    });

    Route::prefix('articulo')->group(function () {
        Route::get('/', fn() => view('articulo.index'))->name('articulo.index');
        Route::get('/grupo', fn() => view('articulo.articuloGrupo'))->name('articulo.articuloGrupo');

    });

    Route::prefix('venta')->group(function () {
        Route::get('/', fn() => view('venta.index'))->name('venta.index');
        Route::get('/list', fn() => view('venta.list'))->name('venta.list');
        Route::get('/cuentacorriente', fn() => view('venta.cuentaCorriente'))->name('venta.cuentaCorriente');
        Route::get('/listcuentacorriente', fn() => view('venta.ListCuentaCorriente'))->name('venta.ListCuentaCorriente');
        Route::get('/express', fn() => view('venta.ventaExpress'))->name('venta.ventaExpress');
        Route::get('/card', fn() => view('venta.ventaCard'))->name('venta.ventaCard');

    });

    // Agrupación para operaciones, cierre de caja y stock
    Route::prefix('cierre')->group(function () {
        Route::get('/', fn() => view('cierre.cierreCaja'))->name('cierre.cierreCaja');
    });

    Route::prefix('operacion')->group(function () {
        Route::get('/', fn() => view('operacion.index'))->name('operacion.index');
        Route::get('/list', fn() => view('operacion.list'))->name('operacion.list');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', fn() => view('stock.index'))->name('stock.index');
        Route::get('/pedido', fn() => view('stock.pedido'))->name('stock.pedido');
        Route::get('/pedido/confirmar', fn() => view('stock.confirmarPedido'))->name('stock.confirmarPedido');
        Route::get('/pedido/pedido/{id}', [PrintPedido::class, 'generateReport'])->name('pedidoImprimir');
        Route::get('/pedidorealizados', fn() => view('stock.pedidoRealizado'))->name('stock.pedidoRealizado');
        Route::get('/stock', [StockImprimir::class, 'generateReport'])->name('stockImprimir');
    });

    // Rutas para reportes y comprobantes
    Route::prefix('report/comprobante')->group(function () {
        Route::get('/reporteVenta/{operacion}/{volver}', [ReportVentaController::class, 'pasar'])->name('venta.reporte');
        Route::get('/{operacion}', [ReportVentaO::class, 'generateReport'])->name('comprobante');
    });

    // Rutas para informes y proveedores
    Route::prefix('informes')->group(function () {
        Route::get('/masvendidos', fn() => view('informes.masVendidos'))->name('informes.masVendidos');
    });

    Route::prefix('proveedor')->group(function () {
        Route::get('/', fn() => view('proveedor.proveedor'))->name('proveedor.proveedor');
        Route::get('/creargrupo', fn() => view('proveedor.crearGrupo'))->name('proveedor.crearGrupo');
        Route::get('/grupoarticulo', fn() => view('proveedor.articuloGrupo'))->name('proveedor.articuloGrupo');
    });

    // Rutas de gestión de precios
    Route::prefix('gestion/precio')->group(function () {
        Route::get('/preciogrupo', fn() => view('gestion.precio.precioGrupo'))->name('gestion.precio.precioGrupo');
        Route::get('/preciocambiar', fn() => view('gestion.precio.precioCambiar'))->name('gestion.precio.precioCambiar');
    });

    // Rutas de ofertas
    Route::prefix('oferta')->group(function () {
        Route::get('/list', fn() => view('oferta.ofertaList'))->name('oferta.ofertaList');
        Route::get('/crear', fn() => view('oferta.ofertaCreate'))->name('oferta.ofertaCreate');
        Route::get('/gestion', fn() => view('oferta.ofertaGestion'))->name('oferta.ofertaGestion');

    }); 
    Route::get('/imagenes/cargar', fn() => view('imagenes.imagenes'))->name('imagenes.imagenes');

    Route::get('/servicio/ingresar', fn() => view('Service.ingresarBike'))->name('Service.ingresarBike');
Route::get('/servicio/ingreso-imp/{nro_ingreso}', function ($nro_ingreso) {
    return view('service.ingresoImp', compact('nro_ingreso'));
})->name('Service.ingreso-imp');

    //Route::get('/servicio//ingreso-imp{nro_ingreso}', fn() => view('Service.ingresoImp'))->name('Service.ingreso-imp');

});
