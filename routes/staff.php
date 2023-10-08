<?php
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffProfileController;
use App\Http\Controllers\Admin\MyRequestsController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\TeamRequestsController;



// Route::get('/{url}', HomeController::class)->where(['url' => 'staff|staff/dashboard'])->middleware(['auth:staff'])->name('staff_dashboard');


Route::middleware('auth:staff')->group(function () {
	Route::prefix('/staff')->group(function () {

		Route::get('/language/{locale}', function ($locale) {
    		Session()->put('staff_locale', $locale);
    		return redirect()->back();
		})->name('staff_language');

		Route::get('/darkmode/{type?}', function ($type) {
    		Session()->put('darkmode', $type);
    		return redirect()->back();
		})->name('darkmode');

		# Start staff
		Route::get('/staff/get', [StaffController::class, 'get']);
		Route::resource('/staff', StaffController::class);
		Route::DELETE('/delete_staff', [StaffController::class,'deletestaffs']);
		# End Admins

# Start staff Profile
		Route::get('/staff_profile/getactivites/{id}', [StaffProfileController::class, 'getactivites']);
		Route::get('/staff_profile/getpaysalaries/{id}', [StaffProfileController::class, 'getpaysalaries']);
		Route::get('/staff_profile/getpunishments/{id}', [StaffProfileController::class, 'getpunishments']);

		Route::get('/staff_profile/getrewards/{id}', [StaffProfileController::class, 'getrewards']);
		Route::get('/staff_profile/getdebts/{id}', [StaffProfileController::class, 'getdebts']);
		Route::get('/staff_profile/getloans/{id}', [StaffProfileController::class, 'getloans']);
		Route::get('/staff_profile/getshifts/{id}', [StaffProfileController::class, 'getshifts']);
		Route::get('/staff_profile/getallowances/{id}', [StaffProfileController::class, 'getallowances']);
		Route::get('/staff_profile/getvacations/{id}', [StaffProfileController::class, 'getvacations']);



		# End staff Profile
      # Start my_requests
//		Route::get('/my_requests/get', [MyRequestsController::class, 'get']);
//		Route::resource('/my_requests', MyRequestsController::class);
//		Route::DELETE('/delete_my_requests', [MyRequestsController::class,'deleteStaffRequests']);
		# End my_requests

		  # Start team_requests
//		Route::get('/team_requests/get', [TeamRequestsController::class, 'get']);
//		Route::resource('/team_requests', TeamRequestsController::class);
//		Route::DELETE('/delete_my_requests', [TeamRequestsController::class,'deleteStaffRequests']);
		# End my_requests
 		Route::get('departments/get_positions/{id}', [DepartmentsController::class, 'getPositions']);

	});



});


