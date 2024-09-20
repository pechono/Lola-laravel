<?php

namespace App\Livewire\Oferta;

use App\Models\Articulo;
use App\Models\Ofertas;
use App\Models\OfertaArticulos;
use App\Models\Stock;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class OfertaActivar extends Component
{
    public function render()
    {
        $this->mostrarOferta();
        return view('livewire.oferta.oferta-activar');
    }
      /* Variables */
      public $ofertaList = [];
      public $actualizarDisp = false;
      public $articuloConMenorStock = null;
      public $articulosActuales = null;
      public $desplegar=false;
      public $ofertaMod=[];


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
              )->get();
      }

      public function disponibilidad($ofertaId)
      {
        $this->actualizarDisp = $ofertaId;
        $this->articulosActuales = OfertaArticulos::where('oferta_id', $ofertaId)->select('cantidad')->first()->cantidad;


          $this->articuloConMenorStock = OfertaArticulos::join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
              ->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
              ->select('oferta_articulos.oferta_id', 'oferta_articulos.articulo', 'stocks.stock')
              ->where('oferta_articulos.oferta_id', $ofertaId)
              ->orderBy('stocks.stock', 'asc')
              ->first()->stock;
      }


      public function cerrar()
      {
          $this->actualizarDisp = false;
      }
      public $mensajeUpdate=null;

      public function actualizarOferta($ofertaId)
      {
        $articulos=OfertaArticulos::where('oferta_articulos.oferta_id', $ofertaId)->get();
        foreach($articulos as $art){

            OfertaArticulos::where('articulo',$art->articulo)
            ->where('oferta_articulos.oferta_id', $ofertaId)
            ->first()->update(['cantidad'=>$this->articuloConMenorStock]);
        }
        $this->mensajeUpdate='Se Realizo La Actualizacion De la cantidad de Articulos a Ofertar';
    }
    public function publicarModal($ofertaId){
        $this->desplegar=$ofertaId;
        $this->ofertaMod = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
              ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
              ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
              ->select('ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
                  'oferta_articulos.cantidad', 'articulos.presentacion', 'unidads.unidad',
                  'oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
                  'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio')
                  ->where('oferta_articulos.oferta_id', $ofertaId)->get();
    }
    public function cerrarDesplegar(){
        $this->desplegar=false;
    }

    public function publicarOferta($ofertaId){
        $oferta=Ofertas::where('id',$ofertaId)->first();
        $Articulos=Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
        ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->select('ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
            'oferta_articulos.cantidad', 'articulos.presentacion', 'unidads.unidad',
            'oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
            'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio')
            ->where('oferta_articulos.oferta_id', $ofertaId)->get();
        $stockOferta=OfertaArticulos::where('oferta_articulos.oferta_id', $ofertaId)->first();
        $articulosOF=null;
        foreach ($Articulos as $a) {
            $articulosOF .= $a->articulo . ' - ';
        }

        Articulo::create([
            'articulo'=>  $oferta->oferta,
            'categoria_id'=> 1,
            'presentacion'=>$articulosOF,
            'unidad_id'=>5,
            'descuento'=> 0,
            'unidadVenta'=>'Sin Definir',
            'precioF'=>$oferta->precio,
            'precioI'=>  $oferta->precio,
            'caducidad'=>'No',
            'detalles'=>'Ofertas - '.$oferta->detalles,
            'suelto'=> 0,
            'activo'=>1
        ]);
        $ultimo=Articulo::latest()->first();
        Stock::create([
            'articulo_id'=>$ultimo->id,
            'stockMinimo'=>0,
            'stock'=>$stockOferta->cantidad,
            'proveedor_id'=>1
        ]);

        $ofertaarticulo_id = Ofertas::where('id', $ofertaId)->first();
        $ofertaarticulo_id->update(['articulo_id' => $ultimo->id]);

        $articulosOferta = OfertaArticulos::where('oferta_id', $ofertaId)->get();
        foreach ($articulosOferta as $articuloOferta) {
            $stockAtualizar = Stock::where('articulo_id', $articuloOferta->articulo)->first();
            if ($stockAtualizar) {
                $nuevoStock = $stockAtualizar->stock - $articuloOferta->cantidad;
                $stockAtualizar->update(['stock' => $nuevoStock]);
            }
        }
    }
    public $ofertaActiva=null;
    public function ofertaPublicada($id)
    {   $this->ofertaActiva=$id;
        foreach (Ofertas::all() as $a) {
            if ($a->id == $id && $a->articulo_id!=0) {
                return true;
            }
        }
        return false;
    }
    public $terminarOf=false;
    public $terminarOfQuery=null;
    public $results=null;
    public function terminarOferta($ofertaId){
        $this->terminarOf=$ofertaId;

         $this->terminarOfQuery = Articulo::select('articulos.id', 'articulos.articulo', 'articulos.presentacion', 'articulos.precioF',
         DB::raw('SUM(ventas.cantidad) as ventas_cantidad'),
         DB::raw('SUM(ventas.cantidad * articulos.precioF) as ventas_ganancia'), 'stocks.stock', 'ofertas.id as idOfertas')
        ->join('ventas', 'ventas.articulo_id', '=', 'articulos.id')
        ->join('operacions', 'operacions.id', '=', 'ventas.operacion')
        ->join('ofertas', 'ofertas.articulo_id', '=', 'articulos.id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->where('ofertas.id', $ofertaId)
        ->groupBy('articulos.id', 'articulos.articulo', 'articulos.presentacion', 'articulos.precioF', 'stocks.stock', 'ofertas.id')
        ->first();

        $this->results = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
        ->select(
            'ofertas.id', // Se selecciona el ID de la oferta
            'oferta_articulos.precioI',
            'oferta_articulos.precioF',
            'oferta_articulos.precioO')
        ->where('ofertas.id', $ofertaId) // Condición para el ID de la oferta
        ->first(); // Obtener los resultados

   }
   public $fg='putovo';
   public function terminarP($idArt){
    $actualizado = Articulo::find($idArt)->update(['activo' => 0]);
    $this->terminarOferta($this->terminarOf);

   }
}
