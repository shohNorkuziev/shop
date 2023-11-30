<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class,'index'])->name('index');
Route::get('/info',[UserController::class,'info'])->name('info');

// Route::get('/products',[ProductController::class,'index']);
// Route::get('/proucts/{id}',[ProductController::class,'show']);
// Route::post('/proucts',[ProductController::class,'store']);
// Route::patch('/proucts/{id}',[ProductController::class,'update']);
// Route::delete('/products/{id}',[ProductController::class,'destroy']);

Route::resource('/products',ProductController::class)->except('index');
Route::resource('/categories', CategoryController::class);
Route::get('/sort/{id}/{sort}', [ProductController::class, 'sort'])->name('sort');
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('/create',[UserController::class,'create'])->name('create');
Route::post('/store',[UserController::class,'store'])->name('store');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/signup',[UserController::class,'signup'])->name('signup');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/cart',[ProductController::class,'cart'])->name('cart');
Route::get('/cart/view', [ProductController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/clear', [ProductController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/checkout', [ProductController::class, 'checkout'])->name('cart.checkout');

