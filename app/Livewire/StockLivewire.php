<?php

namespace App\Livewire;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\HistoriasPrecio;
use App\Models\Proveedor;
use App\Models\Stock;
use App\Models\Suelto;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\WithPagination;

class StockLivewire extends Component
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
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id');

        $articulos=$articulos->paginate(10);
        $categorias=Categoria::All();
        $unidades=Unidad::all();
        $proveedores=Proveedor::all();
        return view('livewire.stock-livewire',compact('articulos','categorias','unidades', 'proveedores'));
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
    public $idArt;
    public $articulo;
    public $categoria_id;
    public $presentacion;
    public $unidad_id;
    public $descuento;
    public $unidadVenta;
    public $precioF;
    public $precioI;
    public $caducidad;
    public $detalles;
    public $suelto;
    public $porcentaje;

    public $proveedor_id;
    public $stock;
    public $stockMinimo;
    public $confirmingArticuloEdit=false;
    public $ConfirmarCambioStock=false;

    public function confirmarArticuloEdit($artEdit )
    {
        $edit=Articulo::where('activo',$this->active)
        ->select('articulos.id', 'articulos.articulo',  'articulos.presentacion',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.unidad_id','articulos.categoria_id','proveedor_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->find($artEdit);
            $this->idArt=$edit->id;
            $this->articulo=$edit->articulo;
            $this->categoria_id=$edit->categoria_id;
            $this->presentacion=$edit->presentacion;
            $this->unidad_id=$edit->unidad_id;
            $this->descuento=$edit->descuento;
            $this->unidadVenta=$edit->unidadVenta;
            $this->precioF=$edit->precioF;
            $this->precioI=$edit->precioI;
            $this->caducidad=$edit->caducidad;
            $this->detalles=$edit->detalles;
            $this->suelto=$edit->suelto;
            $this->stockMinimo=$edit->stockMinimo;
            $this->stock=$edit->stock;
            $this->proveedor_id=$edit->proveedor_id;

            $this->confirmingArticuloEdit=true;

    }
    protected $rules=[
        'stock'=>'required|numeric',
        'stockMinimo'=>'required|numeric'
    ];

    public function CambiarStock($id)
    {
        $this->validate();
        $cambio=Stock::where('id',$id)->first();
        $cambio->update([
            'stock'=>$this->stock,
            'stockMinimo'=>$this->stockMinimo
        ]);
        $this->ConfirmarCambioStock=false;
        $this->confirmingArticuloEdit=false;
    }
    public function preguntaCambiarStock()
    {
        $this->ConfirmarCambioStock=true;

    }
    public $confirmingArticuloDeletion=false;
     public $idArtM;
     public function confirmarArticuloDeletion($id)
     {
         $this->confirmingArticuloDeletion=true;
         $this->idArtM=$id;
     }

     public function deleteArticulo()
     {
        $art=Articulo::find($this->idArtM);
        $art->update([
            'activo'=>0,
         ]);
         $this->articulo='';
         $this->categoria_id='';
         $this->presentacion='';
         $this->unidad_id='';
         $this->descuento='';
         $this->unidadVenta='';
         $this->precioF='';
         $this->precioI='';
         $this->caducidad='';
         $this->detalles='';
         $this->suelto='';
         $this->stockMinimo='';
         $this->stock='';
         $this->proveedor_id='';

         $this->confirmingArticuloDeletion=false;
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
}
