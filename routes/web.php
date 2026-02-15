<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;

// ------------------------------
// Public Pages
// ------------------------------
Route::get('/', fn() => view('welcome'));
Route::get('index/', fn() => view('index'));
Route::get('portfolio/', fn() => view('portfolio-details'));
Route::get('service/', fn() => view('service-details'));
Route::get('starter/', fn() => view('starter-page'));

// Auth Views
Route::get('login', fn() => view('auth.sign-in'))->name('login');
Route::get('register', fn() => view('auth.sign-up'))->name('register');

// ------------------------------
// Email Verification (Web)
// ------------------------------
// مجرد تحقق بالـ signed hash بدون auth
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');

// إعادة إرسال الإيميل
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware('throttle:6,1');
