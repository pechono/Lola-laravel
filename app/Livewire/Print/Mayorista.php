<?php

namespace App\Livewire\Print;

use App\Models\Empresa;
use App\Models\Mayorista as ModelsMayorista;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Mayorista extends Component
{
    public $enviarM;

    protected $listeners = ['generateReport'];

    
    public function generateReport($enviarM)
    {    $mayorista = ModelsMayorista::join('articulos', 'articulos.id', '=', 'mayoristas.articulo_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->where('nroPedido','=',$enviarM)
        ->select(
            'articulos.id', 
            'articulos.articulo', 
            'articulos.presentacion', 
            'unidads.unidad', 
            'articulos.unidadVenta', 
            'mayoristas.precioM', 
            'mayoristas.cliente'
        )
        ->get(); 

        $emp=Empresa::first();
        $pdf=Pdf::loadView('livewire.print.mayorista',compact('mayorista'));
        return $pdf->stream();

    }
}
