<?php

namespace App\Livewire\Articulo;

use Livewire\Component;

class ArticuloMain extends Component
{
    public $view = 'lista'; // 'lista', 'crear', 'editar'
    
    public function render()
    {
        return view('livewire.articulo.articulo-main');
    }
    
    public function setView($viewName)
    {
        $this->view = $viewName;
    }
}
