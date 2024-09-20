<?php

namespace App\Livewire\Oferta;

use App\Models\Articulo;
use App\Models\OfertaArt;
use App\Models\OfertaArticulos;
use App\Models\Ofertas;
use Illuminate\Support\Facades\DB;

use App\Models\Venta;
use Livewire\Component;

class OfertaCreate extends Component
{   public $modalArt=false;
    public $articulos=[];
    public $oferta;
    public $detalles;
    public $precio;
    public $tiempo;

    public function mostrarArt()
    {
        $this->modalArt=true;
        $this->articulosQuery();
        $this->ofertaArtQuery();
        /*
         $this->mostrarArticulosOferta();
*/

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
        if (OfertaArt::all()->isNotEmpty()) {
            $this->artOferta=OfertaArt::all();
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
    {   $of=Articulo::find($id);
        OfertaArt::create([
            'articulo' => $id,

            'precioO'=>0
         ]);
        $this->articulosQuery();
    }
    public function deleteOferta($id){
        OfertaArt::where('articulo',$id)->delete();
        $this->articulosQuery();


    }
    public function delete(){
        OfertaArt::truncate();
        $this->articulosQuery();

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
        $this->artOfertados = OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
        ->select('articulos.id','articulos.articulo','stocks.stock','articulos.presentacion','unidads.unidad','articulos.precioI','articulos.precioF','oferta_art.precioO')
        ->orderBy('stocks.stock', 'asc')
        ->get();

    }
    public function cerrarModal(){

        $this->mostrarArticulosOferta();
        $this->modalArt=false;
    }

    public $PrecioOf;
    public $OfertaPecioArtModal=false;
    public $precioI;
    public $precioF;
    public function precioOfertaCambiar($id){

        $precioQ = OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')->join('stocks', 'articulos.id', '=', 'stocks.articulo_id')
        ->select('articulos.id','articulos.articulo','stocks.stock','articulos.presentacion','unidads.unidad','articulos.precioI','articulos.precioF','oferta_art.precioO')
        ->where('articulos.id', $id)->first();
        $this->PrecioOf=$precioQ->precioO;
        $this->precioI=$precioQ->precioI;
        $this->precioF=$precioQ->precioF;


        $this->OfertaPecioArtModal=$id;

    }
    public function cambiar(){
        $update=OfertaArt::where('articulo', $this->OfertaPecioArtModal);
        $this->validate(['PrecioOf'=>'required|numeric']);
        $update->update([
            'precioO'=>$this->PrecioOf
        ]);
        $this->mostrarArticulosOferta();

    }
    public function cerrar(){
        $this->mostrarArticulosOferta();
        $this->OfertaPecioArtModal=false;
    }
    public $sumInicial;
    public $sumFinal;
    public function total(){
        $precioTotal = OfertaArt::sum('precioO') ?? 0;

        $this->sumInicial =OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')->select('articulos.precioI','articulos.precioF','oferta_art.precioO')->sum('precioI') ?? 0;
        $this->sumFinal=OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')->select('articulos.precioI','articulos.precioF','oferta_art.precioO')->sum('precioF') ?? 0;
        ;
        if (OfertaArt::all()->isNotEmpty()) {
            $this->precio=$precioTotal;
        } else {
            $this->precio= 0;
        }
        return $precioTotal;
    }

    public function CrearOferta(){
        $this->validate([
            'precio'=>'required|numeric',
            'oferta'=>'required|min:3'
        ]);
        Ofertas::create([
            'precio'=>$this->precio,
            'detalles'=>'Oferta'.$this->detalles,
            'oferta'=>$this->oferta,
            'tiempo'=>$this->tiempo
        ]);
         $ultima = Ofertas::latest()->first();
         $ofs=OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
            ->select('articulos.id','articulos.precioI','articulos.precioF','oferta_art.precioO')
            ->get();
        foreach( $ofs as $of){
            OfertaArticulos::create([
                'oferta_id'=>$ultima->id,
                'articulo'=>$of->id,
                'cantidad'=>$this->numeroDeOferta(),
                'precioI'=>$of->precioI,
                'precioF'=>$of->precioF,
                'precioO'=>$of->precioO
            ]);
        }
        OfertaArt::truncate();
        $this->mostrarLabel=false;


    }


}

