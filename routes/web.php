<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/productos', function () {
    $productos = Producto::with('categoria')->where('cantidad', '>', 0)->get();
    return view('productos.index', compact('productos'));
});
