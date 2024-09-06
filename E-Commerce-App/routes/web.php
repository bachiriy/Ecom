<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class , 'index']);
Route::get('/products', [ProductController::class , 'index'])->name('products');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductController::class , 'show'])->name('product.show');
Route::get('/products/{id}/edit', [ProductController::class , 'edit'])->name('product.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/profile',[UserController::class, 'show'])->name('users.profile');
Route::get('/{authPage}', [AuthController::class, 'index'])->name('auth.dynamic');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'logout'])->name('logout');

Route::delete('/', [UserController::class, 'destroy'])->name('account.delete');
Route::put('/', [UserController::class, 'update'])->name('account.update');

Route::resource('products', ProductController::class);
