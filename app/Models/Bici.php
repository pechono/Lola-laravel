<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bici extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'color',
        'tipo_id',
        'marca_id',
        'detalles',
    ];
}
