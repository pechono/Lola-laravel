<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ImprimirPedidoController extends Controller
{
    public function imprimir($id)
    {
        return view('stock.imprimirPedido',  ['pedidoId' => $id]);
    }
}
