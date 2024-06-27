<?php

namespace App\Livewire\Operacion;

use App\Models\Car;
use App\Models\Cliente;
use App\Models\CuentaCorriente;
use App\Models\Operacion;
use App\Models\Stock;
use App\Models\TipoVenta;
use App\Models\Venta;
use Livewire\Component;



class Operacionlivewire extends Component
{
    public $confirmingArticuloOperacion=false;
    public $detalles;
    public $msj;
    public $totalV=0;
    public $cuentaCorriente=0;
    public $tipo_id;
    public $cliente_id;
    public $ac='display:none';
    public $operacion;


    protected $rules=[
        'tipo_id'=>'required|integer',
        'cliente_id'=>'required|integer',
        'detalles'=>'required|string|min:4',
        'cuentaCorriente'=>'required|float',
        'apellido'=>'required|string|min:4',
        'nombre'=>'required|string|min:4',
        'telefono'=>'required|string|min:4',
        'activo'=>'boolean'
    ];

    public function render()
    {

        $inTheCar=Car::join('articulos','cars.articulo_id','=','articulos.id')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->select( 'articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo', 'cars.cantidad','cars.articulo_id','cars.descuento')->get();
        $total=0;
        foreach($inTheCar as $car){
            $subtotal=($car->cantidad*$car->precioF)-($car->cantidad*$car->precioF)*$car->descuento/100;
            $total+=$subtotal;

        }

        $tipoVentas=TipoVenta::all();
        $clientes=Cliente::all();
        return view('livewire.operacion.operacionlivewire',compact('total','tipoVentas','clientes'));
    }
    public function tipoVenta(){
       if($this->tipo_id==4){
            $this->ac='';
       }else{
            $this->cuentaCorriente=0;
            $this->ac='display:none';
       }
    }

    public function ConfirmarVenta()
    {
        $inTheCar=Car::join('articulos','cars.articulo_id','=','articulos.id')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')
        ->select( 'cars.articulo_id','articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo', 'cars.cantidad','cars.articulo_id','cars.descuento')->get();
        $total=0;

        foreach($inTheCar as $car){
            $subtotal=($car->cantidad*$car->precioF)-($car->cantidad*$car->precioF)*$car->descuento/100;
            $total+=$subtotal;

        }
        if($this->detalles==''){
            $this->detalles='--';
        }

        if($this->tipo_id==4)
        {
            Operacion::create([
                'usuario_id'=>auth()->user()->id,
                'tipoVenta_id'=>$this->tipo_id,
                'cliente_id'=>$this->cliente_id,
                'detalles'=>$this->detalles,
                'venta'=>0,

            ]);
            $operacion=Operacion::latest()->first();
            $id=$operacion->id;
            foreach($inTheCar as $car){
                Venta::create([
                    'articulo_id'=>$car->articulo_id,
                    'cantidad'=>$car->cantidad,
                    'precioI'=>0,
                    'precioF'=>0,
                    'descuento'=>$car->descuento,
                    'operacion'=>$operacion->id,

                ]);
            $changeStock=Stock::where('articulo_id',$car->articulo_id)->first();
            $changeStock->update([
                'stock'=>$changeStock->stock - $car->cantidad,
            ]);


            }

        }else{
            Operacion::create([
                'usuario_id'=>auth()->user()->id,
                'tipoVenta_id'=>$this->tipo_id,
                'cliente_id'=>$this->cliente_id,
                'detalles'=>$this->detalles,
                'venta'=>$total,

            ]);
            $operacion=Operacion::latest()->first();
            $id=$operacion->id;
            foreach($inTheCar as $car){
                Venta::create([
                    'articulo_id'=>$car->articulo_id,
                    'cantidad'=>$car->cantidad,
                    'precioI'=>$car->precioI,
                    'precioF'=>$car->precioF,
                    'descuento'=>$car->descuento,
                    'operacion'=>$operacion->id,

                ]);
                $changeStock=Stock::where('articulo_id',$car->articulo_id)->first();
                $changeStock->update([
                    'stock'=>$changeStock->stock - $car->cantidad,
                ]);

            }
        }

        Car::truncate();
        return redirect()->route('venta.reporte',['operacion'=>$operacion,'volver'=>'venta.ventaExpress']);
    }

    public $apellido;
    public $nombre;
    public $telefono;
    public $activo=1;

    public $confirmingClienteAdd=false;
    public function confirmarClienteAdd()
    {
        //$this->reset(['cliente']);
        $this->confirmingClienteAdd=true;
    }
    /* protected $rules=[

    ]; */
    public function saveCliente(){

        $this->validate();
        Cliente::create([
            'apellido'=>$this->apellido,
            'nombre'=>$this->nombre,
            'telefono'=>$this->telefono,
            'activo'=>1
        ]);
        $this->apellido='';
        $this->nombre='';
        $this->telefono='';
        $this->confirmingClienteAdd=false;
    }
    public $confirmarOpVenta=false;
    public function PreguntaConfirmarVenta(){
        $this->confirmarOpVenta=true;
    }

    public function cancelarOperacion()
    {
        Car::truncate();

        return redirect()->route('venta.index');
    }

}

