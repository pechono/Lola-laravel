<?php

namespace App\Livewire\Service;

use Livewire\Component;

class IngresoImp extends Component
{
    public function render()
    {
        return view('livewire.service.ingreso-imp');
    }
    public $nro_ing;
    public function mount($nro_ingreso)
    {
        $this->nro_ing = $nro_ingreso;
    }
}
