<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekUser;
use App\Http\Middleware\CekAdmin;
use App\Models\Checkout;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/konfirmasi/{code}', [CheckoutController::class, 'konfirmasi'])->name('konfirmasi');

Route::get('/', function () {
    return view('index', [
        'categories' => Kategori::all()
    ]);
});
Route::middleware([CekUser::class])->group(function () {
    Route::resource('shop', 'App\Http\Controllers\shopController');
    Route::resource('product', 'App\Http\Controllers\detailController');
    Route::resource('cart', 'App\Http\Controllers\CartController');
    Route::resource('checkout', 'App\Http\Controllers\CheckoutController');
});

Route::middleware([CekAdmin::class])->group(function () {
    Route::resource('admin', 'App\Http\Controllers\adminController');
    Route::get('admin-checkout', 'App\Http\Controllers\CheckoutController@admin_index');
    Route::put('admin-checkout/{id}', 'App\Http\Controllers\CheckoutController@update_status');
});
