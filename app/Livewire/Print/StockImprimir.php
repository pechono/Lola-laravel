<?php

namespace App\Livewire\Print;

use App\Models\Articulo;
use App\Models\Empresa;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class StockImprimir extends Component
{
    public $fecha;
    public function generateReport()
    {

        $articulos=Articulo::select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id')->get();

        $emp=Empresa::first();
        $fecha = Carbon::now()->format('Y-m-d: h:m:s');


        // Definir el nombre del archivo incluyendo la fecha
        // $nombreArchivo = "stock-{$this->fecha}.pdf";
        $pdf=Pdf::loadView('livewire.print.stock-imprimir', compact('emp','articulos'));
        // return $pdf->stream($nombreArchivo);
        // $pdf=Pdf::loadView('livewire.print.report-venta-o', compact('ventaOp','emp','datos'));
        return $pdf->stream();

    }
}
