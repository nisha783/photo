<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DpController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileManageController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfilController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->name('guest');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/guest', function () {
        return view('guest');
    })->middleware(['auth', 'verified'])->name('guest');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [PasswordController::class, 'update'])->name('password.update');
    //Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::resource('/guest', WelcomeController::class);
Route::resource('/photo', PhotoController::class)->middleware(['auth', 'verified']);
Route::resource('/pf', ProfileManageController::class)->middleware(['auth', 'verified']);
Route::resource('/dp', DpController::class)->middleware(['auth', 'verified']);
Route::post('/photo/{photoId}/comments', [PhotoController::class, 'addComment'])->name('comments.add');
Route::post('/photos/{photoId}/like', [PhotoController::class, 'toggleLike'])->middleware('auth');

require __DIR__ . '/auth.php';
