<?php

use App\Http\Controllers\UserController;
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
    return view('login');
});
Route::get('register', [UserController::class, 'indexRegister'])->name('register');
Route::post('register', [UserController::class, 'register'])->name('register.post');
Route::get('login', [UserController::class, 'indexLogin'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.post');
Route::get('home', [UserController::class, 'index'])->name('home');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

