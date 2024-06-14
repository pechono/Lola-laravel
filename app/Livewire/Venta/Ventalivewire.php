<?php

namespace App\Livewire\Venta;

use App\Models\Articulo;
use App\Models\Car;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Ventalivewire extends Component
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
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id');
        $articulos=$articulos->paginate(10);

        $inTheCar=Car::join('articulos','cars.articulo_id','=','articulos.id')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->select( 'articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo', 'cars.cantidad','cars.articulo_id','cars.descuento')->get();


       $countCar=Car::count();

        return view('livewire.venta.ventalivewire', compact('articulos','inTheCar','countCar'));
    }
    public $id;
    public $art;
    public $categoria;
    public $presentacion;
    public $unidad;
    public $descuento;
    public $unidadVenta;
    public $precioF;
    public $precioI;
    public $caducidad;
    public $detalles;
    public $suelto;
    public $porcentaje;
    public $msj;
    public $descArt=0;
    public $cantidadArt;
    public $proveedor_id;
    public $stock;
    public $stockMinimo;

    protected $rules=[
        'cantidadArt'=>'required|numeric',
        'descArt'=>'required|numeric',

    ];

    public $confirmingVenta=false;
    public function addCar($id)
    {
        $articulos=Articulo::where('activo',$this->active)
        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')->find($id);

            $this->id=$articulos->id;
            $this->art=$articulos->articulo;
            $this->categoria=$articulos->categoria;
            $this->presentacion=$articulos->presentacion;
            $this->unidad=$articulos->unidad;
            $this->descuento=$articulos->descuento;
            $this->unidadVenta=$articulos->unidadVenta;
            $this->precioF=$articulos->precioF;
            $this->precioI=$articulos->precioI;
            $this->caducidad=$articulos->caducidad;
            $this->detalles=$articulos->detalles;
            $this->suelto=$articulos->suelto;
            $this->stockMinimo=$articulos->stockMinimo;
            $this->stock=$articulos->stock;
            $this->proveedor_id=$articulos->proveedor_id;

            $this->confirmingVenta=true;
    }

    public function save($idart){

        $this->validate();
        Car::create([
            'articulo_id'=>$idart,
            'cantidad'=>$this->cantidadArt,
            'user_id'=>auth()->user()->id,
            'operacionCar'=>100
        ]);
        $this->confirmingVenta=false;

    }

    public function deletCar($id){
        Car::where('articulo_id','=',$id)->delete();
    }

    public $cDescuento=false;
    public function descuentoArt($i){

        $articulos=Articulo::where('activo',$this->active)
        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')->find($i);

            $this->id=$articulos->id;
            $this->art=$articulos->articulo;
            $this->categoria=$articulos->categoria;
            $this->presentacion=$articulos->presentacion;
            $this->unidad=$articulos->unidad;
            $this->descuento=$articulos->descuento;
            $this->unidadVenta=$articulos->unidadVenta;
            $this->precioF=$articulos->precioF;
            $this->precioI=$articulos->precioI;
            $this->caducidad=$articulos->caducidad;
            $this->detalles=$articulos->detalles;
            $this->suelto=$articulos->suelto;
            $this->stockMinimo=$articulos->stockMinimo;
            $this->stock=$articulos->stock;
            $this->proveedor_id=$articulos->proveedor_id;

            $this->cDescuento=true;
    }

    public function saveDescuento($idart){
        $this->validate();
        Car::where('articulo_id',$idart)->update([
            'descuento'=>$this->descArt
        ]);
        $this->cDescuento=false;
    }

}
