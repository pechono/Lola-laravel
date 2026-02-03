<?php

namespace App\Livewire\Articulo;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\HistoriasPrecio;
use App\Models\Ofertas;
use App\Models\Proveedor;
use App\Models\Stock;
use App\Models\Suelto;
use App\Models\Unidad;
use Livewire\Component;
use Illuminate\Validation\Rule;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Generator;

class ArticuloAdd extends Component
{
    public $categorias, $a;
    public $suel=0;
    public $articulo_id;
    public $cad='No';
    public $confirmingArticuloAdd=false;
    public $codigo, $articulo, $categoria_id, $presentacion, $unidad_id, $descuento, $unidadVenta, $precioF, $precioI, $caducidad, $detalles, $suelto, $stockMinimo, $stock, $proveedor_id;

    public function render()
    {
        $this->categorias=Categoria::All();
        $unidades=Unidad::all();
        $proveedores=Proveedor::all();
        return view('livewire.articulo.articulo-add', compact('unidades', 'proveedores'));
    }
    
    public function confirmarArticuloAdd()
    {
        $this->confirmingArticuloAdd=true;
    }
     public function saveArticulo(){

            $this->caducidad='No';
            $this->suelto=0;
        

        $this->validate([
            'articulo'=>'required|string|min:4',
            'categoria_id'=>'required',
            'presentacion'=>'required|string|min:1',
            'unidad_id'=>'required',
            'descuento'=>'required|numeric',
            'unidadVenta'=>'required|string|min:1',
            'precioI'=>'required|numeric|min:1',
            'precioF'=>'required|numeric|min:1',
            'caducidad'=>'required|string|min:2',
            'detalles'=>'required|string',
            'suelto'=>'boolean',
            'stock'=>'required|numeric|min:1',
            'stockMinimo'=>'required|integer|min:1',
            'proveedor_id'=>'required',
            'codigo' => [
            'nullable',
            'alpha_num',
            function ($attribute, $value, $fail) {
                if ($value && Articulo::where('codigo', $value)
                    ->when($this->articulo_id, fn($q) => $q->where('id', '!=', $this->articulo_id))
                    ->exists()) {
                    $fail('El código ya está en uso.');
                    }
                 }
             ],[
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'grupo_id.required' => 'Debe seleccionar un grupo.', // 👈 mensaje para grupo
            'proveedor_id.required' => 'Debe seleccionar un proveedor.'
             ],
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

        // try {
        //     Articulo::create([
        //         'articulo'=>  $this->articulo,
        //         'codigo'=>  $this->codigo,
        //         'categoria_id'=>  $this->categoria_id,
        //         'presentacion'=>  $this->presentacion,
        //         'unidad_id'=>  $this->unidad_id,
        //         'descuento'=>  $this->descuento,
        //         'unidadVenta'=>  $this->unidadVenta,
        //         'precioF'=>  $this->precioF,
        //         'precioI'=>  $this->precioI,
        //         'caducidad'=>  $this->caducidad,
        //         'detalles'=>  $this->detalles,
        //         'suelto'=>  $this->suelto,
        //         'activo'=>1
        //     ]);        
        // } 
        //     catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
        


        $ultimo=Articulo::latest()->first();
        $qrData =  $ultimo->id;
        $qr = new Generator('gd'); // Forzamos el motor GD
        $qrImage = $qr->format('png')
            ->size(200)
            ->generate($qrData);
        
            $fileName = 'qrcodes/articulo_'.$ultimo->id.'.png';


        Storage::disk('public')->put($fileName, $qrImage);
        
        //---------------------------
        
       

        Storage::disk('public')->put($fileName, $qrImage);

        // 4. Guardar la ruta del QR en la base de datos
        $articulo = Articulo::find($ultimo->id);
        $articulo->qr_code = $fileName;
        $articulo->save();

        // 5. Mensaje o redirección
        session()->flash('message', 'Artículo creado con QR generado correctamente.');
        //---------------------------
        
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
        //$this->borrarCampos();
        $this->confirmingArticuloAdd=false;
        $this->dispatch('articuloActualizado');

    }

    public function borrarCampos(){
        $this->articulo='';
         $this->categoria_id='';
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
         $this->proveedor_id='';
     }
      public $categoriaAdd=false;
    public $categoria;
    public function addCategoria(){
        $this->categoriaAdd=true;

    }
    public function saveCategoria()  {
        $this->validate(['categoria'=>'required|min:3']);
        Categoria::create([
            'categoria'=>$this->categoria
        ]);
        $this->categorias=Categoria::All();
        $this->categoriaAdd=false;
    }
    public function Ofeta($id){
        $ofertaArt = Ofertas::where('articulo_id', $id)->exists();
        return $ofertaArt ? true : false;
    }
}

