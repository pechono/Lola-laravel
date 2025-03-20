<?php

namespace App\Livewire\Informes;

use Livewire\Component;
use App\Models\Venta;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;

class MasVendidos extends Component
{
    public $articulosMasVendidos;

    public function mount()
    {
        $this->articulosMasVendidos = Venta::select('articulos.articulo', DB::raw('SUM(ventas.cantidad) as total_vendido'))
            ->join('articulos', 'ventas.articulo_id', '=', 'articulos.id')
            ->groupBy('articulos.articulo')
            ->orderBy('total_vendido', 'desc')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.informes.mas-vendidos');
    }
}
