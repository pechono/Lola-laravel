<?php

namespace App\Livewire\Venta;

use App\Models\Cliente;
use App\Models\CuentaCorriente as ModelsCuentaCorriente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CuentaCorriente extends Component
{
    public function render()
    {
        $clientes = Cliente::join('cuenta_corrientes', 'cuenta_corrientes.cliente_id', '=', 'clientes.id')
        ->select(
            'clientes.id',
            'clientes.apellido',
            'clientes.nombre',
            'clientes.telefono',
            DB::raw('SUM(cuenta_corrientes.entrega) as total_entregas')
        )
        ->groupBy('clientes.id', 'clientes.apellido', 'clientes.nombre', 'clientes.telefono')
        ->orderBy('total_entregas', 'DESC')  // Ordenar por total_entregas en orden descendente
        ->get();
        return view('livewire.venta.cuenta-corriente', compact('clientes'));
    }
    public $verCuentaCorriente=false;
    public $clienteDeuda=[];
    public $cuentaCorriente=[];
    public $entrega;
    protected $rules=[
        'entrega'=>'required'
    ];
    public function modalCuenta($id)
    {
        $this->verCuentaCorriente=true;
        $this->clienteDeuda  = Cliente::join('cuenta_corrientes', 'cuenta_corrientes.cliente_id', '=', 'clientes.id')
        ->select(
            'clientes.id',
            'clientes.apellido',
            'clientes.nombre',
            'clientes.telefono',
            DB::raw('SUM(cuenta_corrientes.entrega) as total_entregas')
        )
        ->where('clientes.id', $id)
        ->groupBy('clientes.id', 'clientes.apellido', 'clientes.nombre', 'clientes.telefono')
        ->orderBy('total_entregas', 'DESC')
        ->first();
        $this->cuentaCorriente=ModelsCuentaCorriente::select('created_at','entrega','cliente_id')->where('cliente_id',$id)->get();
    }
    public function entregarD($cliente){
        $this->validate();
        $this->entrega;
        // $cuenta=ModelsCuentaCorriente::where('id',$cliente)->first();
        ModelsCuentaCorriente::create([
            'entrega'=>-$this->entrega,
            'cliente_id'=>$cliente,
            'usuario_id'=>auth()->user()->id,
            'operacion_id'=>0
        ]);
        
        $this->cuentaCorriente=ModelsCuentaCorriente::select('created_at','entrega','cliente_id')->where('cliente_id',$cliente)->get();
        $this->clienteDeuda  = Cliente::join('cuenta_corrientes', 'cuenta_corrientes.cliente_id', '=', 'clientes.id')
        ->select(
            'clientes.id',
            'clientes.apellido',
            'clientes.nombre',
            'clientes.telefono',
            DB::raw('SUM(cuenta_corrientes.entrega) as total_entregas')
        )
        ->where('clientes.id', $cliente)
        ->groupBy('clientes.id', 'clientes.apellido', 'clientes.nombre', 'clientes.telefono')
        ->orderBy('total_entregas', 'DESC')
        ->first();
        $this->entrega=0;
    }

}
