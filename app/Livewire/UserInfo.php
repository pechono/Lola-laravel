<?php 
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserInfo extends Component
{
    public $user;

    public function mount()
    {
        // Obtiene el usuario autenticado
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.user-info');
    }
}
