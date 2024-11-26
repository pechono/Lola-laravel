<?php

namespace App\Livewire\Mayorista;

use App\Models\Articulo;
use App\Models\Mayorista;
use App\Models\Ofertas;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CrearLista extends Component
{ 
    public $active=1;
    
    public function render()
    {        
        return view('livewire.mayorista.crear-lista');
    }
    public $articulos;
    public $cliente='Sin definir';
    public function mount(){
        $this->articulosFun();
    }
    
    public function Ofeta($id){
        $ofertaArt = Ofertas::where('articulo_id', $id)->exists();
        return $ofertaArt ? true : false;
    }
    public $porsentaje=0; // Define la propiedad
    public function calcularPorcentaje($precioM)
    {   
        return ($precioM *$this->porsentaje)/(100)+$precioM;
       
        // Más lógica o retorno
    }
    public function articulosFun(){
        $this->articulos=Articulo::where('activo',$this->active)
        ->select('articulos.id', 'articulos.articulo', 'categorias.categoria', 'articulos.presentacion', 'unidads.unidad',
        'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI', 'articulos.caducidad', 'articulos.detalles',
        'articulos.suelto', 'articulos.activo','stocks.stock','stocks.stockMinimo','articulos.activo')
        ->join('categorias', 'categorias.id', '=', 'articulos.categoria_id')
        ->join('unidads', 'unidads.id', '=', 'articulos.unidad_id')
        ->join('stocks', 'stocks.articulo_id','=','articulos.id')->get();
    }   
    public function addMayorista($art,$precio,$cliente){
        Mayorista::create([
            'articulo_id'=>$art,
            'precioM'=>$precio,
            'cliente'=>$cliente
        ]);
        $this->articulosFun();
       
    }

    public function deleteMayorista($art){
        Mayorista::where('articulo_id',$art)->delete();
        $this->articulosFun();

    }
    public function enMayorista($artId){
        return Mayorista::where('articulo_id',$artId)
                        ->where('mayoristas.activo', 1)
                        ->exists();
    }
    public function updatedPorsentaje()
    {
        $this->articulosFun();
    }
    public $ultimoNroPedido;
    public $boton=false;
    public function imprimir(){
        $mayoristaLists = Mayorista::where('mayoristas.activo', 1)->get();
        $this->ultimoNroPedido = Mayorista::max('nroPedido')+1;
        
        foreach($mayoristaLists as $list){
            Mayorista::where('id', $list->id)->update([
                'nroPedido'=>$this->ultimoNroPedido,
                'activo'=>0
            ]);
        }
       $this->boton=true;
       $this->articulosFun();
    }
}
