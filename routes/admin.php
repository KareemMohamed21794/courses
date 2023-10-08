<?php
 
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\PermissionsController;




 


Route::get('/{url}', HomeController::class)->where(['url' => 'admin|admin/dashboard'])->middleware(['auth:admin'])->name('admin_dashboard');

Route::get('/client', HomeController::class)->middleware(['auth:client'])->name('admin_dashboard');


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

		# Start Admins
		Route::get('/admins/get', [AdminsController::class, 'get']);
		Route::get('/lawyers/get', [AdminsController::class, 'get']);
		Route::get('/secretariats/get', [AdminsController::class, 'get']);
		Route::resource('/admins', AdminsController::class);
		Route::DELETE('/delete_admins', [AdminsController::class,'deleteAdmins']);
		Route::resource('/lawyers', AdminsController::class);
		Route::resource('/secretariats', AdminsController::class);
		Route::PATCH('/promotion/{id}', [AdminsController::class, 'Promotion']);

		Route::PATCH('/deletelawyer/{id}', [AdminsController::class, 'deletelawyer']);

		

		# End Admins

	
         



	    # Start Permissions
	    //        Route::get('/load_product_by_code/{id}', [WarehouseLocationsController::class, 'loadProductByCode']);
	    Route::get('/permissions/get', [PermissionsController::class, 'get']);
	    Route::resource('/permissions', PermissionsController::class);
	    //        Route::DELETE('/warehouses-locations', [WarehouseLocationsController::class,'deleteProducts']);
	    # End Roles/permissions

	    # Start Roles
	    //        Route::get('/load_product_by_code/{id}', [WarehouseLocationsController::class, 'loadProductByCode']);
	    Route::get('/roles/get', [RolesController::class, 'get']);
	    Route::resource('/roles', RolesController::class);

	    Route::get('upload_csv', [HomeController::class, 'upload_csv']);
	    Route::post('upload_csv_save', [HomeController::class, 'upload_csv_save']);
	    Route::get('/update_warehouses', [HomeController::class, 'update_warehouses']);

	   

	});

});


