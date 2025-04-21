<?php

namespace App\Livewire\Service;

use App\Models\Cliente;
use App\Models\Color;
use App\Models\Marca;
use App\Models\TipoBike;
use App\Models\Proceso;
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
        $this->cargarProcesos();

     }
    public function submitForm()
    {
        $this->message = "Colores seleccionados: " . implode(', ', $this->selectedColors) . 
                         " | Marcas seleccionadas: " . implode(', ', $this->selectedBrands) . 
                         " | Tipos seleccionados: " . implode(', ', $this->selectedTypes);
    }
   
    
    
    public $procesosSeleccionados = []; // Array para almacenar IDs seleccionados
    public $procesos; // Lista completa de procesos
    public $filtroActivos = true;

    

    public function cargarProcesos()
    {
        $this->procesos = Proceso::when($this->filtroActivos, function($query) {
                return $query->where('activo', true);
            })
            ->orderBy('nombre')
            ->get();
    }
    

    public function updatedFiltroActivos()
    {
        $this->cargarProcesos();
    }

    public function guardarSeleccion()
    {
        // Validación
        $this->validate([
            'procesosSeleccionados' => 'required|array|min:1',
            'procesosSeleccionados.*' => 'exists:procesos,id',
        ]);

        // Aquí puedes procesar los seleccionados
        // $this->procesosSeleccionados contiene los IDs
        
        session()->flash('message', 'Procesos seleccionados guardados correctamente');
        
        // Ejemplo de cómo acceder a los modelos completos:
        $procesosSeleccionados = Proceso::findMany($this->procesosSeleccionados);
        
        // Puedes hacer algo con ellos o pasar a otra vista
    }
    public function ver(){
        $this->message=$this->message.'hola';
    }
}
