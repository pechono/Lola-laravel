<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use Livewire\WithPagination;

class Clientelivewire extends Component
{
    use WithPagination;

    public $active=1;
    public $q;

    public $sortBy='id';
    public $sortAsc=true;
    public $f;


    protected $queryString = [
        'q'=>['except'=>''],
        'sortBy'=>['except'=>'id'],
        'sortAsc'=>['except'=>true],
    ];

    public function render()
    {
        $clientes=Cliente::where('activo',$this->active)
            ->when($this->q, function ($query){
                               return $query->where( function($query){
                                            $query->where('apellido','like','%'.$this->q.'%')
                                                    ->orwhere('nombre','like','%'. $this->q .'%')
                                                    ->orwhere('telefono','like','%'.$this->q.'%');
                                        });
                                    })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
       // $query=$clientes->toSql();
        $clientes=$clientes->paginate(10);
        return view('livewire.clientelivewire', compact('clientes'));
    }


    public function sortby($field)
    {
        if($field==$this->sortBy)
        {
            $this->sortAsc=!$this->sortAsc;
        }

        $this->sortBy=$field;
    }

    public function updatingActive()
    {
        $this->resetPage();
    }
    public function updatingO()
    {
        $this->resetPage();
    }
    /* ----------------------Eliminar Cliente--------------------------- */
    public $confirmingClienteDeletion=false;

    public function confirmarClienteDeletion($id)
    {
        $this->confirmingClienteDeletion=$id;
    }

    public function deleteCliente(Cliente $cliente)
    {
        $cliente->delete();
        $this->confirmingClienteDeletion=false;
    }
    /* ----------------------Fin Eliminar Cliente----------------------- */

    /* ----------------------Agregar Cliente--------------------------- */
    public $apellido;
    public $nombre;
    public $dni;

    public $telefono;
    public $activo=1;

    public $confirmingClienteAdd=false;
    //reglas de validacion de Cliente

    protected $rules = [
        'dni' => 'required|regex:/^\d{7,9}$/|unique:clientes,dni',
        'apellido' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'activo' => 'boolean',
    ];
    
    public function confirmarClienteAdd()
    {
        //$this->reset(['cliente']);
        $this->confirmingClienteAdd=true;
    }
    public function saveCliente(){
    

    // Limpiar el formato del DNI
    $this->dni = str_replace('.', '', $this->dni);
    $this->validate([
        'dni' => 'required|regex:/^\d{7,9}$/|unique:clientes,dni',
        'apellido' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'activo' => 'boolean',
    ]);
    Cliente::create([
        'dni' => $this->dni,
        'apellido' => $this->apellido,
        'nombre' => $this->nombre,
        'telefono' => $this->telefono,
        'activo' => $this->activo,
    ]);

    session()->flash('message', 'Cliente agregado exitosamente.');
    
        $this->apellido='';
        $this->nombre='';
        $this->telefono='';

        $this->dni='';


        $this->confirmingClienteAdd=false;
    }

    /* ----------------------Fin Agregar Cliente--------------------------- */

     /* ----------------------Editar Cliente--------------------------- */

     public $confirmingClienteEdit=false;
     public $idC='';
     public function confirmarClienteEdit( $id)
     {
        $client=Cliente::find($id);
        $this->idC=$id;
        $this->apellido=$client->apellido;
        $this->nombre=$client->nombre;

        $this->dni=$client->dni;
        $this->telefono=$client->telefono;

        $this->confirmingClienteEdit=true;
     }

     public $msj='';
     public function editCliente(){

        // Validación de datos generales, sin incluir el DNI si no ha cambiado
        $this->validate([
            'apellido' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'activo' => 'boolean',
        ]);
    
        $client = Cliente::find($this->idC);
    
        // Verificar si el DNI ha cambiado
        if ($client->dni !== $this->dni) {
            // Validar el DNI solo si ha cambiado
            $this->validate([
                'dni' => 'required|regex:/^\d{7,9}$/|unique:clientes,dni',
            ]);
            // Actualizar el DNI si ha cambiado
            $client->dni = $this->dni;
        }
    
        // Actualizar otros campos
        $client->update([
            'apellido' => $this->apellido,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'activo' => 1, // Manteniendo el cliente activo por defecto
        ]);
    
        // Limpiar los campos del formulario
        $this->apellido = '';
        $this->nombre = '';
        $this->dni = '';
        $this->telefono = '';
        $this->confirmingClienteEdit = false;
    
        // Mensaje de éxito
        $this->msj = 'Se editó correctamente el cliente con ID ' . $this->idC;
    }
    
    

 }

