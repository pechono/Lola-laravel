<?php


namespace App\Livewire\Stock;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Pedido;
use App\Models\PedidoCar;
use App\Models\Proveedor;
use Livewire\Component;

class ConfirmarPedido extends Component
{
    public function render()
    {

        $inTheCar=PedidoCar::select('articulos.id','articulos.articulo','categorias.categoria','articulos.presentacion','unidads.unidad',
        'pedido_cars.cantidad')
        ->join('articulos','articulos.id','pedido_cars.articulo_id')
        ->join('categorias','categorias.id','articulos.categoria_id')
        ->join('unidads','unidads.id','articulos.unidad_id')->get();
        $proveedores=Proveedor::all();
        return view('livewire.stock.confirmar-pedido',compact('inTheCar','proveedores'));
    }
    public $proveedor_id;
    protected $rules=['proveedor_id'=>'required'];
    public $operacion;
    public $modal=false;
    public function guardarPedido()
    {
        $this->validate();
        $pedidoCars=PedidoCar::all();


        try {
            // Verificamos si hay algún pedido
            $p = Pedido::latest()->first();
            if ($p) {
                $this->operacion = $p->pedido + 1;
            } else {
                $this->operacion = 1;
            }
        } catch (ModelNotFoundException $e) {
            $this->operacion = 1;
        }
        foreach ($pedidoCars as $car) {
            Pedido::create([
                'articulo_id'=>$car->articulo_id,
                'cantidad'=>$car->cantidad,
                'proveedor_id'=>$this->proveedor_id,
                'pedido'=>$this->operacion
            ]);
        }
       $this->modal=true;

    }

    public function cerrar(){

        PedidoCar::truncate();
        $this->modal=false;
        return redirect()->route('stock.pedido');
    }
}
