<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto;

Route::redirect('/', '/admin');

Route::get('/productos', function () {
    $productos = Producto::with('categoria')->where('cantidad', '>', 0)->get();
    return view('productos.index', compact('productos'));
});

Route::get('/probar-db', function () {
    try {
        $tablas = DB::select('SHOW TABLES');
        return response()->json($tablas);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});
