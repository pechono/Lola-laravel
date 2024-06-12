<?php

namespace App\Livewire;

use App\Models\Operacion;
use App\Models\Venta;
use Livewire\Component;

class ListOperacionlivewire extends Component
{
    public function render()
    {
        $ops=Operacion::join('ventas','ventas.operacion','=','operacions.id')
                                ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                                ->join('users','users.id','=','operacions.usuario_id')
                                ->join('clientes','clientes.id','=','operacions.cliente_id')
                                ->select('operacions.id','operacions.venta','clientes.apellido','clientes.nombre',
                                'users.name','operacions.created_at AS Fecha', 'tipo_ventas.tipoVenta')->distinct()
                                ->orderBy('operacions.id', 'desc')
                                ->get();

        return view('livewire.list-operacionlivewire',compact('ops'));
    }
    public $verOperacion=false;
    public $ventaOp=[];
    public $operacion;
    public $cliente;
    public $fecha;
    public $usuario;
    public $tipo;
    public function verOp($idOp){


        $this->ventaOp=Operacion::join('ventas','ventas.operacion','=','operacions.id')
                        ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                        ->join('users','users.id','=','operacions.usuario_id')
                        ->join('clientes','clientes.id','=','operacions.cliente_id')
                        ->join('articulos','articulos.id','=', 'ventas.articulo_id')
                        ->join('unidads','unidads.id','=','articulos.unidad_id')
                        ->select('operacions.id','operacions.venta','clientes.apellido','clientes.nombre',
                        'users.name','operacions.created_at AS Fecha', 'tipo_ventas.tipoVenta',
                        'articulos.articulo', 'ventas.precioF','ventas.cantidad', 'articulos.presentacion','unidads.unidad','ventas.descuento')
                        ->where('operacions.id',$idOp)->get();

        $os=Operacion::join('ventas','ventas.operacion','=','operacions.id')
                    ->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                    ->join('users','users.id','=','operacions.usuario_id')
                    ->join('clientes','clientes.id','=','operacions.cliente_id')
                    ->join('articulos','articulos.id','=', 'ventas.articulo_id')
                    ->join('unidads','unidads.id','=','articulos.unidad_id')
                    ->select('operacions.id','operacions.venta','clientes.apellido','clientes.nombre',
                    'users.name','operacions.created_at AS Fecha', 'tipo_ventas.tipoVenta')
                    ->where('operacions.id',$idOp)->distinct()->get();

        foreach($os as $o){

                    $this->operacion=$o->id;
                    $this->cliente=$o->apellido .', ' .$o->nombre;
                    $this->fecha=$o->Fecha;
                    $this->usuario=$o->name;
                    $this->tipo=$o->tipoVenta;
        }


        $this->verOperacion=true;


    }
}
