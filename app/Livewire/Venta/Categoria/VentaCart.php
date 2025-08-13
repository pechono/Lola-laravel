<?php

namespace App\Livewire\Venta\Categoria;

use App\Models\Articulo;
use App\Models\Car;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Ofertas;
use App\Models\Operacion;
use App\Models\Stock;
use App\Models\TipoVenta;
use App\Models\Venta;
use Carbon\CarbonPeriod;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\If_;

class VentaCart extends Component
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
    public $total=0;
    // public $inTheCar=[];

    protected $queryString = [
        'q'=>['except'=>''],
        'sortBy'=>['except'=>'id'],
        'sortAsc'=>['except'=>true],
    ];

    protected $rules=[
        'apellido'=>'required|string|min:4',
        'nombre'=>'required|string|min:4',
        'telefono'=>'required|string|min:4',
        'activo'=>'boolean',
        'tipo_id'=>'required|integer',
        'cliente_id'=>'required|integer',
        'detalles'=>'required|string|min:4',
        'cuentaCorriente'=>'required|float',
         ];
    public $BloquearBoton;
    public function cancelarBoton(){
        if (Car::exists()) {
              $this->BloquearBoton=true;
        } else {
            $this->BloquearBoton=false;
        }
    }
    public $estaEnCarrito;
    public function render()
    {
        $articulos = collect(); // Colección vacía por defecto

       
            $articulos = Articulo::where('activo', $this->active)
                ->select('articulos.id', 'articulos.codigo','articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
                    'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
                    'articulos.suelto', 'articulos.activo', 'stocks.stock', 'stocks.stockMinimo','articulos.categoria_id')
                ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
                ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
                ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
                ->get();
        

        $inTheCar = Car::where('user_id', auth()->user()->id)
        ->join('articulos', 'cars.articulo_id', '=', 'articulos.id')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->select('articulos.id', 'articulos.codigo', 'articulos.articulo','articulos.categoria_id', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo', 'stocks.stock', 'stocks.stockMinimo', 'cars.cantidad', 'cars.articulo_id', 'cars.descuento')
        ->get();
    
        /* foreach ($articulos as $articulo){
             $this->estaEnCarrito = $inTheCar->contains('articulo_id', $articulo->id);
        } */
        $countCar = Car::count();
        $tipoVentas=TipoVenta::all();
        $clientes=Cliente::all();
        $categoris=Categoria::all();
        $this->cancelarBoton();

        return view('livewire.venta.categoria.venta-cart',compact('inTheCar','articulos','countCar','tipoVentas','clientes','categoris'));
    }
    public function Total(){
        $inTheCar = Car::where('user_id', auth()->user()->id)
    ->join('articulos', 'cars.articulo_id', '=', 'articulos.id')
    ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
    ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
    ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
    ->select('articulos.id', 'articulos.articulo', 'articulos.codigo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo', 'stocks.stock', 'stocks.stockMinimo', 'cars.cantidad', 'cars.articulo_id', 'cars.descuento')
    ->get();

        
        $this->total=0;
        foreach($inTheCar as $car){
            $this->total+= ($car->cantidad*$car->precioF)-($car->cantidad*$car->precioF)*$car->descuento/100;
        }
    }
    public $id;
    public $art;
    public $codigo;
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



    public $agregarCant=false;
    public $articulosMuestra=[];
    public function addCar($id)
    {
        $this->articulosMuestra = Articulo::select('articulos.id','articulos.articulo', 'articulos.codigo','categorias.categoria','articulos.presentacion','unidads.unidad','articulos.descuento','articulos.unidadVenta',
            'articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles','articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->where('articulos.activo', $this->active)
        ->find($id);


        $this->agregarCant=1;
    }
    public function modCar($id){
        $this->articulosMuestra = Articulo::select('articulos.id', 'articulos.codigo','articulos.articulo','categorias.categoria','articulos.presentacion','unidads.unidad','articulos.descuento','articulos.unidadVenta',
        'articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles','articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->where('articulos.activo', $this->active)
        ->find($id);

        $update=Car::where('user_id', auth()->user()->id)->where('articulo_id','=',$id)->first();
        $this->cantidadArt=$update->cantidad;

    $this->agregarCant=2;

    }
    public function updateSave($idart,$stockArt){
       
        if ($stockArt >= $this->cantidadArt) {
            $this->validate(['cantidadArt' => 'required|numeric']);
            Car::where('user_id', auth()->user()->id)
               ->where('articulo_id', '=', $idart)
               ->update(['cantidad' => $this->cantidadArt]);
            $this->agregarCant = false;
            $this->Total();
            $this->q = '';
        } else {
            $this->modCar($idart);
            $this->majStock = $this->cantidadArt;//"Stock Insuficiente para realizar esta operacion";
        }
    }

    public $majStock='--';
    public function save($idart,$stockArt){
        $this->addCar($idart);
        if ($stockArt >= $this->cantidadArt){
            $this->validate(['cantidadArt'=>'required|numeric']);
            $this->addCar($idart);
            Car::create([
                'articulo_id'=>$idart,
                'cantidad'=>$this->cantidadArt,
                'user_id'=>auth()->user()->id,
                
                'operacionCar'=>100
            ]);
            $this->agregarCant=false;
            $this->Total();
            $this->q='';

        }else{
            $this->addCar($idart);
            $this->majStock="Stock Insuficiente para realizar esta operacion";
        }
    }

    public function deletCar($id){
        Car::where('articulo_id', '=', $id)
            ->where('user_id', auth()->user()->id)
            ->delete();
    
        $this->cancelarBoton();
        $this->Total();
        $this->render();
    }

    public $cDescuento=false;
    public function descuentoArt($id){

        $articulos=Articulo::select('articulos.id', 'articulos.codigo','articulos.articulo','categorias.categoria','articulos.presentacion','unidads.unidad','articulos.descuento','articulos.unidadVenta',
                                    'articulos.precioF','articulos.precioI','articulos.caducidad','articulos.detalles','articulos.suelto','articulos.activo','stocks.stock','stocks.stockMinimo')
            ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
            ->where('articulos.activo', $this->active)
            ->find($id);

            $this->id=$articulos->id;
            $this->codigo=$articulos->codigo;
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
            // $this->Total();
    }

    public function saveDescuento($idart){
        $this->validate(['descArt'=>'required|numeric']);
        Car::where('user_id', auth()->user()->id)->where('articulo_id',$idart)->update([
            'descuento'=>$this->descArt
        ]);
        $this->cDescuento=false;
        $this->Total();
    }
    public $confirmingArticuloOperacion=false;

    public $totalV=0;
    public $cuentaCorriente=0;
    public $tipo_id;
    public $cliente_id;
    public $ac='display:none';
    public $operacion;
    // -----------op
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

        $inTheCar = Car::where('user_id', auth()->user()->id)
        ->join('articulos', 'cars.articulo_id', '=', 'articulos.id')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
        ->select('articulos.id', 'articulos.codigo', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
            'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
            'articulos.suelto', 'articulos.activo', 'stocks.stock', 'stocks.stockMinimo', 'cars.cantidad', 'cars.articulo_id', 'cars.descuento')
        ->get();
    
        // $this->Total();
        $this->validate(['tipo_id'=>'required|numeric','cliente_id'=>'required|numeric']);

         if($this->tipo_id==4)
         {
             Operacion::create([
                 'usuario_id'=>auth()->user()->id,
                 'tipoVenta_id'=>$this->tipo_id,
                 'cliente_id'=>$this->cliente_id,
                 'detalles'=>'-',
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
                 'detalles'=>'-',
                 'venta'=>$this->total,

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

         Car::where('user_id', auth()->user()->id)->delete();//Car::truncate();
         $this->cliente_id='';
         $this->tipo_id='';
         $this->cancelarBoton();
         return redirect()->route('venta.reporte',['operacion'=>$operacion,'volver'=>'venta.ventaCard']);
     }

     public $apellido;
     public $nombre;
     public $telefono;
     public $activo=1;

     public $confirmingClienteAdd=false;
     public function confirmarClienteAdd()
     {

         $this->confirmingClienteAdd=true;
     }

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
     {   $this->cancelarBoton();
         Car::truncate();
         $this->cliente_id='';
         $this->tipo_id='';
         return redirect()->route('venta.ventaCard');
     }
     public function Ofeta($id){
        $ofertaArt = Ofertas::where('articulo_id', $id)->exists();
        return $ofertaArt ? true : false;
    }
    public function stockInsufisinte($id){
        $stock=Stock::where('articulo_id',$id)->first();

        return $stock->stock<=0 ? true : false;
    }
    public function estaEnCarrito ($articulo){
        return $inTheCar = Car::where('user_id', auth()->user()->id)->get()->contains('articulo_id', $articulo);

   }

}

