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
use App\Http\Controllers\Admin\OrganizingStudiesController;
use App\Http\Controllers\Admin\StudentRegistrationsController;
use App\Http\Controllers\Admin\AchievementsStudyRequirementsController;
use App\Http\Controllers\Admin\StudyReportsController;
use App\Http\Controllers\Admin\TypeActivitiesController;
use App\Http\Controllers\Admin\PaymentMethodsController;
use App\Http\Controllers\Admin\FinancalMovementsController;
use App\Http\Controllers\Admin\CommanderMedalsController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\BoardDirectorsController;
use App\Http\Controllers\Admin\GroupLeadersController;
Route::get('/{url}', HomeController::class)->where(['url' => 'admin|admin/dashboard'])->middleware(['auth:admin'])->name('admin_dashboard');

Route::get('/client', HomeController::class)->middleware(['auth:client'])->name('admin_dashboard');

Route::get('/student_registration/{id}', [StudentRegistrationsController::class, 'create']);
Route::post('/student_registration', [StudentRegistrationsController::class, 'store']);
Route::get('/show_student_registration/{id}', [StudentRegistrationsController::class, 'show']);
Route::get('/edit_student_registration/{id}', [StudentRegistrationsController::class, 'edit']);
Route::put('/update_student_registration/{id}', [StudentRegistrationsController::class, 'update']);

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

		# Start Student registration
        Route::get('show_students/student_registration/get/{id}', [StudentRegistrationsController::class, 'get']);

        
        Route::post('student_registration', [StudentRegistrationsController::class, 'store']);


		Route::get('show_students/{id}', [StudentRegistrationsController::class, 'index']);

		Route::get('show_all_students/{id}', [StudentRegistrationsController::class, 'ShowStudents']);

		Route::get('show_all_students/student_registration/get/{id}', [StudentRegistrationsController::class, 'get']);

		Route::get('/accept_student_registration/{id}', [StudentRegistrationsController::class, 'accept_student_registration']);

		Route::DELETE('show_students/delete_student_registration', [StudentRegistrationsController::class,'deleteStudentRegistrations']);

		Route::DELETE('show_students/student_registration/{id}', [StudentRegistrationsController::class,'destroy']);

        Route::get('annual_registration_archive', [StudentRegistrationsController::class, 'AnuulRegistrationArchive']);
		Route::post('annual_registration_archive', [StudentRegistrationsController::class, 'AddAnuulRegistrationArchive']);



		Route::get('/report_student_registration', [StudentRegistrationsController::class, 'ReportStudentRegistration']);

		Route::get('/report_student_registration_get', [StudentRegistrationsController::class, 'ReportStudentRegistrationGet']);

		Route::get('/report_student_registration_get_list', [StudentRegistrationsController::class, 'ReportQualificationLeadersGetlist']);




        # End Student registration

		

		# Start Admins
		Route::get('/admins/get', [AdminsController::class, 'get']);
		Route::get('/leaders/get', [AdminsController::class, 'get']);
		Route::get('/secretariats/get', [AdminsController::class, 'get']);
		Route::get('/monitors/get', [AdminsController::class, 'get']);
		Route::get('/training_commissioners/get', [AdminsController::class, 'get']);
		Route::get('/treasurers/get', [AdminsController::class, 'get']);
		Route::resource('/admins', AdminsController::class);
		Route::DELETE('/delete_admins', [AdminsController::class,'deleteAdmins']);
		Route::resource('/leaders', AdminsController::class);
		Route::resource('/secretariats', AdminsController::class);
		Route::resource('/monitors', AdminsController::class);
		Route::resource('/training_commissioners', AdminsController::class);
		Route::resource('/treasurers', AdminsController::class);
		Route::PATCH('/promotion/{id}', [AdminsController::class, 'Promotion']);

		Route::PATCH('/deletelawyer/{id}', [AdminsController::class, 'deletelawyer']);


       Route::get('/scouting_statistics', [HomeController::class, 'ScoutingStatistics']);
		
       Route::get('/indicative_statistics', [HomeController::class, 'IndicativeStatistics']);
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



        Route::get('/total_secondary_registration', [SecondaryRegistrationsController::class, 'total_secondary_registration']);

		Route::get('/total_secondary_registration/get', [SecondaryRegistrationsController::class, 'get_totall_secondary_registration']);
       ///// archive


		Route::get('/report_archive_secondary_registrations', [SecondaryRegistrationsController::class, 'ReportArchiveSecondaryRegistrations']);

		Route::get('/report_archive_secondary_registrations_get', [SecondaryRegistrationsController::class, 'ReportArchiveSecondaryRegistrationsGet']);

		Route::get('/report_archive_secondary_registrations_get_list', [SecondaryRegistrationsController::class, 'report_archive_secondary_registrations_get_list']);

		Route::get('export_archive_secondary_registrations', [SecondaryRegistrationsController::class, 'ExportArchiveSecondaryRegistrations']);
		# End secondary_registration


		# Start administrative_financial_report
		Route::get('/administrative_financial_reports/get', [AdministrativeFinancialReportsController::class, 'get']);
		Route::resource('/administrative_financial_reports', AdministrativeFinancialReportsController::class);


		Route::get('/administrative_financial/{status}/{id}/reject_accept', [AdministrativeFinancialReportsController::class, 'reject_accept']);


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

		Route::post('/rejected/', [AdministrativeFinancialReportsController::class, 'Rejected']);

		
		# End administrative_financial_report


		# Start board_director_meetings
		Route::get('/board_director_meetings/get', [BoardDirectorMeetingsController::class, 'get']);
		Route::resource('/board_director_meetings', BoardDirectorMeetingsController::class);
		Route::DELETE('/delete_board_director_meetings', [BoardDirectorMeetingsController::class,'deleteBoardDirectorMeetings']);


		Route::get('/report_board_director_meetings', [BoardDirectorMeetingsController::class, 'ReportBoardDirectorMeetings']);


		Route::get('/board_director_meetings/{status}/{id}/reject_accept', [BoardDirectorMeetingsController::class, 'reject_accept']);


		Route::post('/rejected_meetings/', [BoardDirectorMeetingsController::class, 'RejectedMeetings']);


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

		Route::post('/reject_permit/', [PermitsController::class, 'reject_permit']);
		
		Route::get('/download_approve_form', [PermitsController::class, 'DownloadApproveForm']);

		Route::get('/total_permits', [PermitsController::class, 'total_permits']);

		Route::get('/total_permits/get', [PermitsController::class, 'get_totall_permits']);

		Route::get('/report_archive_permits', [PermitsController::class, 'ReportArchivepermits']);

		Route::get('/report_archive_permits_get', [PermitsController::class, 'ReportArchivepermitsGet']);

		Route::get('/report_archive_permits_get_list', [PermitsController::class, 'report_archive_permits_get_list']);


		Route::get('/report_permits', [PermitsController::class, 'ReportPermits']);

		Route::get('/report_permits_get', [PermitsController::class, 'ReportPermitsGet']);

		Route::get('/report_permits_get_list', [PermitsController::class, 'ReportPermitsGetlist']);
		# End permits


		# Start board_directors
		// Route::get('/board_directors/get', [BoardDirectorsController::class, 'get']);
		// Route::resource('/board_directors', BoardDirectorsController::class);
		// Route::get('/add_board_directors/{id}', [BoardDirectorsController::class, 'AllData']);
	
		Route::get('/board_directors/{id}', [BoardDirectorsController::class, 'index']);
		Route::POST('/board_directors/{id}', [BoardDirectorsController::class, 'store']);
		Route::put('/board_directors/{id}', [BoardDirectorsController::class, 'update']);
		Route::get('/get_board_directors/{id}', [BoardDirectorsController::class, 'get']);
		Route::get('/get_board_director/{id}', [BoardDirectorsController::class, 'edit']);
		Route::DELETE('/delete_board_directors/{id}', [BoardDirectorsController::class, 'destroy']);
		Route::DELETE('/delete_board_directors', [BoardDirectorsController::class, 'deleteBoardDirectors']);
		# End board_directors


		# Start group_leaders
		
		Route::get('/group_leaders/{id}', [GroupLeadersController::class, 'index']);
		Route::POST('/group_leaders/{id}', [GroupLeadersController::class, 'store']);
		Route::put('/group_leaders/{id}', [GroupLeadersController::class, 'update']);
		Route::get('/get_group_leaders/{id}', [GroupLeadersController::class, 'get']);
		Route::get('/get_group_leader/{id}', [GroupLeadersController::class, 'edit']);
		Route::DELETE('/delete_group_leaders/{id}', [GroupLeadersController::class, 'destroy']);
		Route::DELETE('/delete_group_leaders', [GroupLeadersController::class, 'deleteGroupLeaders']);
		# End group_leaders



		 # Start qualification_leaders
		Route::get('/qualification_leaders/get', [QualificationleadersController::class, 'get']);
		Route::resource('/qualification_leaders', QualificationleadersController::class);
		Route::DELETE('/delete_qualification_leaders', [QualificationleadersController::class,'deletequalification_leaders']);


		Route::get('/report_qualification_leaders', [QualificationleadersController::class, 'ReportQualificationLeaders']);

		Route::get('/report_qualification_leaders_get', [QualificationleadersController::class, 'ReportQualificationLeadersGet']);

		Route::get('/report_qualification_leaders_get_list', [QualificationleadersController::class, 'ReportQualificationLeadersGetlist']);


	
		# End qualification_leaders


		# Start organizing_study
		Route::get('/organizing_study/get', [OrganizingStudiesController::class, 'get']);
		Route::resource('/organizing_study', OrganizingStudiesController::class);
		Route::DELETE('/delete_organizing_study', [OrganizingStudiesController::class,'deleteorganizing_study']);
		
        Route::get('export_organizing_study', [OrganizingStudiesController::class, 'ExportOrganizingStudy']);



        Route::get('/organizing_study/{status}/{id}/reject_accept', [OrganizingStudiesController::class, 'reject_accept_organizing']);

        Route::post('/organizing_study_rejected/', [OrganizingStudiesController::class, 'organizing_study_rejected']);


        Route::get('/organizing_study_files/{id}', [OrganizingStudiesController::class, 'OrganizingStudyFiles']);
		Route::get('/organizing_study_files/get/{id}', [OrganizingStudiesController::class, 'getOrganizingStudyFiles']);
		Route::POST('/organizing_study_files/{id}', [OrganizingStudiesController::class, 'SaveOrganizingStudyFiles']);


		Route::DELETE('/organizing_study_files/{id}', [OrganizingStudiesController::class, 'deleteOrganizingStudyFiles']);
		Route::DELETE('/organizing_study_files', [OrganizingStudiesController::class, 'deleteSelectedOrganizingStudyFiles']);

		# End organizing_study




		# Start study_report
		Route::get('/study_report/get', [StudyReportsController::class, 'get']);
		Route::resource('/study_report', StudyReportsController::class);
		Route::DELETE('/delete_study_report', [StudyReportsController::class,'deletestudy_report']);
		
        Route::get('export_study_report', [StudyReportsController::class, 'ExportOrganizingStudy']);

		# End study_report



		# Start achievements_study_requirements
		Route::get('/achievements_study_requirements/get', [AchievementsStudyRequirementsController::class, 'get']);
		Route::resource('/achievements_study_requirements', AchievementsStudyRequirementsController::class);
		Route::DELETE('/delete_achievements_study_requirements', [AchievementsStudyRequirementsController::class,'deleteAchievementStudyRequirement']);


		Route::get('/achievements_study_requirements/{status}/{id}/reject_accept', [AchievementsStudyRequirementsController::class, 'reject_accept']);


		Route::post('/rejected_achievements_study/', [AchievementsStudyRequirementsController::class, 'RejectedAchievementStudy']);


		Route::get('export_achievements_study_requirements', [AchievementsStudyRequirementsController::class, 'ExportAchievementStudyRequirement']);

	
		# End achievements_study_requirements



		# Start commander_medals
		Route::get('/commander_medals/get', [CommanderMedalsController::class, 'get']);
		Route::resource('/commander_medals', CommanderMedalsController::class);
		Route::DELETE('/delete_commander_medals', [CommanderMedalsController::class,'deleteCommanderMedals']);


		Route::get('/commander_medals/{status}/{id}/reject_accept', [CommanderMedalsController::class, 'reject_accept']);


		Route::post('/rejected_commander_medals/', [CommanderMedalsController::class, 'RejectedCommanderMedal']);


		Route::get('export_commander_medals', [CommanderMedalsController::class, 'ExportCommanderMedal']);

		Route::get('/report_commander_medals', [CommanderMedalsController::class, 'ReportCommanderMedals']);

		Route::get('/report_commander_medals_get', [CommanderMedalsController::class, 'ReportCommanderMedalsGet']);

		Route::get('/report_commander_medals_get_list', [CommanderMedalsController::class, 'report_commander_medals_get_list']);


		Route::get('/report_archive_commander_medals', [CommanderMedalsController::class, 'ReportArchiveCommanderMedals']);

		Route::get('/report_archive_commander_medals_get', [CommanderMedalsController::class, 'ReportArchiveCommanderMedalsGet']);

		Route::get('/report_archive_commander_medals_get_list', [CommanderMedalsController::class, 'report_archive_commander_medals_get_list']);

	
		# End commander_medals



		# Start setup
		Route::get('/setup/get', [SetupController::class, 'get']);
		Route::resource('/setup', SetupController::class);
		Route::DELETE('/delete_setup', [SetupController::class,'deleteSetup']);

        // history_movements
		Route::get('/history_movements', [SetupController::class, 'history_movements']);
		Route::get('/history_movements/get', [SetupController::class, 'get_history_movements']);
		# End setup



		# Start type_activities
		Route::get('/type_activities/get', [TypeActivitiesController::class, 'get']);
		Route::resource('/type_activities', TypeActivitiesController::class);
		Route::DELETE('/delete_type_activities', [TypeActivitiesController::class,'deleteTypeActivity']);

		# End type_activities


		# Start payment_methods
		Route::get('/payment_methods/get', [PaymentMethodsController::class, 'get']);
		Route::resource('/payment_methods', PaymentMethodsController::class);
		Route::DELETE('/delete_payment_methods', [PaymentMethodsController::class,'deletePaymentMethods']);

		# End payment_methods
		


		# Start payments_received
		Route::get('/payments_received/get', [FinancalMovementsController::class, 'get']);
		Route::resource('/payments_received', FinancalMovementsController::class);
		Route::DELETE('/delete_payments_received', [FinancalMovementsController::class,'deletePaymentsReceived']);



		Route::get('/financial_movements', [FinancalMovementsController::class, 'financial_movements']);

		Route::get('/report_financial_movements', [FinancalMovementsController::class, 'ReportFinancialMovements']);

		Route::get('/report_financial_movements_get', [FinancalMovementsController::class, 'ReportFinancialMovementsGet']);

		Route::get('/report_financial_movements_get_list', [FinancalMovementsController::class, 'ReportFinancialMovementsGetlist']);

		Route::get('/financial_claims', [FinancalMovementsController::class, 'financial_claims']);

		# End payments_received


		



		# Start advertisements
		Route::get('/advertisements/get', [AdvertisementsController::class, 'get']);
		Route::resource('/advertisements', AdvertisementsController::class);
		Route::DELETE('/delete_advertisements', [AdvertisementsController::class,'deleteadvertisements']);
		Route::get('export_advertisements', [AdvertisementsController::class, 'ExportAdvertisements']);
        
        Route::get('/report_archive_advertisements', [AdvertisementsController::class, 'ReportArchiveAdvertisements']);

		Route::get('/report_archive_advertisements_get', [AdvertisementsController::class, 'ReportArchiveAdvertisementsGet']);

		Route::get('/report_archive_advertisements_get_list', [AdvertisementsController::class, 'report_archive_advertisements_get_list']);

		Route::get('export_archive_advertisements', [AdvertisementsController::class, 'ExportArchiveAdvertisements']);
		# End advertisements



		# Start requests
		Route::get('/requests/get', [InformationsController::class, 'get']);
		Route::resource('/requests', InformationsController::class);
		Route::DELETE('/delete_requests', [InformationsController::class,'deleterequests']);
		Route::get('export_requests', [InformationsController::class, 'ExportRequests']);
		Route::get('/requests/{status}/{id}/reject_accept', [InformationsController::class, 'reject_accept']);

		Route::post('/rejected_request/', [InformationsController::class, 'RejectedRequest']);

		Route::get('/report_archive_requests', [InformationsController::class, 'ReportArchiveRequests']);

		Route::get('/report_archive_requests_get', [InformationsController::class, 'ReportArchiveRequestsGet']);

		Route::get('/report_archive_requests_get_list', [InformationsController::class, 'report_archive_Requests_get_list']);
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


