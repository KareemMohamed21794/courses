<?php
 
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\SecondaryRegistrationsController;
use App\Http\Controllers\Admin\AdministrativeFinancialReportsController;
use App\Http\Controllers\Admin\BoardDirectorMeetingsController;
use App\Http\Controllers\Admin\PermitsController;
use App\Http\Controllers\Admin\QualificationleadersController; 
use App\Http\Controllers\Admin\AdvertisementsController;
use App\Http\Controllers\Admin\InformationsController;


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
		Route::get('/leaders/get', [AdminsController::class, 'get']);
		Route::get('/secretariats/get', [AdminsController::class, 'get']);
		Route::resource('/admins', AdminsController::class);
		Route::DELETE('/delete_admins', [AdminsController::class,'deleteAdmins']);
		Route::resource('/leaders', AdminsController::class);
		Route::resource('/secretariats', AdminsController::class);
		Route::PATCH('/promotion/{id}', [AdminsController::class, 'Promotion']);

		Route::PATCH('/deletelawyer/{id}', [AdminsController::class, 'deletelawyer']);

		

		# End Admins


		# Start secondary_registration
		Route::get('/secondary_registrations/get', [SecondaryRegistrationsController::class, 'get']);
		Route::resource('/secondary_registrations', SecondaryRegistrationsController::class);
		Route::DELETE('/delete_secondary_registrations', [SecondaryRegistrationsController::class,'deleteSecondaryRegistrations']);

		Route::get('/report_secondary_registrations', [SecondaryRegistrationsController::class, 'ReportSecondaryRegistrations']);

		Route::get('/report_secondary_registrations_get', [SecondaryRegistrationsController::class, 'ReportSecondaryRegistrationsGet']);

		Route::get('/report_secondary_registrations_get_list', [SecondaryRegistrationsController::class, 'report_secondary_registrations_get_list']);

		Route::get('export_secondary_registrations', [SecondaryRegistrationsController::class, 'ExportSecondaryRegistrations']);



		Route::get('/accept_second_registration/{id}', [SecondaryRegistrationsController::class, 'accept_second_registration']);
		
		Route::get('/reject_second_registration/{id}', [SecondaryRegistrationsController::class, 'reject_second_registration']);

        Route::get('/download_secondary_registration/{id}', [SecondaryRegistrationsController::class, 'download_secondary_registration']);
       ///// archive


		Route::get('/report_archive_secondary_registrations', [SecondaryRegistrationsController::class, 'ReportArchiveSecondaryRegistrations']);

		Route::get('/report_archive_secondary_registrations_get', [SecondaryRegistrationsController::class, 'ReportArchiveSecondaryRegistrationsGet']);

		Route::get('/report_archive_secondary_registrations_get_list', [SecondaryRegistrationsController::class, 'report_archive_secondary_registrations_get_list']);

		Route::get('export_archive_secondary_registrations', [SecondaryRegistrationsController::class, 'ExportArchiveSecondaryRegistrations']);
		# End secondary_registration


		# Start administrative_financial_report
		Route::get('/administrative_financial_reports/get', [AdministrativeFinancialReportsController::class, 'get']);
		Route::resource('/administrative_financial_reports', AdministrativeFinancialReportsController::class);


		Route::resource('/administrative', AdministrativeFinancialReportsController::class);

		Route::resource('/financial', AdministrativeFinancialReportsController::class);

		

		Route::DELETE('/delete_administrative_financial_reports', [AdministrativeFinancialReportsController::class,'deleteAdministrativeFinancialReport']);


		Route::get('/report_administrative', [AdministrativeFinancialReportsController::class, 'ReportAdministrative']);


		Route::get('/report_financial', [AdministrativeFinancialReportsController::class, 'ReportFinancial']);

        //archive
		Route::get('/report_archive_administrative', [AdministrativeFinancialReportsController::class, 'ReportArchiveAdministrative']);
		Route::get('/report_archive_financial', [AdministrativeFinancialReportsController::class, 'ReportArchiveFinancial']);
		///


		Route::get('export_administrative_financial', [AdministrativeFinancialReportsController::class, 'ExportAdministrativeFinancial']);

		
		# End administrative_financial_report


		# Start board_director_meetings
		Route::get('/board_director_meetings/get', [BoardDirectorMeetingsController::class, 'get']);
		Route::resource('/board_director_meetings', BoardDirectorMeetingsController::class);
		Route::DELETE('/delete_board_director_meetings', [BoardDirectorMeetingsController::class,'deleteBoardDirectorMeetings']);


		Route::get('/report_board_director_meetings', [BoardDirectorMeetingsController::class, 'ReportBoardDirectorMeetings']);


       //archive
		Route::get('/report_archive_board_director_meetings', [BoardDirectorMeetingsController::class, 'ReportArchiveBoardDirectorMeetings']);
		///

		Route::get('export_board_director_meetings', [BoardDirectorMeetingsController::class, 'ExportBoardDirectorMeetings']);

	
		# End board_director_meetings

	
       # Start permits
		Route::get('/permits/get', [PermitsController::class, 'get']);
		Route::resource('/permits', PermitsController::class);
		Route::DELETE('/delete_permits', [PermitsController::class,'deletepermits']);

		Route::get('/accept_permit/{id}', [PermitsController::class, 'accept_permit']);
		
		Route::get('/reject_permit/{id}', [PermitsController::class, 'reject_permit']);
		
		Route::get('/download_approve_form', [PermitsController::class, 'DownloadApproveForm']);
		# End permits



		 # Start qualification_leaders
		Route::get('/qualification_leaders/get', [QualificationleadersController::class, 'get']);
		Route::resource('/qualification_leaders', QualificationleadersController::class);
		Route::DELETE('/delete_qualification_leaders', [QualificationleadersController::class,'deletequalification_leaders']);


		Route::get('/report_qualification_leaders', [QualificationleadersController::class, 'ReportQualificationLeaders']);

		Route::get('/report_qualification_leaders_get', [QualificationleadersController::class, 'ReportQualificationLeadersGet']);

		Route::get('/report_qualification_leaders_get_list', [QualificationleadersController::class, 'ReportQualificationLeadersGetlist']);


	
		# End qualification_leaders



		# Start advertisements
		Route::get('/advertisements/get', [AdvertisementsController::class, 'get']);
		Route::resource('/advertisements', AdvertisementsController::class);
		Route::DELETE('/delete_advertisements', [AdvertisementsController::class,'deleteadvertisements']);
		Route::get('export_advertisements', [AdvertisementsController::class, 'ExportAdvertisements']);
        

		# End advertisements



		# Start requests
		Route::get('/requests/get', [InformationsController::class, 'get']);
		Route::resource('/requests', InformationsController::class);
		Route::DELETE('/delete_requests', [InformationsController::class,'deleterequests']);
		Route::get('export_requests', [InformationsController::class, 'ExportRequests']);
		# End requests



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

	    Route::get('/download_approvement/{id}', [PermitsController::class, 'download_approvement']);
	    
	   

	});

});


