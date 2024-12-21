<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyHomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resource\MaterialController;
use App\Http\Controllers\Resource\StudentController;
use App\Http\Controllers\TermOfServiceController;
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

Route::get('/', HomeController::class)->name('home');
Route::get('/help', HelpController::class)->name('help');
Route::get('/faq', FaqController::class)->name('faq');
Route::get('/privacy-policy', PrivacyPolicyController::class)->name('privacy-policy');
Route::get('/term-of-service', TermOfServiceController::class)->name('term-of-service');
Route::get('/contact-us', ContactUsController::class)->name('contact-us');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', LoginController::class)->name('login');
        Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
    });

    Route::get('/logout', LogoutController::class)
        ->middleware('auth')
        ->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', MyHomeController::class)->name('my-home');

    Route::resource('student', StudentController::class);
    Route::resource('material', MaterialController::class);

    Route::get('/profile', ProfileController::class)->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/download', DownloadController::class)->name('download');

Route::impersonate();
