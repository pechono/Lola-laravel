<?php

namespace App\Livewire;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\HistoriasPrecio;
use App\Models\Ofertas;
use App\Models\Proveedor;
use App\Models\Stock;
use App\Models\Suelto;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;


class Articulolivewire extends Component
{
    use WithPagination;

    public $active=1;
    public $q;

    public $sortBy='id';
    public $sortAsc=true;
    public $f;

    public $a;
    public $suel=0;
    public $cad='No';

    protected $queryString = [
        'q'=>['except'=>''],
        'sortBy'=>['except'=>'id'],
        'sortAsc'=>['except'=>true],
    ];
    public $categorias=[];
    public function render()
    {
        $articulos=Articulo::where('activo',$this->active)
            ->when($this->q, function ($query){
                               return $query->where( function($query){
                                            $query->where('articulo','like','%'.$this->q.'%')
                                                    ->orwhere('detalles','like','%'. $this->q .'%')
                                                    ->orwhere('categoria','like','%'.$this->q.'%');
                                        });
                                    })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.activo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id');

        $articulos=$articulos->paginate(10);
        $this->categorias=Categoria::All();
        $unidades=Unidad::all();
        $proveedores=Proveedor::all();
        return view('livewire.articulolivewire', compact('articulos','unidades', 'proveedores'));
    }
    public function sortby($field)
    {
        if($field==$this->sortBy)
        {
            $this->sortAsc=!$this->sortAsc;
        }

        $this->sortBy=$field;
    }

    public function updatingActive()
    {
        $this->resetPage();
    }
    public function updatingO()
    {
        $this->resetPage();
    }
     /* ----------------------Eliminar Articulo--------------------------- */
     public $confirmingArticuloDeletion=false;
     public $idArt;
     public function confirmarArticuloDeletion($id)
     {
         $this->confirmingArticuloDeletion=true;
         $this->idArt=$id;
     }

     public function deleteArticulo()
     {
        $art=Articulo::find($this->idArt);
        $art->update([
            'activo'=>0,
         ]);
         $this->borrarCampos();

         $this->confirmingArticuloDeletion=false;
     }
     public function borrarCampos(){
        $this->articulo='';
         $this->categoria_id='';
         $this->presentacion='';
         $this->unidad_id='';
         $this->descuento='';
         $this->unidadVenta='Unidad';
         $this->precioF='';
         $this->precioI='';
         $this->caducidad='';
         $this->detalles='';
         $this->suelto='';
         $this->stockMinimo='';
         $this->stock='';
         $this->proveedor_id='';
     }

    public $articulo, $categoria_id, $presentacion, $unidad_id;

    public $descuento, $unidadVenta='Unidad', $precioF, $precioI, $caducidad;

    public $detalles, $suelto, $porcentaje, $idArtitulo;
    public $proveedor_id, $stock, $stockMinimo;

    public function calcular()
    {
        $this->precioF=(($this->precioI *$this->porcentaje)/(100))+$this->precioI;
    }

    public $confirmingArticuloAdd=false;
    public $confirmingArticuloEdit=false;
    // //reglas de validacion de Articulo

     protected $rules=[
        'articulo'=>'required|string|min:4',
        'categoria_id'=>'required',
        'presentacion'=>'required|string|min:1',
        'unidad_id'=>'required',
        'descuento'=>'required|numeric',
        'unidadVenta'=>'required|string|min:1',
        'precioI'=>'required|numeric|min:1',
        'precioF'=>'required|numeric|min:1',
        'caducidad'=>'required|string|min:2',
        'detalles'=>'required|string',
        'suelto'=>'boolean',
        'stock'=>'required|numeric|min:1',
        'stockMinimo'=>'required|integer|min:1',
        'proveedor_id'=>'required'
    ];

    


    public function confirmarArticuloAdd()
    {
       $this->confirmingArticuloAdd=true;
    }

    public function saveArticulo(){

            $this->caducidad='No';
            $this->suelto=0;
        

         $this->validate([
            'articulo'=>'required|string|min:4',
            'categoria_id'=>'required',
            'presentacion'=>'required|string|min:1',
            'unidad_id'=>'required',
            'descuento'=>'required|numeric',
            'unidadVenta'=>'required|string|min:1',
            'precioI'=>'required|numeric|min:1',
            'precioF'=>'required|numeric|min:1',
            'caducidad'=>'required|string|min:2',
            'detalles'=>'required|string',
            'suelto'=>'boolean',
            'stock'=>'required|numeric|min:1',
            'stockMinimo'=>'required|integer|min:1',
            'proveedor_id'=>'required'
        ]);

        Articulo::create([
            'articulo'=>  $this->articulo,
            'categoria_id'=>  $this->categoria_id,
            'presentacion'=>  $this->presentacion,
            'unidad_id'=>  $this->unidad_id,
            'descuento'=>  $this->descuento,
            'unidadVenta'=>  $this->unidadVenta,
            'precioF'=>  $this->precioF,
            'precioI'=>  $this->precioI,
            'caducidad'=>  $this->caducidad,
            'detalles'=>  $this->detalles,
            'suelto'=>  $this->suelto,
            'activo'=>1
        ]);
        try {
            Articulo::create([
                'articulo'=>  $this->articulo,
                'categoria_id'=>  $this->categoria_id,
                'presentacion'=>  $this->presentacion,
                'unidad_id'=>  $this->unidad_id,
                'descuento'=>  $this->descuento,
                'unidadVenta'=>  $this->unidadVenta,
                'precioF'=>  $this->precioF,
                'precioI'=>  $this->precioI,
                'caducidad'=>  $this->caducidad,
                'detalles'=>  $this->detalles,
                'suelto'=>  $this->suelto,
                'activo'=>1
            ]);        
        } 
            catch (\Exception $e) {
            dd($e->getMessage());
        }
        


        $ultimo=Articulo::latest()->first();
        Stock::create([
            'articulo_id'=>$ultimo->id,
            'stockMinimo'=>$this->stockMinimo,
            'stock'=>$this->stock,
            'proveedor_id'=>$this->proveedor_id
        ]);

        if($this->suelto==1){
            Suelto::create([
                'articulo_id'=>$this->suelto
            ]);
        }

        HistoriasPrecio::create([
             'articulo_id'=>$ultimo->id,
             'precioFinal'=>$this->precioF,
             'precioIcial'=>$this->precioI
        ]);
        $this->borrarCampos();
        $this->confirmingArticuloAdd=false;
    }
    /* ----------------------Fin Agregar Cliente--------------------------- */
    /* ----------------------Fin Agregar Cliente--------------------------- */

    public function confirmarArticuloEdit($artEdit )
    {
        $edit=Articulo::where('activo',$this->active)
        ->select('articulos.id', 'articulos.articulo',  'articulos.presentacion',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.unidad_id','articulos.categoria_id','proveedor_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->find($artEdit);
            $this->articulo=$edit->articulo;
            $this->categoria_id=$edit->categoria_id;
            $this->presentacion=$edit->presentacion;
            $this->unidad_id=$edit->unidad_id;
            $this->descuento=$edit->descuento;
            $this->unidadVenta=$edit->unidadVenta;
            $this->detalles=$edit->detalles;
            $this->idArtitulo=$edit->id;
            $this->confirmingArticuloEdit=true;
    }
    public function updateArticulo(){
        Articulo::where('articulos.id',$this->idArtitulo)->update([
            'articulo'=>$this->articulo,
            'presentacion'=> $this->presentacion,
            'descuento'=>$this->categoria_id,
            'unidadVenta'=> $this->unidadVenta,
            'categoria_id'=>$this->categoria_id,
            'detalles'=>$this->detalles,
            'unidad_id'=>$this->unidad_id
        ]);
        $this->confirmingArticuloEdit=false;
        $this->borrarCampos();

    }

    public $activarArt=false;
    public $articuloId;
    public function ActivarArticuloEdit($id ){
        $this->activarArt=true;
        $this->articuloId=$id;
    }
    public function ConfirmarActivar(){
        $art=Articulo::find($this->articuloId);
        $art->update([
            'activo'=>1,
         ]);
         $this->activarArt=false;
    }

    public $categoriaAdd=false;
    public $categoria;
    public function addCategoria(){
        $this->categoriaAdd=true;

    }
    public function saveCategoria()  {
        $this->validate(['categoria'=>'required|min:3']);
        Categoria::create([
            'categoria'=>$this->categoria
        ]);
        $this->categorias=Categoria::All();
        $this->categoriaAdd=false;
    }
    public function Ofeta($id){
        $ofertaArt = Ofertas::where('articulo_id', $id)->exists();
        return $ofertaArt ? true : false;
    }
}



