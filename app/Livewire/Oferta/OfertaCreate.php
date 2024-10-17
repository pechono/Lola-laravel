<?php

namespace App\Livewire\Oferta;

use App\Models\Articulo;
use App\Models\OfertaArt;
<<<<<<< HEAD
=======
use App\Models\OfertaArticulos;
use App\Models\Ofertas;
use App\Models\Stock;
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
use Illuminate\Support\Facades\DB;

use App\Models\Venta;
use Livewire\Component;

class OfertaCreate extends Component
{   public $modalArt=false;
<<<<<<< HEAD
    public $articulos=[];
=======
    /* public $articulos=[]; */
    public $oferta;
    public $detalles;
    public $precio;
    public $tiempo;
    public $q;
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
    public function mostrarArt()
    {
        $this->modalArt=true;
        $this->articulosQuery();
        $this->ofertaArtQuery();
<<<<<<< HEAD
        $this->mostrarArticulosOferta();


    }
    public function render()
    {
        return view('livewire.oferta.oferta-create');
=======
        /*
         $this->mostrarArticulosOferta();
*/

    }
    protected $queryString = [
        'q'=>['except'=>'']
    ];
    public function render()
    {
        $articulos=Articulo::where('activo',1)
            ->when($this->q, function ($query){
                               return $query->where( function($query){
                                            $query->where('articulo','like','%'.$this->q.'%')
                                                    ->orwhere('detalles','like','%'. $this->q .'%')
                                                    ->orwhere('categoria','like','%'.$this->q.'%');
                                        });
                                    })
            ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.activo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id')->get();
        return view('livewire.oferta.oferta-create',compact('articulos'));
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
    }
    public function seVendio($id){
        $venta = Venta::where('articulo_id', $id)->select(DB::raw('SUM(cantidad) as total_vendido'))->first();

        if ($venta->total_vendido > 0) {
           return $venta->total_vendido;
        } else {
             return 0;
        }
    }
<<<<<<< HEAD
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
=======
    public function articulosQuery()  {
        /*  return $this->articulos=Articulo::where('activo',1)
         ->when($this->q, function ($query){
                            return $query->where( function($query){
                                         $query->where('articulo','like','%'.$this->q.'%')
                                                 ->orwhere('detalles','like','%'. $this->q .'%')
                                                 ->orwhere('categoria','like','%'.$this->q.'%');
                                     });
                                 })

         ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
         'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
         'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.activo')
         ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
         ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
         ->join('stocks', 'stocks.articulo_id','=','articulos.id'); */
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701

    }
    public $artOferta=[];
    public function ofertaArtQuery()
    {
<<<<<<< HEAD
        $this->artOferta;
        $var= OfertaArt::all();
        if ($var->isNotEmpty()) {
            $this->artOferta=$var;
=======
        if (OfertaArt::all()->isNotEmpty()) {
            $this->artOferta=OfertaArt::all();
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
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
<<<<<<< HEAD
    {
        OfertaArt::create([
            'articulo' => $id,
            'cantidad'=>0,
            'precioOfertado'=>0 ]);
=======
    {   $of=Articulo::find($id);
        OfertaArt::create([
            'articulo' => $id,

            'precioO'=>0
         ]);
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
        $this->articulosQuery();
    }
    public function deleteOferta($id){
        OfertaArt::where('articulo',$id)->delete();
        $this->articulosQuery();
<<<<<<< HEAD
        $this->ofertaArtQuery();
=======
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701


    }
    public function delete(){
        OfertaArt::truncate();
        $this->articulosQuery();
<<<<<<< HEAD
        $this->ofertaArtQuery();

    }
    public $mostrarLabel=false;
=======

    }
    public $mostrarLabel=false;

>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
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
<<<<<<< HEAD

    $this->ofertaArtQuery();

=======
        $this->ofertaArtQuery();
>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701

    }
    public $artOfertados=[];
    public function mostrarArticulosOferta(){
<<<<<<< HEAD
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
=======
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
    public $confirmacion=false;
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

        $this->crearOfertaArticulos($ultima->id);
        $this->crearArticulo($ultima->id);
        $this->crearStock($ultima->id);

        OfertaArt::truncate();

        $this->confirmacion=true;

    }
    public function ConfirmarOferta(){
        $this->confirmacion=false;
        $this->mostrarLabel=false;
        $this->oferta=null;
        $this->detalles=null;
        $this->precio=null;
         $this->tiempo=null;

    }
    /* FUNCIONES */
    public function crearOfertaArticulos($ofertaid){
        $ofs=OfertaArt::join('articulos', 'oferta_art.articulo', '=', 'articulos.id')
        ->select('articulos.id','articulos.precioI','articulos.precioF','oferta_art.precioO')
        ->get();
        foreach( $ofs as $of){
            OfertaArticulos::create([
                'oferta_id'=>$ofertaid,
                'articulo'=>$of->id,
                'cantidad'=>$this->numeroDeOferta(),
                'precioI'=>$of->precioI,
                'precioF'=>$of->precioF,
                'precioO'=>$of->precioO
            ]);
        }
    }
    public function crearArticulo($ofertaid){
        $oferta=Ofertas::find($ofertaid);
        $Articulos=Ofertas::join('oferta_articulos', 'ofertas.id', '=', 'oferta_articulos.oferta_id')
        ->join('articulos', 'oferta_articulos.articulo', '=', 'articulos.id')
        ->select('ofertas.oferta', 'ofertas.id', 'articulos.articulo', 'articulos.id as articulo_id',
            'oferta_articulos.cantidad', 'articulos.presentacion','oferta_articulos.precioI', 'oferta_articulos.precioF', 'oferta_articulos.precioO',
            'ofertas.created_at as fechInicio', 'ofertas.detalles', 'ofertas.precio')
            ->where('oferta_articulos.oferta_id', $ofertaid)->get();

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
                'activo'=>0
            ]);

    }

    public function crearStock($ofertaid){
    $stockOferta=OfertaArticulos::where('oferta_articulos.oferta_id', $ofertaid)->first();

        $Artultimo=Articulo::latest()->first();
        Stock::create([
            'articulo_id'=>$Artultimo->id,
            'stockMinimo'=>0,
            'stock'=>$stockOferta->cantidad,
            'proveedor_id'=>1
        ]);
        $ofertaarticulo_id = Ofertas::where('id', $ofertaid)->first();
        $ofertaarticulo_id->update(['articulo_id' => $Artultimo->id]);

        $articulosOferta = OfertaArticulos::where('oferta_id', $ofertaid)->get();
        foreach ($articulosOferta as $articuloOferta) {
            $stockAtualizar = Stock::where('articulo_id', $articuloOferta->articulo)->first();
            if ($stockAtualizar) {
                $nuevoStock = $stockAtualizar->stock - $articuloOferta->cantidad;
                $stockAtualizar->update(['stock' => $nuevoStock]);
            }
        }
    }
    public function Ofeta($id){
        $stock=Stock::where('articulo_id',$id)->first();
        $ofertaArt = Ofertas::where('articulo_id', $id)->exists();
        return ($ofertaArt || $stock->stock <= 0) ? true : false;
    }
}

>>>>>>> 3aa5920402a6ea09fb3ca6512bce8cb5e0420701
