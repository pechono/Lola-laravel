<?php

namespace App\Livewire\Oferta;

use App\Models\Articulo;
use App\Models\OfertaArt;
use Illuminate\Support\Facades\DB;

use App\Models\Venta;
use Livewire\Component;

class OfertaCreate extends Component
{   public $modalArt=false;
    public $articulos=[];
    public function mostrarArt()
    {
        $this->modalArt=true;
        $this->articulosQuery();
        $this->ofertaArtQuery();
        $this->mostrarArticulosOferta();


    }
    public function render()
    {
        return view('livewire.oferta.oferta-create');
    }
    public function seVendio($id){
        $venta = Venta::where('articulo_id', $id)->select(DB::raw('SUM(cantidad) as total_vendido'))->first();

        if ($venta->total_vendido > 0) {
           return $venta->total_vendido;
        } else {
             return 0;
        }
    }
    public $msj=2;
    // public function addOferta($id){
    //     $this->msj=$id;
    //     OfertaArt::create(['articulo'=>$id,'cantidad'=>0, 'precioOfertado'=>0 ]);
    //     $this->articulosQuery();
    // }
    public function articulosQuery()  {
        return $this->articulos=Articulo::where('activo',1)
        ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')->get();

    }
    public $artOferta=[];
    public function ofertaArtQuery()
    {
        $this->artOferta;
        $var= OfertaArt::all();
        if ($var->isNotEmpty()) {
            $this->artOferta=$var;
        } else {
            return 'Sin Seleccion';
        }
    }
    public $enOferta=false;
    public function botonOferta($articuloId)
    {
        $ofertaArticulo = OfertaArt::where('articulo', $articuloId)->get();
        if ($ofertaArticulo->isNotEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function addOferta($id)
    {
        OfertaArt::create([
            'articulo' => $id,
            'cantidad'=>0,
            'precioOfertado'=>0 ]);
        $this->articulosQuery();
    }
    public function deleteOferta($id){
        OfertaArt::where('articulo',$id)->delete();
        $this->articulosQuery();
        $this->ofertaArtQuery();


    }
    public function delete(){
        OfertaArt::truncate();
        $this->articulosQuery();
        $this->ofertaArtQuery();

    }
    public $mostrarLabel=false;
    public function numeroDeOferta(){
        if( DB::table('oferta_art')->exists()){
           $oferta=DB::table('oferta_art')
            ->join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
            ->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
            ->select('articulos.id', 'stocks.stock')
            ->orderBy('stocks.stock', 'asc')
            ->first();
            $this->mostrarLabel=true;
            return $oferta->stock;
        }else{
            $this->mostrarLabel=false;

            return 'No Se selecciono Articulo';
        }

    $this->ofertaArtQuery();


    }
    public $artOfertados=[];
    public function mostrarArticulosOferta(){
        $this->artOfertados=OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
                    ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
                    ->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
                    ->select('articulos.id', 'articulos.articulo', 'stocks.stock',
                            'articulos.presentacion', 'unidads.unidad', 'articulos.precioI', 'articulos.precioF')
                    ->orderBy('stocks.stock', 'asc')
                    ->get();

    }

    public function cerrarModal(){
     $this->mostrarArticulosOferta();
     $this->articulosQuery();
        $this->ofertaArtQuery();
     $this->modalArt=false;



    }

}
