<?php

namespace App\Livewire\Operacion;

use App\Livewire\Venta\CuentaCorriente;
use App\Models\ArtCuentaCorriente;
use App\Models\Articulo;
use App\Models\Operacion;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

use Livewire\Component;
use Livewire\WithPagination;


class ListOperacionlivewire extends Component
{
    use WithPagination;
    public function render()
    {


        $ops=Operacion::join('ventas','ventas.operacion','=','operacions.id')
                                ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                                ->join('users','users.id','=','operacions.usuario_id')
                                ->join('clientes','clientes.id','=','operacions.cliente_id')
                                ->select('operacions.id','operacions.venta','clientes.apellido','clientes.nombre',
                                'users.name','operacions.created_at AS Fecha', 'tipo_ventas.tipoVenta')->distinct()
                                ->orderBy('operacions.id', 'desc')->paginate();

        return view('livewire.operacion.list-operacionlivewire',compact('ops'));
    }
    public $verOperacion=false;
    public $ventaOp=[];
    public $operacion;
    public $cliente;
    public $fecha;
    public $usuario;
    public $tipo;
    public $tipoId;
    public $venta;
    public $suma;
    public $os=[];
    public $idOp;
    public $listArt;
    public $sumTotal=0;

    public function verOp($oper)
    {

        $this->idOp=$oper;
        $this->ventaOp=Operacion::join('ventas','ventas.operacion','=','operacions.id')
            ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
            ->join('users','users.id','=','operacions.usuario_id')
            ->join('clientes','clientes.id','=','operacions.cliente_id')
            ->join('articulos','articulos.id','=', 'ventas.articulo_id')
            ->join('unidads','unidads.id','=','articulos.unidad_id')
            ->select('operacions.id','operacions.venta','clientes.apellido','clientes.nombre',
            'users.name','operacions.created_at AS Fecha', 'tipo_ventas.tipoVenta',
            'articulos.articulo', 'ventas.precioF','ventas.cantidad', 'articulos.presentacion','unidads.unidad','ventas.descuento')
            ->where('operacions.id', $this->idOp)
        ->get();



        $this->os = Operacion::select(
                'operacions.id',
                'operacions.venta',
                'clientes.apellido',
                'clientes.nombre',
                'users.name',
                'operacions.created_at AS Fecha',
                'tipo_ventas.tipoVenta',
                'tipo_ventas.id as tipoId',
                'ventas.precioF',
                DB::raw('(SELECT SUM(ventas.precioF) FROM ventas INNER JOIN operacions ON ventas.operacion = operacions.id WHERE operacions.id = '. $this->idOp.') AS sumaVentas'))
            ->join('ventas', 'ventas.operacion', '=', 'operacions.id')
            ->join('tipo_ventas', 'tipo_ventas.id', '=', 'operacions.tipoVenta_id')
            ->join('users', 'users.id', '=', 'operacions.usuario_id')
            ->join('clientes', 'clientes.id', '=', 'operacions.cliente_id')
            ->join('articulos', 'articulos.id', '=', 'ventas.articulo_id')
            ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
            ->where('operacions.id', $this->idOp)
            ->groupBy('operacions.id', 'operacions.venta', 'clientes.apellido', 'clientes.nombre', 'users.name', 'operacions.created_at', 'tipo_ventas.tipoVenta', 'tipo_ventas.id', 'ventas.precioF')
        ->get();

        foreach($this->os as $o){

                    $this->operacion=$o->id;
                    $this->cliente=$o->apellido .', ' .$o->nombre;
                    $this->fecha=$o->Fecha;
                    $this->usuario=$o->name;
                    $this->tipo=$o->tipoVenta;
                    $this->tipoId=$o->tipoId;
                    $this->venta=$o->venta;
                    $this->suma=$o->sumaVentas;

        }
        $this->verOperacion=true;
    }
    public $detalles=false;
    
    public function cancelarCuenta($operacion)
    {
        foreach( $this->listArt as  $v){
            $this->sumTotal+=$v->cantidad*$v->precioF;
            $actualizar=Venta::where('operacion',$operacion);
            $actualizar->update([
                'precioF'=>$v->precioF,
                'precioI'=>$v->precioI,
            ]);
        }
        Operacion::where('id',$operacion)->update([
            'venta'=>$this->sumTotal
        ]);

        CuentaCorriente::create([

        ]);
    }
}
