<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
// Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
// Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
// Route::post('/prouct/update/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');