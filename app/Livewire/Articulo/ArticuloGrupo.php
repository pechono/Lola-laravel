<?php

namespace App\Livewire\Articulo;


use Livewire\Component;
use App\Models\Proveedor;
use App\Models\Grupos;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\GruposArticulos;
use App\Models\HistoriasPrecio;
use App\Models\Ofertas;
use App\Models\Stock;
use App\Models\Suelto;
use App\Models\Unidad;

class ArticuloGrupo extends Component
{
    public $proveedor;
    public $grupo;

    public $proveedores = [];
    public $grupos = [];
    public $categorias = [];
    public $unidades = [];
    public $articulo, $categoria_id, $presentacion, $unidad_id,
            $descuento, $unidadVenta='Unidad', $precioF, $precioI, $caducidad,
            $detalles, $suelto, $porcentaje, $idArtitul, $proveedor_id, $stock, $stockMinimo, $codigo,
            $articulosGrupo=[];

    public function mount()
    {
        $this->proveedores = Proveedor::all();
        $this->categorias=Categoria::All();
        $this->unidades=Unidad::all();
    }
    
    public function crearProveedor()
    {
        // Lógica para abrir modal o agregar uno nuevo
        session()->flash('message', 'Abrir modal para agregar proveedor');
    }

    public function crearGrupo()
    {
        // Lógica para abrir modal o agregar uno nuevo
        session()->flash('message', 'Abrir modal para agregar grupo');
    }

    public function seleccionar()
    {
        // Acción con proveedor y grupo seleccionados
        session()->flash('message', "Seleccionado proveedor: $this->proveedor, grupo: $this->grupo");
    }
    public function render()
    {
        return view('livewire.articulo.articulo-grupo');
    }
    public function calcular()
    {
        $this->precioF=(($this->precioI *$this->porcentaje)/(100))+$this->precioI;
    }
    public function mostrarGrupo()
    {
        $this->grupos = Grupos::where("proveedor_id" , $this->proveedor_id)->get();   
    }
    public function cargarArticulo()
    {
         $this->caducidad='No';
            $this->suelto=0;
        

                $this->validate([
            'articulo' => 'required|string|min:4',
            'presentacion' => 'required|string|min:1',
            'unidad_id' => 'required',
            'descuento' => 'required|numeric',
            'unidadVenta' => 'required|string|min:1',
            'precioI' => 'required|numeric|min:1',
            'precioF' => 'required|numeric|min:1',
            'caducidad' => 'required|string|min:2',
            'detalles' => 'required|string',
            'suelto' => 'boolean',
            'stock' => 'required|numeric|min:1',
            'stockMinimo' => 'required|integer|min:1',
            'categoria_id' => 'required',  // Agregar la regla para categoría
            'grupo' => 'required',         // Agregar la regla para grupo (asegúrate que la propiedad exista)
            'proveedor_id' => 'required',
            'codigo' => 'nullable|alpha_num|unique:articulos,codigo',
            ], [
                'categoria_id.required' => 'Debe seleccionar una categoría.',
                'grupo.required' => 'Debe seleccionar un grupo.',
                'proveedor_id.required' => 'Debe seleccionar un proveedor.'
                ]);


        Articulo::create([
            'articulo'=>  $this->articulo,
            'codigo'=>  $this->codigo,
            'categoria_id'=>  $this->categoria_id,
            'presentacion'=>  $this->presentacion,
            'unidad_id'=>  $this->unidad_id,
            'descuento'=>  $this->descuento,
            'unidadVenta'=>  $this->unidadVenta,
            'precioF'=>  $this->precioF,
            'precioI'=>  $this->precioI,
            'caducidad'=>  $this->caducidad,
            'detalles'=>  $this->detalles,
            'suelto'=>  $this->suelto,
            'activo'=>1
        ]);
        $ultimo=Articulo::latest()->first();
        Stock::create([
            'articulo_id'=>$ultimo->id,
            'stockMinimo'=>$this->stockMinimo,
            'stock'=>$this->stock,
            'proveedor_id'=>$this->proveedor_id
        ]);

        if($this->suelto==1){
            Suelto::create([
                'articulo_id'=>$this->suelto
            ]);
        }

        HistoriasPrecio::create([
             'articulo_id'=>$ultimo->id,
             'precioFinal'=>$this->precioF,
             'precioIcial'=>$this->precioI
        ]);
        GruposArticulos::create([
            'grupo_id'=>$this->grupo,
            'articulo_id'=>$ultimo->id
        ]);
        session()->flash('message', 'Artículo creado exitosamente.');
        $this->borrarCampos();
        $this->articulosGrupos();
    }
    public function articulosGrupos()
    {
        $this->articulosGrupo = GruposArticulos::where('grupo_id', $this->grupo)
        ->select('articulos.id', 'articulos.articulo', 'articulos.codigo', 'articulos.presentacion','unidadVenta',)
        ->join('articulos','articulos.id','grupos_articulos.articulo_id')->get();
    }
    public function borrarCampos(){
        $this->articulo='';
                 $this->codigo='';

         $this->presentacion='';
         $this->unidad_id='';
         $this->descuento='';
         $this->unidadVenta='Unidad';
         $this->precioF='';
         $this->precioI='';
         $this->caducidad='';
         $this->detalles='';
         $this->suelto='';
         $this->stockMinimo='';
         $this->stock='';
     }

}
