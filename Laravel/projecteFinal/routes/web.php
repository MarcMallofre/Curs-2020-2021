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


//Ruta de la pagina principal
Route::get('/home', [ProjecteController::class, 'index']) -> name("home"); 

//Ruta del formulario de briefing
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');                   

//Ruta privada del crud de administradores
Route::get('/administradores', [AdminController::class, 'index'])->middleware(['auth'])->name('administradores');

//Ruta post para añadir administradores
Route::post('/añadirAdmin', [AdminController::class, 'store'])-> name("añadirAdmin");

//Ruta post para eliminar admins
Route::post('/eliminarAdmin/{id}', [AdminController::class, 'destroy'])-> name("eliminarAdmin");

//Ruta privada para editar datos de usuario
Route::get('/editarUsuario/{id}', [UsuarioController::class, 'edit']) ->middleware(['auth'])-> name("editarUsuario");

//Ruta post para actualizar datos de usuario
Route::post('/actualizaUsuario/{id}', [UsuarioController::class, 'update'])-> name("actualizaUsuario");

//Ruta post para eliminar un usuario
Route::post('/eliminarUsuario/{id}', [UsuarioController::class, 'destroy']) -> name("eliminarUsuario");

//Ruta privada del formulario para añadir un proyecto
Route::get('/añadirProyecto', [ProjecteController::class, 'create'])->middleware(['auth'])->name('añadirProyecto');

//Ruta post para guardar un proyecto nuevo
Route::post('/guardarProyecto', [ProjecteController::class, 'store'])-> name("guardarProyecto");

//Ruta privada del formulario para editar un proyecto
Route::get('/editarProyecto/{id}', [ProjecteController::class, 'edit'])->middleware(['auth'])->name('editarProyecto');

//Ruta post para actualizar un proyecto
Route::post('/actualizaProyecto/{id}', [ProjecteController::class, 'update'])->middleware(['auth']) -> name("actualizaProyecto");

//Ruta privada para eliminar una imagen de un proyecto
Route::get('/eliminarImagenProyecto/{id}', [ProjecteController::class, 'destroy'])->middleware(['auth']) -> name("eliminarImagenProyecto");

//Ruta de la tienda
Route::get('/tienda', [ProducteController::class, 'index'])->name('tienda');

//Ruta privada del formulario para añadir un producto
Route::get('/añadirProducto', [ProducteController::class, 'create'])->middleware(['auth'])->name('añadirProducto');

//Ruta post para guardar un producto nuevo
Route::post('/guardarProducto', [ProducteController::class, 'store'])-> name("guardarProducto");

//Ruta privada del crud de productos
Route::get('/productos', [ProducteController::class, 'productos'])->middleware(['auth'])->name('productos');

//Ruta privada para eliminar una imagen de un producto
Route::get('/eliminarImagenProducto/{id}', [ImatgeProducteController::class, 'destroy'])->middleware(['auth']) -> name("eliminarImagenProducto");

//Ruta post para eliminar un producto
Route::post('/eliminarProducto/{id}', [ProducteController::class, 'destroy']) -> name("eliminarProducto");

//Ruta del formulario para editar un producti
Route::post('/editarProducto/{id}', [ProducteController::class, 'edit']) -> name("editarProducto");

//Ruta post para actualizar un prodcuto
Route::post('/actualizaProducto/{id}', [ProducteController::class, 'update']) -> name("actualizaProducto");

//Ruta publica de un producto
Route::get('/producto/{id}', [ProducteController::class, 'show'])->name('producto');

//Ruta post para enviar mail los datos del formulario de briefing
Route::post('/enviarMailBriefing', [MailController::class, 'mailBriefing'])->name('enviarMailBriefing');

//Ruta para enviar mail con los datos del formulario de saludo
Route::post('/enviarMailSaluda', [MailController::class, 'mailSaluda'])->name('enviarMailSaluda');

//Ruta post para añadir productos al carrito
Route::post('/añadirCarrito', [CartController::class, 'store'])->name('añadirCarrito');

//Ruta post para elminar prodcutos del carrito
Route::post('/eliminarCarrito/{cart}', [CartController::class, 'destroy'])->name('eliminarCarrito');

//Ruta para actualizar los datos del carrito
Route::post('/actualizarCarrito/{id}', [CartController::class, 'update'])->name('actualizarCarrito');

//Ruta publica del carrito de compra
Route::get('/carrito', [CartController::class, 'index'])->name('carrito');

//Ruta para el buscador de la tienda
Route::post('/busqueda', [ProducteController::class, 'busqueda'])->name('busqueda');

//Ruta privada del formulario de pago
Route::get('/pagar', [PaymentController::class, 'index'])->middleware(['auth'])->name('pagar');

//Ruta para realizar el pago
Route::post('/transaction', [PaymentController::class, 'makePayment'])->name('make-payment');

//Ruta privada del crud de los pedidos
Route::get('/pedidos', [ComandaController::class, 'index'])->middleware(['auth'])->name('pedidos');

//Ruta privada de cada pedido
Route::get('/pedido/{id}', [ComandaController::class, 'show'])->middleware(['auth'])->name('pedido');