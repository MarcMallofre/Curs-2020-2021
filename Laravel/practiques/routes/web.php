<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('index', [ProductoController::class, 'index'])->name('listaProductos');

Route::get('formAñadir', [ProductoController::class, 'create'])->name("formularioAñadirProducto");

Route::post('añadir', [ProductoController::class, 'store'])->name("añadirProducto");

Route::get('formEditar/{id}', [ProductoController::class, 'edit'])->name("formularioEditar");

Route::post('editar/{id}', [ProductoController::class, 'update'])->name("editarProducto");

Route::get('borrar/{id}', [ProductoController::class, 'destroy'])->name("borrar");



require __DIR__.'/auth.php';
