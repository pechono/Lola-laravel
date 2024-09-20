<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function ventas()
{
    return $this->hasMany(Venta::class);
}
}
