<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAccount\ChangePasswordController;
use App\Http\Controllers\MyAccount\ProfileController;
use App\Http\Controllers\MyHomeController;
use App\Http\Controllers\MyMaterialController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\Resource\ArticleController;
use App\Http\Controllers\Resource\ContentController;
use App\Http\Controllers\Resource\ExamController;
use App\Http\Controllers\Resource\FileController;
use App\Http\Controllers\Resource\MaterialController;
use App\Http\Controllers\Resource\OptionController;
use App\Http\Controllers\Resource\QuestionController;
use App\Http\Controllers\Resource\StudentController;
use App\Http\Controllers\Resource\TeacherController;
use App\Http\Controllers\Resource\UserController;
use App\Http\Controllers\TermOfServiceController;
use App\Http\Controllers\UserGuideController;
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

Route::prefix('auth')->name('auth.')->group(function () {
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
    Route::get('/user-guide', UserGuideController::class)->name('user-guide');

    Route::resource('teacher', TeacherController::class)->parameters(['teacher' => 'user']);
    Route::resource('student', StudentController::class);
    Route::resource('material', MaterialController::class);
    Route::resource('user', UserController::class);

    Route::get('/content/{content}/order/edit', [ContentController::class, 'orderEdit'])->name('content.order.edit');
    Route::put('/content/{content}/order', [ContentController::class, 'orderUpdate'])->name('content.order.update');

    Route::get('/material/{material}/file/{file}', [FileController::class, 'show'])->name('file.show');
    Route::get('/material/{material}/file/{file}/edit', [FileController::class, 'edit'])->name('file.edit');
    Route::put('/material/{material}/file/{file}', [FileController::class, 'update'])->name('file.update');
    Route::post('/file/{material}', [FileController::class, 'store'])->name('file.store');
    Route::delete('/material/{material}/file/{file}', [FileController::class, 'destroy'])->name('file.destroy');
    Route::get('/file/{file}/download', [FileController::class, 'download'])->name('file.download');

    Route::get('material/{material}/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('material/{material}/article/{article}', [ArticleController::class, 'show'])->name('article.show');
    Route::get('material/{material}/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('article/{article}', [ArticleController::class, 'update'])->name('article.update');
    Route::post('material/{material}/article', [ArticleController::class, 'store'])->name('article.store');
    Route::delete('material/{material}/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('/material/{material}/article/{slug}/read', [ArticleController::class, 'read'])->name('article.read');

    Route::get('material/{material}/exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::post('material/{material}/exam', [ExamController::class, 'store'])->name('exam.store');
    Route::get('material/{material}/exam/{exam}', [ExamController::class, 'show'])->name('exam.show');
    Route::get('material/{material}/exam/{exam}/edit', [ExamController::class, 'edit'])->name('exam.edit');
    Route::put('material/{material}/exam/{exam}', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('material/{material}/exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');

    Route::get('material/{material}/exam/{exam}/question/{question}', [QuestionController::class, 'show'])->name('question.show');
    Route::post('material/{material}/exam/{exam}/question', [QuestionController::class, 'store'])->name('question.store');
    Route::get('material/{material}/exam/{exam}/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('material/{material}/exam/{exam}/question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('material/{material}/exam/{exam}/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('/question/{question}/order/edit', [QuestionController::class, 'orderEdit'])->name('question.order.edit');
    Route::put('/question/{question}/order', [QuestionController::class, 'orderUpdate'])->name('question.order.update');

    Route::post('option/{question}', [OptionController::class, 'store'])->name('option.store');
    Route::get('option/{option}/edit', [OptionController::class, 'edit'])->name('option.edit');
    Route::put('option/{option}', [OptionController::class, 'update'])->name('option.update');
    Route::delete('option/{option}', [OptionController::class, 'destroy'])->name('option.destroy');

    Route::get('my-material/list', [MyMaterialController::class, 'list'])->name('my-material.list');
    Route::get('my-material/{material}/detail', [MyMaterialController::class, 'detail'])->name('my-material.detail');

    Route::get('ranking', RankingController::class)->name('ranking');

    Route::prefix('my-account')->name('my-account.')->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/change-password', ChangePasswordController::class)->name('change-password');
        Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');
    });
});

Route::get('/download', DownloadController::class)->name('download');

Route::impersonate();
