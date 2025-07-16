<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto;

Route::redirect('/', '/admin/login');

Route::get('/productos', function () {
    $productos = Producto::with('categoria')->where('cantidad', '>', 0)->get();
    return view('productos.index', compact('productos'));
});
