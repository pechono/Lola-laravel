<?php

namespace App\Livewire\Venta;

use App\Models\Operacion;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListVenta extends Component
{
    public $msj='Venta Diaria';
    public $activarOps=true;
    public $ac='display:none';
    public $acd='display:none';
    public $fechaI='';
    public $fechaF='';
    public $Dia='';
    public $mes='';
    public $meses;
    public $anio;

    public function render()
    {
        $this->meses = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];



         $operacions=Operacion::join('ventas','ventas.operacion','=','operacions.id')->join('tipo_ventas','tipo_ventas.id','=','operacions.tipoVenta_id')
                        ->join('users','users.id','=','operacions.usuario_id')->join('clientes','clientes.id','=','operacions.cliente_id')
                        ->join('articulos','articulos.id','=', 'ventas.articulo_id')->join('unidads','unidads.id','=','articulos.unidad_id')
                        ->join('categorias','categorias.id','=','articulos.categoria_id')
                        ->select('operacions.id','ventas.articulo_id','operacions.venta','clientes.apellido','clientes.nombre', 'users.name','operacions.created_at AS Fecha','tipo_ventas.tipoVenta','articulos.articulo','ventas.precioF','ventas.cantidad','articulos.presentacion',
                            'unidads.unidad','categoria', 'ventas.descuento','unidadVenta','operacions.created_at',
                            DB::raw('MONTH(operacions.created_at) AS mes'), DB::raw('YEAR(operacions.created_at) AS anio'))
                        ->when($this->Dia, function ($query){
                            return $query->where( function($query){

                                         $query->where('operacions.created_at','like','%'.$this->Dia.'%');
                                     });
                                })
                                ->when($this->fechaI, function ($query){
                                    return $query->where( function($query){
                                                 $query->where('operacions.created_at','>=',$this->fechaI);
                                             });
                                        })
                                ->when($this->fechaF, function ($query){
                                    return $query->where( function($query){
                                                    $query->where('operacions.created_at','<=',$this->fechaF);
                                                });
                                        })
                                ->when($this->mes, function ($query){
                                    return $query->where( function($query){
                                                    $query->whereRaw('MONTH(operacions.created_at) = ?', [$this->mes]);
                                                });
                                        })
                                ->when($this->anio, function ($query){
                                    return $query->where( function($query){
                                                    $query->whereRaw('YEAR(operacions.created_at) = ?', [$this->anio]);
                                                });
                                        })
                                ->orderBy('operacions.id', 'desc')
                                ->get();
        $aniosUnicos = Operacion::selectRaw('YEAR(created_at) AS anio')->distinct()->pluck('anio');

        return view('livewire.venta.list-venta', compact( 'operacions', 'aniosUnicos'));
    }

    public function cancelarDE() {
        $this->Dia='';
        $this->msj='Venta entre los dias '. $this->fechaI .'-'. $this->fechaF;
        $this->anio='';
        $this->mes='';

    }
    public function cancelarD() {
        $this->fechaF='';
        $this->fechaI='';
        $this->msj='Venta en le dia '. $this->Dia;
        $this->anio='';
        $this->mes='';
    }
    public function cancelarM() {
        $this->fechaF='';
        $this->fechaI='';
        $this->msj='Ventas segun mes';
        $this->Dia='';
    }
    public function cancelarA() {
        $this->fechaF='';
        $this->fechaI='';
        $this->msj='Venta en el año';
        $this->Dia='';
    }
}
