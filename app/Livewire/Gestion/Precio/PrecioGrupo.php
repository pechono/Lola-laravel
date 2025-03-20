<?php

namespace App\Livewire\Gestion\Precio;

use App\Models\Articulo;
use Illuminate\Support\Facades\DB;

use App\Models\Grupos;
use App\Models\GruposArticulos;
use App\Models\HistoriasPrecio;
use App\Models\Proveedor;
use Livewire\Component;

class PrecioGrupo extends Component
{   public $proveedors=[];
    public $VerArticulosGrupo=false;
    public $datosPro=[];
    public $datos=[];
    public $gruposProv=[];
    public $ArtGrupo=[];
    public $activarCambio=false;


    public function Mount()
    {
        $this->proveedors=Proveedor::all();
    }
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

        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public function render()
    {
        return view('livewire.gestion.precio.precio-grupo');
    }
    // ----------funtion
    public function datosGrupo(){
        $this->datos = Proveedor::join('grupos', 'grupos.proveedor_id', '=', 'proveedors.id')
        ->select('proveedors.id','grupos.id AS idGrupo','proveedors.nombre','proveedors.rubro', 'proveedors.localidad', 'proveedors.telefono', 'grupos.NombreGrupo','grupos.porsentaje' )
        ->where('grupos.id',$this->idGrupo)
        ->first();
    }
    public function ArtGrupoFun(){
        $this->ArtGrupo=GruposArticulos::join('grupos', 'grupos.id','grupos_articulos.grupo_id')
            ->join('articulos','articulos.id','grupos_articulos.articulo_id')
            ->join('categorias','categorias.id','articulos.categoria_id')
            ->join('unidads','unidads.id','articulos.unidad_id')
            ->join('stocks','stocks.articulo_id','articulos.id')
            ->join('proveedors','proveedors.id','stocks.proveedor_id')
            ->select('articulos.id','articulos.articulo','articulos.presentacion','unidads.unidad','articulos.precioF','articulos.precioI','grupos.porsentaje',
            'categorias.categoria','proveedors.nombre','stocks.stock', 'articulos.updated_at',
            DB::raw('articulos.precioF * (1 + grupos.porsentaje / 100) as precioF_calculado'),
            DB::raw('articulos.precioI * (1 + grupos.porsentaje / 100) as precioI_calculado'),)
            ->where('grupos.id', $this->idGrupo)
            ->get();
    }
    public function activar(){
        $this->activarCambio=true;
        $this->datosGrupo();
        $this->ArtGrupoFun();

    }
    public function noActivar(){
        $this->activarCambio=false;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public $modalPorcentaje=false;
    public $porsentaje;

    public function cambiarPorcentaje($id){
        $this->modalPorcentaje=true;
        $p=Grupos::find($id);
        $this->porsentaje=$p->porsentaje;
        $this->datosGrupo();

    }
    public function carraPorcentaje(){
        $this->modalPorcentaje=false;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public function cambiar($id){
        $cambio=Grupos::find($id);
        $this->validate(['porsentaje'=>'required|numeric']);
        $cambio->update(['porsentaje'=>$this->porsentaje]);
        $this->modalPorcentaje=false;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public $CambiarPrecioModal=false;
    public function cambiarPrecio(){
        $this->CambiarPrecioModal=true;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public function cierreCambiarPrecioModal(){
        $this->CambiarPrecioModal=false;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public $cambiarPrecioBoton=false;
    public function si(){
        $this->cambiarPrecioBoton=true;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public function no(){
        $this->cambiarPrecioBoton=false;
        $this->datosGrupo();
        $this->ArtGrupoFun();
    }
    public $msjModal=false;
    public function cambiarPrecioGrupo($id){
        $items=GruposArticulos::join('grupos', 'grupos.id','grupos_articulos.grupo_id')->join('articulos','articulos.id','grupos_articulos.articulo_id')
        ->join('categorias','categorias.id','articulos.categoria_id')->join('unidads','unidads.id','articulos.unidad_id')
        ->join('stocks','stocks.articulo_id','articulos.id')->join('proveedors','proveedors.id','stocks.proveedor_id')
        ->select('articulos.id','articulos.articulo','articulos.presentacion','unidads.unidad','articulos.precioF',
        'articulos.precioI','grupos.porsentaje','categorias.categoria','proveedors.nombre','stocks.stock', 'articulos.updated_at',
        DB::raw('articulos.precioF * (1 + grupos.porsentaje / 100) as precioF_calculado'),DB::raw('articulos.precioI * (1 + grupos.porsentaje / 100) as precioI_calculado'))
        
        ->where('grupos.id', $this->idGrupo)
        ->get();;
        foreach( $items as $item){
            $articulo=Articulo::where('id',$item->id);
            $articulo->update([
                'precioI'=>$item->precioI_calculado,
                'precioF'=>$item->precioF_calculado
            ]);

        HistoriasPrecio::create([
            'articulo_id'=>$item->id,
            'precioFinal'=>$item->precioF_calculado,
            'precioIcial'=>$item->precioI_calculado
        ]);
        }
        $this->datosGrupo();
        $this->ArtGrupoFun();
        $this->cambiarPrecioBoton=false;
        $this->msjModal=true;
    }
}
