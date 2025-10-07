<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/user', function () {
    return view('user');
});
Route::get('/add-user', function () {
    return view('pages.user.add_user');
});
// Route::get('/', [StudentController::class, 'index']);

// Route::get('create', [StudentController::class, 'create'])->name('create');
// Route::post('store', [StudentController::class, 'store'])->name('store');

