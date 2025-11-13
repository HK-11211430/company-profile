<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/produk', [PageController::class, 'produk'])->name('produk');
Route::get('/artikel', [PageController::class, 'artikel'])->name('artikel');
Route::get('/artikel/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [PageController::class, 'galeriDetail'])->name('galeri.detail');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.send');
