<?php

namespace App\Livewire\Oferta;;

use App\Models\Ofertas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OfertaGestion extends Component
{
    public function render()
    {
        $ofertas = Ofertas::join('articulos', 'articulos.id', '=', 'ofertas.articulo_id')
                ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
                ->join('ventas', 'ventas.articulo_id', '=', 'articulos.id')
                ->select(
                    'ofertas.id as ofId',
                    'articulos.id as artId',
                    'articulos.articulo',
                    'articulos.presentacion',
                    'ventas.precioF',
                    'stocks.stock',
                    'articulos.activo',
                    DB::raw('SUM(ventas.precioF * ventas.cantidad) as ventas_ganancia'),
                    DB::raw('SUM(ventas.cantidad) as ventas_cantidad')
                )
                ->groupBy(
                    'ofertas.id',
                    'articulos.id',
                    'articulos.articulo',
                    'articulos.presentacion',
                    'ventas.precioF',
                    'stocks.stock',
                    'articulos.activo' // Agregado al groupBy
                )
                ->orderBy('ofertas.id', 'asc')
                ->get();

        return view('livewire.oferta.oferta-gestion',compact('ofertas'));
    }
    public $arrays;
    public function arrayArt( $string){
        $this->arrays = explode(' - ', $string);

    }
}
