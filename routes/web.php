<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', LandingController::class)->name('landing');
Route::get('/home', HomeController::class)->name('home');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', LoginController::class)->name('login');
        Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');

        Route::get('/register', RegisterController::class)->name('register');
        Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');
    });

    Route::get('/logout', LogoutController::class)
        ->middleware('auth')
        ->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/download', DownloadController::class)->name('download');

Route::impersonate();
