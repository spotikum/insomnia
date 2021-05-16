<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/select/product/{id}', [ProductsController::class, 'selectproduct']);

Route::group(['middleware' => ['auth:user','verified']], function(){
	Route::get('/user/home', [UserController::class, 'index'])->name('user.home');
	ROute::get('/buy', [UserController::class, 'buyproduct'])->name('buy');
	Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');	
});

Route::group(['middleware' => 'guest'], function(){
	Route::get('/', [UserController::class, 'index'])->name('user.home');
	Route::get('/login', [AuthController::class, 'loginpage'])->name('login');
	Route::get('/login/admin', [AuthController::class, 'loginadmin']);
	Route::get('/daftar/admin', [AuthController::class, 'registeradmin'])->name('registeradmin');
	Route::post('/post/register/admin', [AuthController::class, 'doRegAdmin'])->name('doRegAdmin');
	Route::post('/post/register', [AuthController::class, 'doRegis'])->name('doRegis');
	Route::post('/post/login', [AuthController::class, 'doLogin'])->name('doLogin');
	Route::post('/post/login/admin', [AuthController::class, 'doLoginAdmin'])->name('doLoginAdmin');
	Route::get('/konfirmasi/{email}', [AuthController::class, 'confirmemail']);
	Route::get('/konfirmasi/status', [AuthController::class, 'showstatus']);
	Route::get('/forgot/password', [AuthController::class, 'forgotpasspage'])->name('forgotpass');
	Route::post('/do/forgot', [AuthController::class, 'doforgot'])->name('doforgot');
	Route::get('/lupa/pass/{email}', [AuthController::class, 'lupapass'])->name('lupapass');
	Route::post('/ubah/pass', [AuthController::class, 'ubahpass'])->name('ubahpass');
});

Route::group(['middleware' => 'auth:admin'], function(){
	Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');

	Route::get('/daftar/diskon', [ProductsController::class, 'listdiskon'])->name('listdiskon');
	Route::post('/save/diskon', [ProductsController::class, 'savediskon'])->name('savediskon');

	Route::get('/daftar/review', [ProductsController::class, 'listreview'])->name('listreview');
	Route::get('/hapus/review', [ProductsController::class, 'hapusreview'])->name('admin.hapus.review');

	Route::post('/post/foto/product', [ProductsController::class, 'saveproductimage'])->name('post.fotoproduk');
	Route::get('/list/products', [ProductsController::class , 'index'])->name('list.products');
	Route::post('/save/product', [ProductsController::class, 'saveproduct'])->name('save.product');
	Route::get('/ubah/product/page', [ProductsController::class, 'ubahproductpage'])->name('ubah.product.page');
	Route::post('/ubah/product', [ProductsController::class, 'ubahproduct'])->name('ubah.product');
	Route::get('/hapus/product', [ProductsController::class, 'hapusproduct'])->name('hapus.product');

	Route::get('/list/courier', [CourierController::class , 'index'])->name('list.courier');
	Route::post('/save/courier', [CourierController::class, 'savecou'])->name('save.courier');
	Route::post('/ubah/courier', [CourierController::class, 'ubahcou'])->name('ubah.courier');
	Route::get('/hapus/courier', [CourierController::class, 'hapuscou'])->name('hapus.courier');

	Route::get('/list/category', [CategoryController::class , 'index'])->name('list.category');
	Route::post('/save/category', [CategoryController::class, 'savecategory'])->name('save.category');
	Route::post('/ubah/category', [CategoryController::class, 'ubahcategory'])->name('ubah.category');
	Route::get('/hapus/category', [CategoryController::class, 'hapuscategory'])->name('hapus.category');

	Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});