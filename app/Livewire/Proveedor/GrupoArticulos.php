<?php

namespace App\Livewire\Proveedor;

use App\Models\Articulo;
use App\Models\Grupos;
use App\Models\GruposArticulos;
use App\Models\Proveedor;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportNavigate\ThirdAssetPage;

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
        $this->VerArticulosGrupo=$id;
        $this->datosPro=Proveedor::find($id);
        $this->gruposProv = Grupos::where('proveedor_id', $id)
            ->select()
            ->get();
    }

    public $articulosGrupoModal=false;
    public $idGrupo;
    public function ArticulosGrupo($id)
    {

        $this->idGrupo=$id;
        $this->articulosGrupoModal=$id;

        $this->datosGrupo($this->idGrupo);
        $this->ArtGrupoFun();
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
    public $modalArticulosVar=false;
    public $articulosSinGrupo=[];

    public function modalArticulos($id){

        $this->modalArticulosVar=true;
        $this->datosGrupo($id);
        $this->articulosSinG();
    }

    public function articuloEnGrupo($grupo, $articulo){
       GruposArticulos::create([
        'grupo_id'=>$grupo,
        'articulo_id'=>$articulo
        ]);
        $this->datosGrupo($grupo);
        $this->articulosSinG();

    }
    // -------------------colsultas---
    public function articulosSinG(){
        $this->articulosSinGrupo = Articulo::leftJoin('grupos_articulos', 'articulos.id', '=', 'grupos_articulos.articulo_id')
            ->leftJoin('unidads', 'articulos.unidad_id', '=', 'unidads.id')
            ->leftJoin('stocks', 'stocks.articulo_id', '=', 'articulos.id')
            ->leftJoin('proveedors', 'proveedors.id', '=', 'stocks.proveedor_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'articulos.categoria_id')
            ->whereNull('grupos_articulos.articulo_id')
            ->select('articulos.*', 'unidads.unidad','categorias.categoria','proveedors.nombre')
            ->get();
    }
    public function datosGrupo($id){
        $this->datos = Proveedor::join('grupos', 'grupos.proveedor_id', '=', 'proveedors.id')
        ->select('proveedors.id','grupos.id AS idGrupo','proveedors.nombre','proveedors.rubro', 'proveedors.localidad', 'proveedors.telefono', 'grupos.NombreGrupo','grupos.porsentaje' )
        ->where('grupos.id', $id)
        ->first();
    }
    public function ArtGrupoFun(){
        $this->ArtGrupo=GruposArticulos::join('grupos', 'grupos.id','grupos_articulos.grupo_id')
            ->join('articulos','articulos.id','grupos_articulos.articulo_id')
            ->join('categorias','categorias.id','articulos.categoria_id')
            ->join('unidads','unidads.id','articulos.unidad_id')
            ->join('stocks','stocks.articulo_id','articulos.id')
            ->join('proveedors','proveedors.id','stocks.proveedor_id')
            ->select('articulos.id','articulos.articulo','articulos.presentacion','unidads.unidad','articulos.precioF','categorias.categoria','proveedors.nombre','stocks.stock')
            ->where('grupos.id', $this->idGrupo)
            ->get();
    }
    public function cerrar3(){
        $this->modalArticulosVar=false;
        $this->ArticulosGrupo( $this->articulosGrupoModal);
   }
    public function cerrar2(){
    $this->articulosGrupoModal=false;
    $this->modalArticulosGrupo( $this->VerArticulosGrupo);

   }
    public function QuitarArticulosGrupo($id){
        GruposArticulos::where('articulo_id',$id)->delete();
        $this->ArtGrupoFun();

   }

}
