<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TokoController;
/*
|-------------------------------------------------------------------------
-
| Web Routes
|-------------------------------------------------------------------------
-
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    Auth::routes();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/toko', [TokoController::class, 'index'])->name('Toko');


    //menampilkan crud produk admin 
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    });

    Route::middleware(['auth','role:user'])->group(function () {
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); //view detail produk user
        Route::get('/products', [ProductController::class, 'index'])->name('products.index'); //halaman produk user
    });
   
    //menampilkan crud cart user
    Route::middleware(['auth'])->group(function () {
        Route::resource('carts', CartController::class); 
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::patch('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.destroy');
        Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    });


});
