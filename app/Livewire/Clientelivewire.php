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
    public $telefono;
    public $activo=1;

    public $confirmingClienteAdd=false;
    //reglas de validacion de Cliente
    protected $rules=[
        'apellido'=>'required|string|min:4',
        'nombre'=>'required|string|min:4',
        'telefono'=>'required|string|min:4',
        'activo'=>'boolean'
    ];

    public function confirmarClienteAdd()
    {
        //$this->reset(['cliente']);
        $this->confirmingClienteAdd=true;
    }
    public function saveCliente(){
        $this->validate();
        Cliente::create([
            'apellido'=>$this->apellido,
            'nombre'=>$this->nombre,
            'telefono'=>$this->telefono,
            'activo'=>1
        ]);
        $this->apellido='';
        $this->nombre='';
        $this->telefono='';
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
        $this->telefono=$client->telefono;

        $this->confirmingClienteEdit=true;
     }

     public $msj='';
     public function editCliente(){
         $this->validate();
         $client=Cliente::find($this->idC);
         $client->update([
             'apellido'=>$this->apellido,
             'nombre'=>$this->nombre,
             'telefono'=>$this->telefono,
             'activo'=>1
         ]);
         $this->apellido='';
         $this->nombre='';
         $this->telefono='';
         $this->confirmingClienteEdit=false;

         return $this->msj='se edito correctamente'. $this->idC;
     }
     
}
