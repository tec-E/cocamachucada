<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan; // no olvides importar Artisan

Route::redirect('/', '/admin/login');

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

// Ruta temporal para limpiar caché y verificar APP_DEBUG
Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache cleared";
});
