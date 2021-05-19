<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProjecteController;
use App\Http\Controllers\ProducteController;
use App\Http\Controllers\ImatgeProducteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComandaController;
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

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/administradores', [AdminController::class, 'index'])->middleware(['auth'])->name('administradores');

Route::post('/añadirAdmin', [AdminController::class, 'store'])-> name("añadirAdmin");

Route::post('/eliminarAdmin/{id}', [AdminController::class, 'destroy'])-> name("eliminarAdmin");

Route::get('/editarUsuario/{id}', [UsuarioController::class, 'edit']) ->middleware(['auth'])-> name("editarUsuario");

Route::post('/actualizaUsuario/{id}', [UsuarioController::class, 'update'])-> name("actualizaUsuario");

Route::post('/eliminarUsuario/{id}', [UsuarioController::class, 'destroy']) -> name("eliminarUsuario");

Route::get('/añadirProyecto', [ProjecteController::class, 'create'])->middleware(['auth'])->name('añadirProyecto');

Route::post('/guardarProyecto', [ProjecteController::class, 'store'])-> name("guardarProyecto");

Route::get('/editarProyecto/{id}', [ProjecteController::class, 'edit'])->middleware(['auth'])->name('editarProyecto');

Route::post('/actualizaProyecto/{id}', [ProjecteController::class, 'update'])->middleware(['auth']) -> name("actualizaProyecto");

Route::get('/eliminarImagenProyecto/{id}', [ProjecteController::class, 'destroy']) -> name("eliminarImagenProyecto");

Route::get('/tienda', [ProducteController::class, 'index'])->name('tienda');

Route::get('/añadirProducto', [ProducteController::class, 'create'])->middleware(['auth'])->name('añadirProducto');

Route::post('/guardarProducto', [ProducteController::class, 'store'])-> name("guardarProducto");

Route::get('/productos', [ProducteController::class, 'productos'])->middleware(['auth'])->name('productos');

Route::get('/eliminarImagenProducto/{id}', [ImatgeProducteController::class, 'destroy']) -> name("eliminarImagenProducto");

Route::post('/eliminarProducto/{id}', [ProducteController::class, 'destroy']) -> name("eliminarProducto");

Route::post('/editarProducto/{id}', [ProducteController::class, 'edit']) -> name("editarProducto");

Route::post('/actualizaProducto/{id}', [ProducteController::class, 'update']) -> name("actualizaProducto");

Route::get('/producto/{id}', [ProducteController::class, 'show'])->name('producto');

Route::post('/enviarMailBriefing', [MailController::class, 'mailBriefing'])->name('enviarMailBriefing');

Route::post('/enviarMailSaluda', [MailController::class, 'mailSaluda'])->name('enviarMailSaluda');

Route::post('/añadirCarrito', [CartController::class, 'store'])->name('añadirCarrito');

Route::post('/eliminarCarrito/{cart}', [CartController::class, 'destroy'])->name('eliminarCarrito');

Route::post('/actualizarCarrito/{id}', [CartController::class, 'update'])->name('actualizarCarrito');

Route::get('/carrito', [CartController::class, 'index'])->name('carrito');

Route::post('/busqueda', [ProducteController::class, 'busqueda'])->name('busqueda');

Route::get('/pagar', [PaymentController::class, 'index'])->middleware(['auth'])->name('pagar');

Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');

Route::get('/pedidos', [ComandaController::class, 'index'])->middleware(['auth'])->name('pedidos');

Route::get('/pedido/{id}', [ComandaController::class, 'show'])->middleware(['auth'])->name('pedido');