<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AdminPasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AdminRegisteredUserController;

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/register', [AdminRegisteredUserController::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin/register');

Route::post('admin/register', [AdminRegisteredUserController::class, 'store'])
                ->middleware('guest:admin');                

Route::get('/admin/login', [AdminAuthenticatedSessionController::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin_login');

Route::post('admin/login', [AdminAuthenticatedSessionController::class, 'store'])
                ->middleware('guest:admin');

Route::get('/forgot-password', [AdminPasswordResetLinkController::class, 'create'])
                ->middleware('guest:admin')
                ->name('admin_password.request');

Route::post('/forgot-password', [AdminPasswordResetLinkController::class, 'store'])
                ->middleware('guest:admin')
                ->name('admin_password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:admin')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:admin')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:admin')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:admin', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:admin')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:admin');

Route::post('admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:admin')
                ->name('admin_logout');
