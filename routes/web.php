<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [ProductController::class, 'home']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


Route::resource('products', ProductController::class)->middleware(['auth']);
Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware(['auth'])->name('orders.show');


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/auth', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/error', function() {
    $message = session('message') ?? 'Произошла ошибка!';
    return view('error', compact('message'));
})->name('error');
