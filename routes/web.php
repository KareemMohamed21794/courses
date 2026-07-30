<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{course}/verify', [CourseController::class, 'verifyPhone'])->name('courses.verify');
Route::get('/courses/{course}/purchase', [PurchaseController::class, 'create'])->name('courses.purchase');
Route::post('/courses/{course}/purchase', [PurchaseController::class, 'store'])->name('courses.purchase.store');
Route::get('/courses/{course}/download', [DownloadController::class, 'download'])->name('courses.download');

Route::get('/courses/{course}/subscribe', [SubscriptionController::class, 'create'])->name('courses.subscribe');
Route::post('/courses/{course}/subscribe', [SubscriptionController::class, 'store'])->name('courses.subscribe.store');
Route::get('/my-subscriptions', [SubscriptionController::class, 'dashboard'])->name('subscriptions.dashboard');

require __DIR__.'/admin_auth.php';
require __DIR__.'/admin.php';
