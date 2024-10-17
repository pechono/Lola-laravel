<?php

namespace App\Livewire\Stock;
use Illuminate\Database\Eloquent\ModelNotFoundException;


use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\HistoriasPrecio;
use App\Models\PedidoCar;
use App\Models\Proveedor;
use App\Models\Stock;
use App\Models\Suelto;
use App\Models\Unidad;
use Livewire\Component;
use Livewire\Features\SupportNavigate\ThirdPage;
use Livewire\WithPagination;

use function Laravel\Prompts\select;

class PedidoLivewire extends Component
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
        $this->hasRecords = PedidoCar::count();

        $articulos=Articulo::where('articulos.activo',$this->active)
            ->when($this->q, function ($query){
                               return $query->where( function($query){
                                            $query->where('articulo','like','%'.$this->q.'%')
                                                  ->orwhere('nombre','like','%'.$this->q.'%')
                                                  ->orwhere('categoria','like','%'.$this->q.'%');
                                        });
                                    })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo', 'proveedors.nombre')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id','=','articulos.id')
            ->join('proveedors', 'proveedors.id', '=', 'stocks.proveedor_id')
            ->get();

            $inTheCar=PedidoCar::all();

        return view('livewire.stock.pedidolivewire',compact('articulos','inTheCar'));
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

    public $agregarCar=false;
    public $id;
    public $art;
    public $categoria;
    public $presentacion;
    public $unidad;
    public $pedido;
    public $stockMinimo;
    public $stock;
    public $proveedor;
    public $var=0;
    public $msj='';
    public $hasRecords;

    public function addCar($id) {
        $this->var=1;
        $this->agregarCar=true;
        $articulo = Articulo::where('articulos.id', $id)
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->join('proveedors', 'proveedors.id', '=', 'stocks.proveedor_id')
        ->select('articulos.id','articulos.articulo','categorias.categoria',
            'articulos.presentacion','unidads.unidad','articulos.descuento',
            'articulos.unidadVenta','articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles',
            'articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo','proveedors.nombre')
        ->first();
        $this->id=$articulo->id;
        $this->art=$articulo->articulo;
        $this->categoria=$articulo->categoria;
        $this->presentacion=$articulo->presentacion;
        $this->unidad=$articulo->unidad;
        $this->stock=$articulo->stock;
        $this->stockMinimo=$articulo->stockMinimo;
        $this->proveedor=$articulo->nombre;
        $this->msj='Cantidad a Solicitar';

    }
    protected $rules=['pedido'=>'required|numeric' ];
    public function crearPedido()
    {
         $this->validate();
        PedidoCar::create([
            'articulo_id'=>$this->id,
            'cantidad'=>$this->pedido
        ]);
        $this->agregarCar=false;
        $this->var=0;
    }
    public function ModCar($id)
    {
        $this->agregarCar=true;
        $this->var=2;
        $articulo = Articulo::where('articulos.id', $id)
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->join('proveedors', 'proveedors.id', '=', 'stocks.proveedor_id')
        ->select('articulos.id','articulos.articulo','categorias.categoria',
            'articulos.presentacion','unidads.unidad','articulos.descuento',
            'articulos.unidadVenta','articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles',
            'articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo','proveedors.nombre')
        ->first();
        $this->id=$articulo->id;
        $this->art=$articulo->articulo;
        $this->categoria=$articulo->categoria;
        $this->presentacion=$articulo->presentacion;
        $this->unidad=$articulo->unidad;
        $this->stock=$articulo->stock;
        $this->stockMinimo=$articulo->stockMinimo;
        $this->proveedor=$articulo->nombre;

        try {
            $p = PedidoCar::where('articulo_id', $id)->firstOrFail();
            $this->pedido = $p->cantidad;
        } catch (ModelNotFoundException $e) {
            $this->pedido = 0;
        }
        $this->msj='Modificar la Cantidad Solicitada';
    }
    public function modPedido($id){
        $car=PedidoCar::first()->where('articulo_id',$id);
        $car->update([
            'cantidad'=>$this->pedido
        ]);
        $this->agregarCar=false;
        $this->var=0;

    }
    public $eliminar=false;
    public function elimCar($id)
    {
        $this->eliminar=true;
        $articulo = Articulo::where('articulos.id', $id)
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->join('proveedors', 'proveedors.id', '=', 'stocks.proveedor_id')
        ->select('articulos.id','articulos.articulo','categorias.categoria',
            'articulos.presentacion','unidads.unidad','articulos.descuento',
            'articulos.unidadVenta','articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles',
            'articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo','proveedors.nombre')
        ->first();
        $this->id=$articulo->id;
        $this->art=$articulo->articulo;
        $this->categoria=$articulo->categoria;
        $this->presentacion=$articulo->presentacion;
        $this->unidad=$articulo->unidad;
        $this->stock=$articulo->stock;
        $this->stockMinimo=$articulo->stockMinimo;
        $this->proveedor=$articulo->nombre;

        try {
            $p = PedidoCar::where('articulo_id', $id)->firstOrFail();
            $this->pedido = $p->cantidad;
        } catch (ModelNotFoundException $e) {
            $this->pedido = 0;
        }
    }
    public function eliminarElementCar($id) {
        $artElimin=PedidoCar::where('articulo_id',$id)->delete();
        $this->eliminar=false;
    }
    public $borrar=false;
    public function borrarCar(){
        $this->borrar=true;
    }
    public function confirmarElimin(){
        PedidoCar::truncate();
        $this->borrar=false;

    }

}


