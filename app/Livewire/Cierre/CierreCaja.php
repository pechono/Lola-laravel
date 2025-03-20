<?php

namespace App\Livewire\Cierre;

use App\Models\CuentaCorriente;
use App\Models\Operacion;
use App\Models\CierreCaja as ModelsCierreCaja;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CierreCaja extends Component
{
    public $fecha_formateada;
    public $efectivo;
    public $debito;
    public $tarjeta;
    public $cuentaCorientes;
    public $ventasPorTipo ;
    public $hoy;
    public function mount()
    {
        $this->hoy = Carbon::today();
        $this->efectivo = Operacion::where('tipoVenta_id', 1)
            ->whereDate('created_at', $this->hoy)
            ->where('cerrado', 0)->where('usuario_id', auth()->user()->id)
            ->sum('venta');

        $this->debito = Operacion::where('tipoVenta_id', 2)
            ->whereDate('created_at', $this->hoy)
            ->where('cerrado', 0)->where('usuario_id', auth()->user()->id)
            ->sum('venta');

        $this->tarjeta = Operacion::where('tipoVenta_id', 3)
            ->whereDate('created_at', $this->hoy)
            ->where('cerrado', 0)->where('usuario_id', auth()->user()->id)
            ->sum('venta');

        $this->cuentaCorientes=CuentaCorriente::whereDate('created_at', $this->hoy)
            ->where('cierreCaja', 0)->where('usuario_id', auth()->user()->id)
            ->sum('entrega');



        $this->ventasPorTipo = DB::table('operacions')
            ->join('tipo_ventas', 'tipo_ventas.id', '=', 'operacions.tipoVenta_id')
            ->select('tipo_ventas.id', 'tipo_ventas.tipoVenta', DB::raw('COUNT(*) as total_ventas'))
            ->whereDate('operacions.created_at', $this->hoy)
            ->where('operacions.cerrado', 0)->where('usuario_id', auth()->user()->id)
            ->groupBy('tipo_ventas.id', 'tipo_ventas.tipoVenta')
            ->get();


        $fecha = Carbon::create(date('y-m-d'));
        Carbon::setLocale('es');
        $this->fecha_formateada = ucfirst($fecha->isoFormat('dddd, D [de] MMMM [de] YYYY'));

    }
    public $confirmarCierre=false;
    public function cerrarModal(){
        $this->confirmarCierre=true;
    }
    public function realizarCierre()
{
    // Realiza el cierre de caja
    ModelsCierreCaja::create([
        'efectivo' => $this->efectivo,
        'debito' => $this->debito,
        'tarjeta' => $this->tarjeta,
        'cuentaCorriente' => $this->cuentaCorientes,
        'usuario' => auth()->user()->id,
    ]);

    $cuentaC = CuentaCorriente::whereDate('created_at', $this->hoy)->where('cierreCaja', 0)->get();
    foreach ($cuentaC as $item) {
        CuentaCorriente::find($item->id)->update(['cierreCaja' => 1]);
    }

    $tipos = Operacion::whereDate('created_at', $this->hoy)->where('cerrado', 0)->get();
    foreach ($tipos as $items) {
        Operacion::whereDate('created_at', $this->hoy)->where('cerrado', 0)->update(['cerrado' => 1]);
    }

    auth()->guard('web')->logout();

    // Redirige a la página de inicio de sesión
    return redirect('/');
}

    public function render()
    {
        return view('livewire.cierre.cierre-caja');
    }
}
