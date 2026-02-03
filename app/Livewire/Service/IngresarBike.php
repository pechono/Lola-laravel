<?php

namespace App\Livewire\Service;

use App\Models\Bici;
use App\Models\Articulo;
use Livewire\Component;
use App\Models\Cliente;
use App\Models\Color;
use App\Models\Marca;
use App\Models\NroIngreso;
use App\Models\TipoBike;
use App\Models\IngresoBici;
use App\Models\Proceso;

class IngresarBike extends Component
{
    /* ================== CLIENTE ================== */
    public $dni;
    public $cliente;

    public function buscarCliente()
    {
        $this->cliente = Cliente::where('dni', $this->dni)->first();
    }

    /* ================== DATOS BICI ================== */
    public $colors;
    public $brands;
    public $types;

    public $selectedColors = [];
    public $selectedBrands = null;
    public $selectedTypes = '';

    public $newColor = '';
    public $newBrand = '';
    public $newType = '';

    /* ================== PROCESOS ================== */
    public $procesos = [];
    public $procesosSeleccionados = [];
    public $buscarProceso = '';
    public $filtroActivos = true;

    /* ================== INIT ================== */
    public function mount()
    {
        $this->colors = Color::orderBy('color')->get();
        $this->brands = Marca::orderBy('marca')->get();
        $this->types  = TipoBike::orderBy('tipo')->get();
        $this->cargarProcesos();
    }

    /* ================== PROCESOS ================== */
    

    
    public function cargarProcesos()
{
    $this->procesos = Articulo::where('categoria_id', 1) // Servicio
        ->when($this->filtroActivos, fn ($q) =>
            $q->where('activo', true)
        )
        ->when($this->buscarProceso, fn ($q) =>
            $q->where('articulo', 'like', '%' . $this->buscarProceso . '%')
        )
        ->orderBy('articulo')
        ->get();
}

    public function updatedBuscarProceso()
    {
        $this->cargarProcesos();
    }

    public function updatedFiltroActivos()
    {
        $this->cargarProcesos();
    }

    public function agregarProceso($id)
    {
        if (!in_array($id, $this->procesosSeleccionados)) {
            $this->procesosSeleccionados[] = $id;
        }
    }

    public function quitarProceso($id)
    {
        $this->procesosSeleccionados = array_values(
            array_diff($this->procesosSeleccionados, [$id])
        );
    }

    /* ================== GUARDAR ================== */
    public function guardarSeleccion()
    {
        $this->validate([
            'cliente.id' => 'required',
            'selectedTypes' => 'required',
            'selectedBrands' => 'required',
            'procesosSeleccionados' => 'required|array|min:1',
        ]);

        // Acá después se guarda el servicio completo
        session()->flash('message', 'Ingreso guardado correctamente');
    }

    public function render()
    {
        return view('livewire.service.ingresar-bike');
    }
    




    /* ================== MOSTRAR brands ================== */

public function mostrarBrands()
{
    // método fantasma para detectar de dónde se llama
}

    /* ================== MOSTRAR types ================== */
    public function mostrarTypes()
    
    {
        $this->selectedTypes = $this->selectedTypes;
    }
    /* ================== MOSTRAR colors ================== */
    public function mostraColor()
    {
        $this->selectedColors = $this->selectedColors;
    }
    // Estado del panel
    public bool $mostrarNotaProceso = false;

    // Texto de la nota
    public string $notaProceso = '';
    // ===== MODALES =====
public bool $modalMarca = false;
public bool $modalTipo = false;
public bool $modalColor = false;
public bool $modalProceso = false;

// ===== CAMPOS =====
public string $nuevaMarca = '';
public string $nuevoTipo = '';
public string $nuevoColor = '';
public string $nuevoProceso = '';

public function guardarTipo()
{
    $this->validate([
        'nuevoTipo' => 'required|string|max:100',
    ]);

    TipoBike::create([
        'tipo' => $this->nuevoTipo,
    ]);

    $this->nuevoTipo = '';
    $this->modalTipo = false;

    $this->types = TipoBike::orderBy('tipo')->get();
}

public function guardarMarca()
{
    $this->validate([
        'nuevaMarca' => 'required|string|max:100',
    ]);

    Marca::create([
        'marca' => $this->nuevaMarca,
    ]);

    $this->nuevaMarca = '';
    $this->modalMarca = false;

    $this->brands = Marca::orderBy('marca')->get();
}


public function guardarIngreso()
{
    $this->validate([
        'cliente.id' => 'required',
        'selectedTypes' => 'required',
        'selectedBrands' => 'required',
        'procesosSeleccionados' => 'required|array|min:1',
    ]);

    Bici::create([
        'cliente_id' => $this->cliente->id,
        'tipo_id' => $this->selectedTypes,
        'marca_id' => $this->selectedBrands,
        'color' => json_encode($this->selectedColors),
        'detalles' => '',]);
    
    NroIngreso::create([
        'detalles' => $this->notaProceso,
    ]);
    $nroIng=NroIngreso::max('id') ?? 0;

    
        foreach ($this->procesosSeleccionados as $procesoId) {
            IngresoBici::create([
                'bici_id' => Bici::max('id'),
                'nro_ingreso' => $nroIng,
                'articulo_id' => $procesoId,
                'estado' => 'pendiente'
            ]);
        }
    // Acá después se guarda el servicio completo
    session()->flash('message', 'Ingreso guardado correctamente');
    return redirect()->route('Service.ingreso-imp', ['nro_ingreso' => $nroIng]);


    }
    
}