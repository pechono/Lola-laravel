<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NroEgreso extends Model
{
    use HasFactory;
    protected $fillable = [
        'numeroEgreso',
        'monto',
        'detalles',
    ];
}
