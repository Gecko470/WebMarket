<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Livewire\OrderCreate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/show/{product}', [HomeController::class, 'show'])->name('show');

Route::get('/carrito', [HomeController::class, 'carrito'])->name('carrito');

Route::get('/showcategory/{id}', [HomeController::class, 'showcategory'])->name('showcategory');

Route::get('/showsubcategory/{id}', [HomeController::class, 'showsubcategory'])->name('showsubcategory');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/order/create', OrderCreate::class)->name('order.create');

    Route::get('/order/{order}/payment', [OrderController::class, 'payment'])->name('order.payment');

    Route::get('/order/{order}/show', [OrderController::class, 'show'])->name('order.show');

    Route::get('/areaPersonal', [OrderController::class, 'aPersonal'])->name('aPersonal');

    Route::post('/valoraciones/{product}', [HomeController::class, 'valoraciones'])->name('valoraciones');
});
