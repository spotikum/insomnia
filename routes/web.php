<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route Dashboard
Route::resource('/', 'user\DashboardController');

Route::resource('/shop', 'user\ShopController');



Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function (){
    //Dashboard routes
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    //Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    //Logout routes
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    //Reset password routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});


// Route Product
Route::resource('/product', 'ProductController');
Route::delete('product/{product}/edit', 'ProductController@imageDelete')->name('product.imageDelete');

// Route Category
Route::resource('/category', 'CategoryController');

// Route Courier
Route::resource('/couriers', 'CourierController');

// Route Diskon
Route::resource('/discount', 'DiscountController');













// Route::get('/home', 'HomeController@index')->name('home');

// //Route::view('login', 'admin')->middleware('verified');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
