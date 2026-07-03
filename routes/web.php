<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DownloadController;

Route::get('/', [CourseController::class, 'index'])->name('courses.index');
Route::post('/courses/{course}/verify', [CourseController::class, 'verifyPhone'])->name('courses.verify');
Route::get('/courses/{course}/purchase', [PurchaseController::class, 'create'])->name('courses.purchase');
Route::post('/courses/{course}/purchase', [PurchaseController::class, 'store'])->name('courses.purchase.store');
Route::get('/courses/{course}/download', [DownloadController::class, 'download'])->name('courses.download');

require __DIR__.'/admin_auth.php';
require __DIR__.'/admin.php';
