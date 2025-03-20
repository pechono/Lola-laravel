<?php

namespace App\Livewire\Proveedor;

use App\Models\Proveedor as ModelsProveedor;
use Livewire\Component;

use function PHPUnit\Framework\throwException;

class Proveedor extends Component
{
    public $proveedors=[];
    public $active=1;

    public function Mount()
    {
        $this->proveedors=ModelsProveedor::where('activo',$this->active)->get();
    }
    public function render()
    {
        $this->proveedors=ModelsProveedor::where('activo',$this->active)->get();
        return view('livewire.proveedor.proveedor');
    }
    public $AddModal=false;
    public function addModalProveedor()
    {
        $this->AddModal=true;
    }
    protected $rules=[
        'nombre'=>'required|string|min:4',
        'telefono'=>'required|string|min:4',
        'rubro'=>'required|string|min:4',
        'direccion'=>'required|string|min:4',
        'localidad'=>'required|string|min:4',
        'mail'=>'required|string|min:4',
    ];

    public $nombre, $telefono, $rubro, $direccion, $localidad, $mail, $idPro;
    public function saveProveedor()
    {
        $this->validate();
        ModelsProveedor::create([
            'nombre'=>$this->nombre,
            'telefono'=>$this->telefono,
            'rubro'=>$this->rubro,
            'direccion'=>$this->direccion,
            'localidad'=>$this->localidad,
            'mail'=>$this->mail,
            'activo'=>1
        ]);
        $this->Mount();
        $this->vaciar();
        $this->AddModal=false;

    }
    public $aditModalProveedor=false;
    public  function editProveedor($id){
        $this->aditModalProveedor=true;
        $proveedorModal=ModelsProveedor::find($id);

            $this->nombre=$proveedorModal->nombre;
            $this->telefono=$proveedorModal->telefono;
            $this->rubro=$proveedorModal->rubro;
            $this->direccion=$proveedorModal->direccion;
            $this->localidad=$proveedorModal->localidad;
            $this->mail=$proveedorModal->mail;
            $this->idPro=$id;

    }

    public function editSave(){
        $proveedorModal=ModelsProveedor::find($this->idPro);
        $proveedorModal->update([
            'nombre'=>$this->nombre,
            'telefono'=>$this->telefono,
            'rubro'=>$this->rubro,
            'direccion'=>$this->direccion,
            'localidad'=>$this->localidad,
            'mail'=>$this->mail
        ]);
        $this->Mount();
        $this->vaciar();
        $this->aditModalProveedor=false;
    }
    public $DeleteModal=false;
    public function confirmarProveedorDeletion($id)
    {
        $this->idPro=$id;
        $this->DeleteModal=true;
    }
    public function delete()
    {
        $proveedorModal=ModelsProveedor::find($this->idPro);
        $proveedorModal->update([
            'activo'=>0
        ]);
        $this->Mount();
        $this->vaciar();
        $this->DeleteModal=false;
    }
    public $activaModal=false;
    public function ModalActivarProveedor($id){
       $this->activaModal=true;
       $this->idPro=$id;
    }
    public function activar(){
        $proveedorModal=ModelsProveedor::find($this->idPro);
        $proveedorModal->update([
            'activo'=>1
        ]);
        $this->Mount();
        $this->vaciar();
        $this->active=1;
        $this->activaModal=false;

    }
    public function vaciar(){
        $this->nombre='';
        $this->telefono='';
        $this->rubro='';
        $this->direccion='';
        $this->localidad='';
        $this->mail='';
        $this->idPro='';
    }
}
