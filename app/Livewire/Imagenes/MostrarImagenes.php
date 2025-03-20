<?php

namespace App\Livewire\Imagenes;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MostrarImagenes extends Component
{
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
        return view('livewire.imagenes.mostrar-imagenes');
    }
}
