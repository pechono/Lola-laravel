<?php

namespace App\Livewire\Service;

use App\Models\Cliente;
use App\Models\Color;
use App\Models\Marca;
use App\Models\TipoBike;
use Livewire\Component;

class IngresarBike extends Component
{
    public function render()
    {
        return view('livewire.service.ingresar-bike');
    }
    public $msj='hola';
    public $dni;
    public $cliente;
    
    public function buscarCliente(){
        $this->cliente=Cliente::where('dni', $this->dni)->first();
        if ($this->cliente) {
            $this->msj='peluca';

        }else {
            $this->msj='peluca vo';

        }
    }
    public $colors;
    public $brands;
    public $types;
     // Campos para nuevos valores
     public $newColor = '';
     public $newBrand = '';
     public $newType = '';
 
     // Campos para seleccionar los valores
     public $selectedColors = [];
     public $selectedBrands = [];
     public $selectedTypes = [];
 
     public $message = '';
     public function mount(){
        $this->colors=Color::all();
        $this->brands=Marca::all();
        $this->types=TipoBike::all();
     }
     public function submitForm()
    {
        $this->message = "Colores seleccionados: " . implode(', ', $this->selectedColors) . 
                         " | Marcas seleccionadas: " . implode(', ', $this->selectedBrands) . 
                         " | Tipos seleccionados: " . implode(', ', $this->selectedTypes);
    }
    public $parchadaD;
    public $parchadaT;
    public $frenoT;
    public $frenoD;
    public $servisG;
    public $servisR;
    public $tubelizadoD;
    public $tubelizadoT;
    


}
