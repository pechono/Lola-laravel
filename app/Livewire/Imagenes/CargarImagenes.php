<?php

namespace App\Livewire\Imagenes;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use App\Models\Imagen;

class CargarImagenes extends Component
{
    use WithFileUploads;

    public $imagen;
    public $detalle;
    protected $rules = [
        'imagen' => 'required|image|max:1024', // 1MB máximo
    ];

    public function save()
{
    $this->validate();

    $uniqueName = uniqid() . '.' . $this->imagen->getClientOriginalExtension();
    $imagePath = $this->imagen->storeAs('images/marcas', $uniqueName, 'public');

    $url = asset( $imagePath); // Genera la URL completa

    Imagen::create([
        'path' => $uniqueName,
        'detalle' => $this->detalle,
    ]);

    session()->flash('message', '¡Imagen subida correctamente!');
    $this->mount();
    
    }
    
    public $imagenes = [];

    public function mount()
    {
        // Lee las imágenes desde la carpeta 'public/images' y convierte a array de strings (rutas)
        $files = File::files(public_path('storage/images/marcas/'));

        // Extraemos solo los nombres de archivo (o rutas completas si lo prefieres)
        $this->imagenes = array_map(function($file) {
            return $file->getFilename(); // O $file->getRealPath() si prefieres la ruta completa
        }, $files);
    }

    public function render()
    {
        return view('livewire.imagenes.cargar-imagenes');
    }
    public function detallesResc($nombre){
        $detalles=Imagen::where('path',$nombre)->first();
        return $detalles->detalle;

    }
}
