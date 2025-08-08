<?php

namespace App\Livewire\Articulo;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Unidad;
use Livewire\Component;

class ArticuloEdit extends Component
{
    public $confirmingArticuloEdit = false;
    public ?int $articuloId = null;

    public $categorias = [], $unidades = [], $proveedores = [];

    public $articulo,
           $codigo,
           $codigo_original,
           $categoria_id,
           $presentacion,
           $unidad_id,
           $descuento,
           $unidadVenta,
           $detalles,
           $idArtitulo;

    public function render()
    {
        $this->confirmingArticuloEdit = true;

        $edit = Articulo::select(
                'articulos.id', 'articulos.codigo','articulos.articulo', 'articulos.presentacion',
                'articulos.descuento', 'articulos.unidadVenta', 'articulos.precioF', 'articulos.precioI',
                'articulos.caducidad', 'articulos.detalles', 'articulos.suelto', 'articulos.activo',
                'stocks.stock', 'stocks.stockMinimo', 'articulos.unidad_id',
                'articulos.categoria_id', 'proveedor_id'
            )
            ->join('stocks', 'stocks.articulo_id', '=', 'articulos.id')
            ->findOrFail($this->articuloId);

        // Asignar valores al componente
        $this->articulo         = $edit->articulo;
        $this->codigo           = $edit->codigo;
        $this->codigo_original  = $edit->codigo; // se guarda para comparación
        $this->categoria_id     = $edit->categoria_id;
        $this->presentacion     = $edit->presentacion;
        $this->unidad_id        = $edit->unidad_id;
        $this->descuento        = $edit->descuento;
        $this->unidadVenta      = $edit->unidadVenta;
        $this->detalles         = $edit->detalles;
        $this->idArtitulo       = $edit->id;

        // Listas desplegables
        $this->categorias  = Categoria::all();
        $this->unidades    = Unidad::all();
        $this->proveedores = Proveedor::all();

        return view('livewire.articulo.articulo-edit');
    }

    public function updateArticulo()
    {
        $this->validate([
            'articulo'      => 'required|string|min:4',
            'categoria_id'  => 'required',
            'presentacion'  => 'required|string|min:1',
            'unidad_id'     => 'required',
            'descuento'     => 'required|numeric',
            'unidadVenta'   => 'required|string|min:1',
            'detalles'      => 'required|string',
            'codigo' => [
                'nullable',
                'alpha_num',
                function ($attribute, $value, $fail) {
                    if (!$value) return;

                    // Validar solo si el código fue modificado
                    if ($value !== $this->codigo_original) {
                        $existe = Articulo::where('codigo', $value)->exists();

                        if ($existe) {
                            $fail('El código ya está en uso por otro artículo.');
                        }
                    }
                }
            ],
        ]);

        Articulo::where('id', $this->articuloId)->update([
            'articulo'      => $this->articulo,
            'codigo'        => $this->codigo, // se incluye si fue cambiado
            'presentacion'  => $this->presentacion,
            'descuento'     => $this->descuento,
            'unidadVenta'   => $this->unidadVenta,
            'categoria_id'  => $this->categoria_id,
            'detalles'      => $this->detalles,
            'unidad_id'     => $this->unidad_id,
        ]);

        $this->closeModal();
    }

    public function closeModal()
    {
        
       $this->dispatch('articuloActualizado', mostrarModal: false);
        $this->reset([
            'articulo', 'codigo', 'categoria_id', 'presentacion',
            'unidad_id', 'descuento', 'unidadVenta', 'detalles', 'codigo_original'
        ]);
        $this->confirmingArticuloEdit = false;
    }
}
