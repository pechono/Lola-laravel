<?php

namespace App\Livewire\Oferta;

use Livewire\Component;
use App\Models\Ofertas;


class Prueva extends Component
{
    public $ofertaList = [];
    public $actualizarDisp = false;

    public function render()
    {
        $this->mostrarOferta();
        return view('livewire.oferta.prueva');
    }
    public function mostrarOferta()
      {
          $this->ofertaList = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
              ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
              ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
              ->select(
                  'ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
                  'oferta_articulos.cantidad', 'articulos.presentacion', 'unidads.unidad',
                  'oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
                  'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio'
              )
              ->get();
      }
      public function disponibilidad($ofertaId)
      {
          $this->actualizarDisp = true;

      }
     public function cerrar() {
        $this->actualizarDisp=false;

     }

}
