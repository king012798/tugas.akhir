<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembelianController;
use App\Http\Livewire\Order;

Route::get('/', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'ShowFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('produk',ProdukController::class);

    Route::get('penjualan', Order::class)->name('penjualan.index');

    Route::resource('pembelian', PembelianController::class);
    
});

Route::get('/', function () {
    return view('welcome');
});

