<?php

namespace App\Livewire\Gestion\Precio;

use App\Models\Articulo;
use Livewire\Component;

class CambiarPrecio extends Component
{
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
                                            $query->where('articulo','like','%'.$this->q.'%')->orwhere('detalles','like','%'. $this->q .'%')->orwhere('categoria','like','%'.$this->q.'%');
                                        });
                                    })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad','articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')->join('stocks', 'stocks.articulo_id','=','articulos.id')
            ->get();

        return view('livewire.gestion.precio.cambiar-precio',compact('articulos'));
    }
    
    public $modalPrecio=false;
    public $art=[];
    public function cambiarPrecio($id)
    {

        $this->modalPrecio=$id;
        $this->art=Articulo::select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad','articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->find($id);
    }
    public $precioF, $precioI, $porcentaje;

    protected $rules=[
        'precioI'=>'required|numeric',
        'precioF'=>'required|numeric',

    ];

    public function calcular()
    {   $this->validate([ 'precioI'=>'required|numeric', 'porcentaje'=>'required|numeric',]);
        $this->precioF=(($this->precioI *$this->porcentaje)/(100))+$this->precioI;

        $this->art=Articulo::select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad','articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->find($this->modalPrecio);

    }

    public function nuevoPrecio($id)
    {
        $this->validate();
        $cambio=Articulo::find($id);
        $cambio->update([
            'precioI'=>$this->precioI,
            'precioF'=>$this->precioF,
        ]);
        $this->modalPrecio=false;
        
    }
    public function cerrar(){
        $this->modalPrecio=false;
    }




}
         