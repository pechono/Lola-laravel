<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'articulo',
        'codigo',
        'categoria_id',
        'presentacion',
        'unidad_id',
        'descuento',
        'unidadVenta',
        'precioF',
        'precioI',
        'caducidad',
        'detalles',
        'suelto',
        'activo',
    ];
}
