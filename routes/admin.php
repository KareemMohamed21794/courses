<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\SubscriptionPlansController;
use App\Http\Controllers\Admin\CourseSubscriptionsController;

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
		Route::get('/courses/export', [CoursesController::class, 'export'])->name('admin.courses.export');
		Route::get('/courses/create', [CoursesController::class, 'create'])->name('admin.courses.create');
		Route::post('/courses', [CoursesController::class, 'store'])->name('admin.courses.store');
		Route::get('/courses/{course}/edit', [CoursesController::class, 'edit'])->name('admin.courses.edit');
		Route::put('/courses/{course}', [CoursesController::class, 'update'])->name('admin.courses.update');
		Route::delete('/courses/{course}', [CoursesController::class, 'destroy'])->name('admin.courses.destroy');

		Route::get('/payments', [PaymentsController::class, 'index'])->name('admin.payments.index');
		Route::get('/payments/get', [PaymentsController::class, 'get'])->name('admin.payments.get');
		Route::get('/payments/export', [PaymentsController::class, 'export'])->name('admin.payments.export');
		Route::post('/payments/{payment}/approve', [PaymentsController::class, 'approve'])->name('admin.payments.approve');
		Route::post('/payments/{payment}/reject', [PaymentsController::class, 'reject'])->name('admin.payments.reject');
		Route::delete('/payments/{payment}', [PaymentsController::class, 'destroy'])->name('admin.payments.destroy');

		Route::get('/subscription-plans', [SubscriptionPlansController::class, 'index'])->name('admin.subscription-plans.index');
		Route::get('/subscription-plans/get', [SubscriptionPlansController::class, 'get'])->name('admin.subscription-plans.get');
		Route::get('/subscription-plans/export', [SubscriptionPlansController::class, 'export'])->name('admin.subscription-plans.export');
		Route::get('/subscription-plans/create', [SubscriptionPlansController::class, 'create'])->name('admin.subscription-plans.create');
		Route::post('/subscription-plans', [SubscriptionPlansController::class, 'store'])->name('admin.subscription-plans.store');
		Route::get('/subscription-plans/{subscription_plan}/edit', [SubscriptionPlansController::class, 'edit'])->name('admin.subscription-plans.edit');
		Route::put('/subscription-plans/{subscription_plan}', [SubscriptionPlansController::class, 'update'])->name('admin.subscription-plans.update');
		Route::post('/subscription-plans/{subscription_plan}/toggle', [SubscriptionPlansController::class, 'toggle'])->name('admin.subscription-plans.toggle');
		Route::delete('/subscription-plans/{subscription_plan}', [SubscriptionPlansController::class, 'destroy'])->name('admin.subscription-plans.destroy');

		Route::get('/subscriptions', [CourseSubscriptionsController::class, 'index'])->name('admin.subscriptions.index');
		Route::get('/subscriptions/get', [CourseSubscriptionsController::class, 'get'])->name('admin.subscriptions.get');
		Route::get('/subscriptions/export', [CourseSubscriptionsController::class, 'export'])->name('admin.subscriptions.export');
		Route::post('/subscriptions/{subscription}/approve', [CourseSubscriptionsController::class, 'approve'])->name('admin.subscriptions.approve');
		Route::post('/subscriptions/{subscription}/reject', [CourseSubscriptionsController::class, 'reject'])->name('admin.subscriptions.reject');
		Route::delete('/subscriptions/{subscription}', [CourseSubscriptionsController::class, 'destroy'])->name('admin.subscriptions.destroy');

		Route::get('/admins/get', [AdminsController::class, 'get']);
		Route::get('/admins/export', [AdminsController::class, 'export'])->name('admin.admins.export');
		Route::get('/users/get', [AdminsController::class, 'get']);
		Route::get('/users/export', [AdminsController::class, 'export'])->name('admin.users.export');
		Route::resource('/admins', AdminsController::class);
		Route::DELETE('/delete_admins', [AdminsController::class, 'deleteAdmins']);
		Route::resource('/users', AdminsController::class);

	});
});
