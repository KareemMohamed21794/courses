<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Admin\QualificationleadersController;
use App\Http\Controllers\Admin\AdministrativeFinancialReportsController;
use App\Http\Controllers\Admin\BoardDirectorMeetingsController;
use App\Http\Controllers\Admin\SecondaryRegistrationsController;
use App\Http\Controllers\Admin\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/admin');
});

// Route::get('/admin', function () {
//     //return view('welcome');
//     return redirect('/admin/login');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('export_clients', [PDFController::class, 'ExportClients']);
Route::get('export_procedures', [PDFController::class, 'ExportProcedures']);
Route::get('export_cases', [PDFController::class, 'ExportCases']);
Route::get('send_email', [HomeController::class, 'send_email']);
Route::get('export_qualification_leaders', [QualificationleadersController::class, 'ExportQualificationLeaders']);






require __DIR__.'/auth.php';

require __DIR__.'/admin_auth.php';

require __DIR__.'/admin.php';

require __DIR__.'/client_auth.php';

require __DIR__.'/client.php';

require __DIR__.'/staff_auth.php';

require __DIR__.'/staff.php';
