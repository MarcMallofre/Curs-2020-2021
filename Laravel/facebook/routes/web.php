<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('home', [HomeController::class, 'index']) -> name("home") ;

Route::post('message/send', [HomeController::class, 'send']) -> name("send");

Route::post('privateMessage/send', [HomeController::class, 'sendPrivateMessage']) -> name("sendPrivateMessage");

Route::post('comment/send', [HomeController::class, 'sendComment']) -> name("sendComment");

Route::post('like', [HomeController::class, 'like']) -> name("sendLike");