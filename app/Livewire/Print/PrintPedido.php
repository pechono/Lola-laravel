<?php

namespace App\Livewire\Print;

use App\Models\Empresa;
use Livewire\Component;
use App\Models\Pedido;
use App\Models\Operacion;
use App\Models\Proveedor;
use Barryvdh\DomPDF\Facade\Pdf;




class PrintPedido extends Component
{
    public $datos=[];
    public $total;
    public $emp=[];
    public $pedido;

    public $post;

    public function generateReport($id)
    {
        $ver=$id;

        $pedidos=Pedido::join('proveedors','proveedors.id','=','pedidos.proveedor_id')
                        ->join('articulos','articulos.id','=','pedidos.articulo_id')
                        ->join('unidads', 'unidads.id','=','articulos.unidad_id')
                        ->select('articulos.articulo','articulos.presentacion','unidads.unidad', 'pedidos.cantidad','pedidos.pedido')
                        ->where('pedidos.pedido','=',$id)->get();
        $proveedor=Pedido::join('proveedors','proveedors.id','=','pedidos.proveedor_id')
                            ->where('pedidos.pedido','=',$id)
                            ->select('proveedors.nombre','pedidos.pedido', 'proveedors.telefono','proveedors.localidad','proveedors.direccion')->first();

        $emp=Empresa::first();


        $pdf=Pdf::loadView('livewire.print.print-pedido', compact('pedidos','emp','ver','proveedor'));
        return $pdf->stream();

    }
}
