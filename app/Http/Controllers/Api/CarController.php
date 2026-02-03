<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Car;

class CarController extends Controller
{
    // 🧾 Listar los artículos del carrito
    public function index()
    {
        $items = Car::with('articulo')->get();
        return response()->json($items);
    }

    // 🔍 Buscar un artículo por su código
    public function buscarArticulo($id)
    {
        $articulo = Articulo::where('id', $id)->first();

        if (!$articulo) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

        return response()->json($articulo);
    }

    // ➕ Agregar artículo al carrito
    public function agregar(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'cantidad' => 'required|integer|min:1'
        ]);

        $articulo = Articulo::where('codigo', $request->id)->first();

        if (!$articulo) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

        // Buscar si ya existe en el carrito
        $item = Car::where('articulo_id', $articulo->id)->first();

        if ($item) {
            $item->cantidad += $request->cantidad;
            $item->save();
        } else {
            $item = Car::create([
                'articulo_id' => $articulo->id,
                'cantidad' => $request->cantidad,
            ]);
        }

        return response()->json(['success' => true, 'item' => $item]);
    }

    // ✏️ Actualizar cantidad
    public function actualizarCantidad(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'cantidad' => 'required|integer|min:0'
        ]);

        $articulo = Articulo::where('id', $request->id)->first();

        if (!$articulo) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

        $item = Car::where('articulo_id', $articulo->id)->first();

        if (!$item) {
            return response()->json(['error' => 'El artículo no está en el carrito'], 404);
        }

        if ($request->cantidad == 0) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Artículo eliminado']);
        }

        $item->cantidad = $request->cantidad;
        $item->save();

        return response()->json(['success' => true, 'item' => $item]);
    }

    // ❌ Eliminar artículo del carrito
    public function eliminar($id)
    {
        $articulo = Articulo::where('id', $id)->first();

        if (!$articulo) {
            return response()->json(['error' => 'Artículo no encontrado'], 404);
        }

        $item = Car::where('articulo_id', $articulo->id)->first();

        if (!$item) {
            return response()->json(['error' => 'El artículo no está en el carrito'], 404);
        }

        $item->delete();

        return response()->json(['success' => true, 'message' => 'Artículo eliminado']);
    }
}
