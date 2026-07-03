<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\PaymentsController;

Route::get('/{url}', HomeController::class)->where(['url' => 'admin|admin/dashboard'])->middleware(['auth:admin'])->name('admin_dashboard');

Route::middleware('auth:admin')->group(function () {
	Route::prefix('/admin')->group(function () {

		Route::get('/language/{locale}', function ($locale) {
    		Session()->put('admin_locale', $locale);
    		return redirect()->back();
		})->name('admin_language');

		Route::get('/darkmode/{type?}', function ($type) {
    		Session()->put('darkmode', $type);
    		return redirect()->back();
		})->name('admin_darkmode');

		Route::get('/courses', [CoursesController::class, 'index'])->name('admin.courses.index');
		Route::get('/courses/get', [CoursesController::class, 'get'])->name('admin.courses.get');
		Route::get('/courses/export/pdf', [CoursesController::class, 'exportPdf'])->name('admin.courses.export.pdf');
		Route::get('/courses/create', [CoursesController::class, 'create'])->name('admin.courses.create');
		Route::post('/courses', [CoursesController::class, 'store'])->name('admin.courses.store');
		Route::get('/courses/{course}/edit', [CoursesController::class, 'edit'])->name('admin.courses.edit');
		Route::put('/courses/{course}', [CoursesController::class, 'update'])->name('admin.courses.update');
		Route::delete('/courses/{course}', [CoursesController::class, 'destroy'])->name('admin.courses.destroy');

		Route::get('/payments', [PaymentsController::class, 'index'])->name('admin.payments.index');
		Route::get('/payments/get', [PaymentsController::class, 'get'])->name('admin.payments.get');
		Route::get('/payments/export/pdf', [PaymentsController::class, 'exportPdf'])->name('admin.payments.export.pdf');
		Route::post('/payments/{payment}/approve', [PaymentsController::class, 'approve'])->name('admin.payments.approve');
		Route::post('/payments/{payment}/reject', [PaymentsController::class, 'reject'])->name('admin.payments.reject');
		Route::delete('/payments/{payment}', [PaymentsController::class, 'destroy'])->name('admin.payments.destroy');

		Route::get('/admins/get', [AdminsController::class, 'get']);
		Route::get('/admins/export/pdf', [AdminsController::class, 'exportPdf'])->name('admin.admins.export.pdf');
		Route::get('/users/get', [AdminsController::class, 'get']);
		Route::get('/users/export/pdf', [AdminsController::class, 'exportPdf'])->name('admin.users.export.pdf');
		Route::resource('/admins', AdminsController::class);
		Route::DELETE('/delete_admins', [AdminsController::class, 'deleteAdmins']);
		Route::resource('/users', AdminsController::class);

	});
});
