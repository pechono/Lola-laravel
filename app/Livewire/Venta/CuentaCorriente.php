<?php

namespace App\Livewire\Venta;

use App\Models\ArtCuentaCorriente;
use App\Models\Operacion;
use App\Models\Cliente;
use App\Models\OpCuentaCorriente;
use App\Models\CuentaCorriente as ModelsCuentaCorriente;
use App\Models\Venta;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CuentaCorriente extends Component
{   public $clientes=[];
    public function render()
    {
        $this->clientes=Cliente::join('operacions','operacions.cliente_id','clientes.id')->join('ventas','ventas.operacion','operacions.id')
            ->select('clientes.id','clientes.apellido','clientes.nombre','clientes.telefono')
            ->where('ventas.precioF',0)->where('ventas.precioI',0)->distinct()->get();
        return view('livewire.venta.cuenta-corriente');
    }
    public $boton=false;
    public $verOperacion=false;
    public $operacions=[];
    public $IdCliente;

    public function mostrar(){
        $this->boton=true;
        $this->operacions=Operacion::join('ventas','ventas.operacion','=','operacions.id')->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')->join('users','users.id','=','operacions.usuario_id')->join('clientes','clientes.id','=','operacions.cliente_id')
            ->join('articulos','articulos.id','=', 'ventas.articulo_id')->join('unidads','unidads.id','=','articulos.unidad_id')
            ->join('categorias','categorias.id','=','articulos.categoria_id')->select('operacions.id','ventas.articulo_id','operacions.venta','clientes.apellido','clientes.nombre',
            'users.name','operacions.created_at AS Fecha','tipo_ventas.tipoVenta','articulos.articulo','articulos.precioI', 'articulos.precioF','ventas.cantidad','articulos.presentacion',
            'unidads.unidad','categoria', 'ventas.descuento','unidadVenta','operacions.created_at')
            ->where('clientes.id',$this->IdCliente)->where('tipo_ventas.id',4) ->where('operacions.venta',0)
        ->orderBy('operacions.id', 'desc')->get();
    }
    public function estaDentro($op)
    {

        return OpCuentaCorriente::where('operacion_id', $op)->exists();
    }
    public function modalCuenta($id)
    {
        $this->IdCliente=$id;
        $this->verOperacion=true;
        $this->operacions=Operacion::join('ventas','ventas.operacion','=','operacions.id')->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
           ->join('users','users.id','=','operacions.usuario_id')->join('clientes','clientes.id','=','operacions.cliente_id')
           ->join('articulos','articulos.id','=', 'ventas.articulo_id')->join('unidads','unidads.id','=','articulos.unidad_id')
           ->join('categorias','categorias.id','=','articulos.categoria_id')->select('operacions.id','ventas.articulo_id','operacions.venta','clientes.apellido','clientes.nombre',
           'users.name','operacions.created_at AS Fecha','tipo_ventas.tipoVenta','articulos.articulo','articulos.precioI','ventas.precioF','ventas.cantidad','articulos.presentacion',
           'unidads.unidad','categoria', 'ventas.descuento','unidadVenta','operacions.created_at')
        ->where('clientes.id',$this->IdCliente)->where('tipo_ventas.id',4)->where('operacions.venta',0)->orderBy('operacions.id', 'desc')
        ->get();

    }
    public $total=0;
    public function PonerPrecio($operacion) {
        $arts=Operacion::join('ventas','ventas.operacion','=','operacions.id')
        ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
        ->join('users','users.id','=','operacions.usuario_id')
        ->join('clientes','clientes.id','=','operacions.cliente_id')
        ->join('articulos','articulos.id','=', 'ventas.articulo_id')
        ->join('unidads','unidads.id','=','articulos.unidad_id')
        ->join('categorias','categorias.id','=','articulos.categoria_id')
        ->select('ventas.id','ventas.articulo_id','operacions.venta','articulos.precioI', 'articulos.precioF','ventas.cantidad')
        ->where('operacions.id',$operacion)
        ->where('tipo_ventas.id',4)
        ->orderBy('operacions.id', 'desc')
        ->get();

        foreach ($arts as $art) {
            $this->total+=$art->precioF*$art->cantidad;
            ArtCuentaCorriente::create([
                'venta_id'=>$art->id,
                'precioI'=>$art->precioI,
                'precioF'=>$art->precioF

            ]);
        }

        OpCuentaCorriente::create([
            'total'=>$this->total,
            'operacion_id'=>$operacion
        ]);

        $this->operacions=Operacion::join('ventas','ventas.operacion','=','operacions.id')->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')->join('users','users.id','=','operacions.usuario_id')->join('clientes','clientes.id','=','operacions.cliente_id')
            ->join('articulos','articulos.id','=', 'ventas.articulo_id')->join('unidads','unidads.id','=','articulos.unidad_id')
            ->join('categorias','categorias.id','=','articulos.categoria_id')->select('operacions.id','ventas.articulo_id','operacions.venta','clientes.apellido','clientes.nombre',
            'users.name','operacions.created_at AS Fecha','tipo_ventas.tipoVenta','articulos.articulo','articulos.precioI', 'articulos.precioF','ventas.cantidad','articulos.presentacion',
            'unidads.unidad','categoria', 'ventas.descuento','unidadVenta','operacions.created_at')
            ->where('clientes.id',$this->IdCliente)->where('tipo_ventas.id',4) ->where('operacions.venta',0)
        ->orderBy('operacions.id', 'desc')->get();

    }
    public function eliminar($operacion)
    {
        $arts=Operacion::join('ventas','ventas.operacion','=','operacions.id')
        ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
        ->join('users','users.id','=','operacions.usuario_id')
        ->join('clientes','clientes.id','=','operacions.cliente_id')
        ->join('articulos','articulos.id','=', 'ventas.articulo_id')
        ->join('unidads','unidads.id','=','articulos.unidad_id')
        ->join('categorias','categorias.id','=','articulos.categoria_id')
        ->select('ventas.id','ventas.articulo_id','operacions.venta','articulos.precioI', 'articulos.precioF','ventas.cantidad')
        ->where('operacions.id',$operacion)
        ->get();

        foreach ($arts as $art) {
            $this->total-=$art->precioF*$art->cantidad;
            ArtCuentaCorriente::where('venta_id',$art->id)->delete();
        }
        OpCuentaCorriente::where('operacion_id',$operacion)->delete();


        $this->operacions=Operacion::join('ventas','ventas.operacion','=','operacions.id')->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')->join('users','users.id','=','operacions.usuario_id')->join('clientes','clientes.id','=','operacions.cliente_id')
            ->join('articulos','articulos.id','=', 'ventas.articulo_id')->join('unidads','unidads.id','=','articulos.unidad_id')
            ->join('categorias','categorias.id','=','articulos.categoria_id')->select('operacions.id','ventas.articulo_id','operacions.venta','clientes.apellido','clientes.nombre',
            'users.name','operacions.created_at AS Fecha','tipo_ventas.tipoVenta','articulos.articulo','articulos.precioI', 'articulos.precioF','ventas.cantidad','articulos.presentacion',
            'unidads.unidad','categoria', 'ventas.descuento','unidadVenta','operacions.created_at')
            ->where('clientes.id',$this->IdCliente)->where('tipo_ventas.id',4) ->where('operacions.venta',0)
        ->orderBy('operacions.id', 'desc')->get();
    }
    public $confirmar=false;
    public function confirmarCuenta(){
        $this->confirmar=true;
    }
    public function ConfirmarPago()
    {
        $operacion=OpCuentaCorriente::all();
        foreach($operacion as $op){
            ModelsCuentaCorriente::create([
                'cliente_id'=>$this->IdCliente,
                'usuario_id'=>auth()->user()->id,
                'operacion_id'=>$op->operacion_id,
                'entrega'=>$this->total,
                'deuda'=>$this->total,
                'cerrado'=>1
                ]);

                $arts=Operacion::join('ventas','ventas.operacion','=','operacions.id')
                ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                ->join('users','users.id','=','operacions.usuario_id')
                ->join('clientes','clientes.id','=','operacions.cliente_id')
                ->join('articulos','articulos.id','=', 'ventas.articulo_id')
                ->join('unidads','unidads.id','=','articulos.unidad_id')
                ->join('categorias','categorias.id','=','articulos.categoria_id')
                ->select('ventas.id','ventas.articulo_id','operacions.venta','articulos.precioI', 'articulos.precioF','ventas.cantidad')
                ->where('operacions.id',$op->operacion_id)
                ->get();

                $subTotalOP=0;
                foreach ($arts as $art) {
                    $subTotalOP+=$art->precioF*$art->cantidad;
                }
            $pagoOp=Operacion::where('operacions.id',$op->operacion_id);
            $pagoOp->update([
                'venta'=>$subTotalOP,
            ]);
        }
        $artC=ArtCuentaCorriente::All();
        foreach ($artC as $art){
            Venta::where('ventas.id',$art->venta_id)->update([
                'precioI'=>$art->precioI,
                'precioF'=>$art->precioF
            ]);
        }
        $this->borrarVar();
    }
    public function borrarVar()
    {
        $this->total=0;
        ArtCuentaCorriente::truncate();
        OpCuentaCorriente::truncate();
        $this->verOperacion=false;
        $this->confirmar=false;
    }
    public function cancelar(){
        $this->borrarVar();
    }

}
