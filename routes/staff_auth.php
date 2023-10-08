<?php

use App\Http\Controllers\Auth\StaffAuthenticatedSessionController;
//use App\Http\Controllers\Auth\StaffRegisteredUserController;
use Illuminate\Support\Facades\Route;


//Route::get('/staff/register', [StaffRegisteredUserController::class, 'create'])
//                ->middleware('guest:staff')
//                ->name('staff/register');
//
//Route::post('staff/register', [StaffRegisteredUserController::class, 'store'])
//                ->middleware('guest:staff');

Route::get('/staff/login', [StaffAuthenticatedSessionController::class, 'create'])
                ->middleware('guest:staff')
                ->name('staff_login');

Route::post('staff/login', [StaffAuthenticatedSessionController::class, 'store'])
                ->middleware('guest:staff');

Route::post('staff/logout', [StaffAuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:staff')
                ->name('staff_logout');
