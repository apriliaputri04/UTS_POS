<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;

// Route untuk dashboard (hanya satu definisi route untuk '/')
Route::get('/', [WelcomeController::class, 'index'])->name('dashboard')->middleware('auth');

// Rute otentikasi
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin'])->name('postlogin');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Route barang
    Route::group(['prefix' => 'barang'], function() {
        Route::get('/', [BarangController::class, 'index'])->name('barang.index');
        Route::post('/list', [BarangController::class, 'list'])->name('barang.list');
        Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
        Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Route order
    Route::group(['prefix' => 'order'], function() {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::post('/list', [OrderController::class, 'list'])->name('order.list');
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/', [OrderController::class, 'store'])->name('order.store');
        Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    });
});