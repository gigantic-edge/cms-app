<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/',[FrontendController::class,'blogs']);
Route::match(['get','post'],'/blog-details/{slug}',[FrontendController::class,'blogDetails']);


Route::prefix('Administrator/')->group(function () {
    Route::match(['get', 'post'], '/', [UserController::class, 'index']);
    Route::match(['get', 'post'], '/forgot-password', [UserController::class, 'forgotPassword']);
    Route::match(['get','post'],'/sign-up',[UserController::class,'signUp']);
    Route::get('/verify-email', [EmailVerificationController::class, 'showForm'])->name('verify.email.form');
    Route::post('/verify-email', [EmailVerificationController::class, 'verifyOtp'])->name('verify.email');
    Route::get('reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');
    Route::middleware('admin')->group(function () {
        Route::match(['get', 'post'], '/dashboard', [UserController::class, 'dashboard']);
        Route::match(['get', 'post'], '/profile', [UserController::class, 'profile']);
        Route::get('/logout', [UserController::class, 'logout']);

        /**blog */
        Route::match(['get', 'post'], '/blogs', [BlogController::class, 'blogs']);
        Route::match(['get', 'post'], '/add-blog', [BlogController::class, 'addBlog']);
        Route::match(['get', 'post'], '/edit-blog/{id}', [BlogController::class, 'editBlog']);
        Route::match(['get', 'post'], '/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
        /**blog */
        
    });
});
