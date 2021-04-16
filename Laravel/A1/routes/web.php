<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

Route::get('/formulario', [FormController::class, 'formulario']);
Route::post('/showform', [FormController::class, 'showform'])->name("postform");

Route::get('/formAvanzado', [FormController::class, 'formAvanzado'])->middleware('auth');
Route::post('/showFormAvanzado', [FormController::class, 'showFormAvanzado'])->name("postFormAvanzado");

require __DIR__.'/auth.php';
