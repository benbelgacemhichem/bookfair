<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');
// Auth::routes([ 'reset' => false]);

Route::get('/home/{lang}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/book/submit', [App\Http\Controllers\HomeController::class, 'book_submit'])->name('book.submit');

Route::get('/bags/{lang}', [App\Http\Controllers\HomeController::class, 'bags'])->name('bags');
Route::post('/bags/submit', [App\Http\Controllers\HomeController::class, 'bag_submit'])->name('bags.submit');


Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
Route::get('/admin/new_book', [App\Http\Controllers\AdminController::class, 'newBook'])->name('admin.new-book');
Route::get('/admin/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
Route::post('/admin/add_book', [App\Http\Controllers\AdminController::class, 'addBook'])->name('admin.add-book');
Route::get('/bags/status/update', [App\Http\Controllers\HomeController::class, 'active']);
