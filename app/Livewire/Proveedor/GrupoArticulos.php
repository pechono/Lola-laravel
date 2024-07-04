<?php

namespace App\Livewire\Proveedor;

use App\Models\Grupos;
use App\Models\GruposArticulos;
use App\Models\Proveedor;
use Livewire\Component;

class GrupoArticulos extends Component
{
    public $proveedors=[];
    public $VerArticulosGrupo=false;
    public $datosPro=[];
    public $datos=[];
    public $gruposProv=[];

    public function Mount()
    {
        $this->proveedors=Proveedor::all();
    }
    public $ArtGrupo=[];
    public function modalArticulosGrupo($id)
    {
        $this->VerArticulosGrupo=true;
        $this->datosPro=Proveedor::find($id);
        $this->gruposProv = Grupos::where('proveedor_id', $id)
            ->select()
            ->get();



    }
    public $articulosGrupoModal=false;
    public function ArticulosGrupo($id)
    {
        $this->VerArticulosGrupo=false;
        $this->articulosGrupoModal=true;
        $this->datos = Proveedor::join('grupos', 'grupos.proveedor_id', '=', 'proveedors.id')
        ->select('proveedors.id','proveedors.nombre','proveedors.rubro', 'proveedors.localidad', 'proveedors.telefono', 'grupos.NombreGrupo','grupos.porsentaje' )
        ->where('grupos.id', $id)
        ->first();


        $this->ArtGrupo=GruposArticulos::join('grupos', 'grupos.id','grupos_articulos.grupo_id')
                ->join('articulos','articulos.id','grupos_articulos.articulo_id')
                ->join('categorias','categorias.id','articulos.categoria_id')
                ->join('unidads','unidads.id','articulos.unidad_id')
                ->select('articulos.id','articulos.articulo','articulos.presentacion','unidads.unidad', 'articulos.precioF')
                ->get();
    }
    public function render()
    {
        return view('livewire.proveedor.grupo-articulos');
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
        $this->gruposProv = Grupos::where('proveedor_id', $this->idPro)
        ->select()
        ->get();


    }
    public function validar()
    {
        $this->NombreGrupo='';
        $this->porsentaje='';
        $this->idPro='';
    }
}
