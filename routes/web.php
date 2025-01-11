<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/product', function () {
    return view('product');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/transaction', function () {
    return view('transaction');
});
Route::get('/transaction/success', function () {
    return view('tsuccess');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('registration');
});