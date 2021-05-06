<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProjecteController;
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

require __DIR__.'/auth.php';


Route::get('/home', [ProjecteController::class, 'index']) -> name("home");

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/administradores', [AdminController::class, 'index'])->middleware(['auth'])->name('administradores');

Route::post('/añadirAdmin', [AdminController::class, 'store']) -> name("añadirAdmin");

Route::post('/eliminarAdmin/{id}', [AdminController::class, 'destroy']) -> name("eliminarAdmin");

Route::get('/editarUsuario/{id}', [UsuarioController::class, 'edit']) -> name("editarUsuario");

Route::post('/actualizaUsuario/{id}', [UsuarioController::class, 'update']) -> name("actualizaUsuario");

Route::get('/eliminarUsuario/{id}', [UsuarioController::class, 'destroy']) -> name("eliminarUsuario");

Route::get('/añadirProyecto', [ProjecteController::class, 'create'])->middleware(['auth'])->name('añadirProyecto');

Route::post('/guardarProyecto', [ProjecteController::class, 'store']) -> name("guardarProyecto");

Route::get('/editarProyecto/{id}', [ProjecteController::class, 'edit'])->middleware(['auth'])->name('editarProyecto');

Route::post('/actualizaProyecto/{id}', [ProjecteController::class, 'update']) -> name("actualizaProyecto");

Route::get('/eliminarImagenProyecto/{id}', [ProjecteController::class, 'destroy']) -> name("eliminarImagenProyecto");