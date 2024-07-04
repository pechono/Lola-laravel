<?php

namespace App\Livewire\Proveedor;

use App\Models\Grupos;
use App\Models\Proveedor;
use Livewire\Component;

class CrearGrupo extends Component
{
    public $proveedors=[];
    public $datosPro=[];
    public $active=1;

    public function Mount()
    {
        $this->proveedors=Proveedor::all();
    }
    public $crearGrupoModal=false;
    public $grupos=[];
    public $idPro;
    public function modalGrupo($id)
    {
        $this->idPro=$id;
        $this->crearGrupoModal=true;
        $this->datosPro=Proveedor::find($id);

        $this->ModalsGrupo();

    }
    public function ModalsGrupo()
    {
        $this->grupos=Grupos::where('proveedor_id',$this->idPro)->get();
    }
    public $NombreGrupo;
    public $porsentaje;
    protected $rules=[
        'NombreGrupo'=>'required|string|min:4',
        'porsentaje'=>'required|string'
    ];
    public function addGrupo()
    {
        $this->validate();
        Grupos::create([
            'proveedor_id'=>$this->idPro,
            'NombreGrupo'=>$this->NombreGrupo,
            'porsentaje'=>$this->porsentaje
        ]);
        $this->ModalsGrupo();


    }
    public function validar()
    {
        $this->NombreGrupo='';
        $this->porsentaje='';
        $this->idPro='';
    }
    public function render()
    {
        return view('livewire.proveedor.crear-grupo');
    }
}
