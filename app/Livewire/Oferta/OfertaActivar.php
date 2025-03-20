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
    public $ofertaPlaneada = null;
    public $desplegar=false;
    public $ofertaMod=[];
    public $terminarOf=false;
    public $terminarOfQuery=[null];
    public $results=null;
    public $mensajeUpdate=null;
    public $msj='aca';
    public $ofertaActiva=null;
    public $stockRestante=null;

    public function mostrarOferta(){
        $this->ofertaList = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
            ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->select(
                'ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
                'oferta_articulos.cantidad', 'articulos.presentacion', 'unidads.unidad',
                'oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
                'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio','ofertas.articulo_id as idArt'
            )->get();
    }

    public function disponibilidad($ofertaId){
        $this->actualizarDisp = $ofertaId;
        $this->ofertaPlaneada = OfertaArticulos::where('oferta_id', $ofertaId)
                ->select('cantidad')->first()->cantidad;

                $this->articuloConMenorStock = OfertaArticulos::join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
                ->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
                ->select('oferta_articulos.oferta_id', 'oferta_articulos.articulo', 'stocks.stock')
                ->where('oferta_articulos.oferta_id', $ofertaId)
                ->orderBy('stocks.stock', 'asc')
                ->first()?->stock;
    }

    public function cerrar(){
    $this->ofertaModFun($this->actualizarDisp);
        $this->actualizarDisp = false;
    }


    public function actualizarOferta($ofertaId){
        $articulos=OfertaArticulos::where('oferta_articulos.oferta_id', $ofertaId)->get();
        foreach($articulos as $art){

            OfertaArticulos::where('articulo',$art->articulo)
            ->where('oferta_articulos.oferta_id', $ofertaId)
            ->first()->update(['cantidad'=>$this->articuloConMenorStock]);
        }
        $this->mensajeUpdate='Se Realizo La Actualizacion De la cantidad de Articulos a Ofertar';
        $this->ofertaModFun($ofertaId);
    }
    public function publicarModal($ofertaId){
        $this->desplegar=$ofertaId;
        $this->ofertaModFun($ofertaId);

    }
    public function cerrarDesplegar(){
        $this->desplegar=false;
    }

    public function publicarOferta($ofertaId){
        $activo = Articulo::join('ofertas', 'ofertas.articulo_id', '=', 'articulos.id') ->where('ofertas.id', $ofertaId)
        ->select('articulos.id', 'articulos.activo')
        ->first();

        if ($activo) {
            Articulo::where('id', $activo->id)->update([
                'activo' => 1
            ]);

            $stockQuidato = OfertaArticulos::where('oferta_id', $ofertaId)->first();

            $s=stock::where('articulo_id',$activo->id)->first();
            $s->update(['stock'=>$stockQuidato->cantidad]);

            $artOfs=OfertaArticulos::first('oferta_id',$ofertaId)->get();
            foreach($artOfs as $artOf){
                $stock=stock::where('articulo_id',$artOf->articulo)->first();
                $update=stock::where('articulo_id',$artOf->articulo)->first();
                $update->update(['stock'=>$stock->stock-$stockQuidato->cantidad]);
            }

    }
    $this->ofertaModFun($ofertaId);
    $this->desplegar=false;

    }
    
    public function terminarOfQueryFun($ofertaId){
        try {
            $this->terminarOfQuery = Articulo::select('articulos.id', 'articulos.articulo', 'articulos.presentacion', 'articulos.precioF',
                    DB::raw('SUM(ventas.cantidad) as ventas_cantidad'),
                    DB::raw('SUM(ventas.cantidad * articulos.precioF) as ventas_ganancia'),
                    'stocks.stock', 'ofertas.id as idOfertas')
                    ->join('ventas', 'ventas.articulo_id', '=', 'articulos.id')
                    ->join('operacions', 'operacions.id', '=', 'ventas.operacion')
                    ->join('ofertas', 'ofertas.articulo_id', '=', 'articulos.id')
                    ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
                    ->where('ofertas.id', $ofertaId)
                    ->groupBy('articulos.id', 'articulos.articulo', 'articulos.presentacion', 'articulos.precioF', 'stocks.stock', 'ofertas.id')
                    ->first();

            if (!$this->terminarOfQuery) {
                $this->terminarOfQuery= false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function OfertasQuery($ofertaId){
        $this->results = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
            ->join('articulos','articulos.id','oferta_articulos.articulo')->join('stocks','stocks.articulo_id','articulos.id')
            ->select( 'ofertas.id', 'oferta_articulos.precioI','oferta_articulos.precioF','oferta_articulos.precioO')
            ->where('ofertas.id', $ofertaId)
            ->first();
    }
    public function stockFun($ofertaId)
    {
        $Restante = Ofertas::join('articulos', 'articulos.id', '=', 'ofertas.articulo_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->where('ofertas.id', $ofertaId)
        ->select('stocks.stock')
        ->first();
        return $Restante->stock;
    }


    public function ofertaPublicada($id){
        $activo = Articulo::join('ofertas', 'ofertas.articulo_id', '=', 'articulos.id')
            ->where('ofertas.id', $id)
            ->select('articulos.activo')
            ->first();

        return $activo ? $activo->activo == 1 : false;
    }
    public function ofertaModFun($ofertaId){
        $this->ofertaMod = Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
         ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
         ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
         ->select('ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
             'oferta_articulos.cantidad', 'articulos.presentacion', 'unidads.unidad',
             'oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
             'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio','oferta_articulos.cantidad','articulos.id as idArt')
             ->where('oferta_articulos.oferta_id', $ofertaId)->get();
    }
    public function cerrarTerminarOf(){
        $this->terminarOf=false;
        $this->mostrarOferta();
    }
    //terminar Oferta
    public function terminarPublic($ofertaId){//inicia bloque terminar
         $this->terminarOf=$ofertaId;
         $this->terminarOfQueryFun($ofertaId);
         $this->OfertasQuery($ofertaId);


    }
    public function terminarPconVenta($ofertaId){
        $this->terminarOf=$ofertaId;
        $this->terminarOfQueryFun($ofertaId);
        $this->OfertasQuery($ofertaId);
        $this->terminarPSinVenta($ofertaId);
    }


    public function terminarPSinVenta($ofertaId){
        $this->terminarOf=$ofertaId;
        $this->terminarOfQueryFun($ofertaId);
        $this->OfertasQuery($ofertaId);

        $activo = Articulo::join('ofertas', 'ofertas.articulo_id', '=', 'articulos.id') ->where('ofertas.id', $ofertaId)
        ->select('articulos.id', 'articulos.activo')
        ->first();

        if ($activo) {
            Articulo::where('id', $activo->id)->update([
                'activo' => 0
            ]);
            $recuperarStock=Stock::where('articulo_id',$activo->id)->first();
            Stock::where('articulo_id',$activo->id)->update([
                'stock'=>0
            ]);
           $artOfs=OfertaArticulos::first('oferta_id',$ofertaId)->get();
           foreach($artOfs as $artOf){
                    $stock=stock::where('articulo_id',$artOf->articulo)->first();
                    $update=stock::where('articulo_id',$artOf->articulo)->first();
                    $update->update([
                        'stock'=>$recuperarStock->stock+$stock->stock
                    ]);
           }

        }
    $this->terminarOf=false;

    }
}
