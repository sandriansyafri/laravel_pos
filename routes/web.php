<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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

Route::middleware(['auth'])->group(function () {
      Route::view('/', 'dashboard')->name('dashboard');
      Route::post('logout', LogoutController::class)->name('logout');
});

Route::middleware(['guest'])->group(function () {
      Route::get('register', [RegisterController::class, 'index'])->name('register');
      Route::post('register', RegisterController::class);
      Route::get('login', [LoginController::class, 'index'])->name('login');
      Route::post('login', LoginController::class)->name('login');
});
