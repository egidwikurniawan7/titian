<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/menu/{slug}', [PageController::class, 'show'])->name('menu.show');
Route::get('/kue-custom', [PageController::class, 'custom'])->name('custom');
Route::get('/keranjang', [PageController::class, 'cart'])->name('cart');
