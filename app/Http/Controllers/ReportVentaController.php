<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportVentaController extends Controller
{
    public function pasar($operacion)
    {
    return view('venta.reporte',compact('operacion'));
}
}
