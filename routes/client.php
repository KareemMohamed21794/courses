<?php 
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ReportsController;
Route::get('/client', HomeController::class)->middleware(['auth:client'])->name('client_dashboard');


Route::middleware('auth:client')->group(function () {
	Route::prefix('/client')->group(function () {


		Route::get('/language/{locale}', function ($locale) {
    		Session()->put('admin_locale', $locale);
    		return redirect()->back();
		})->name('client_language');

		Route::get('/darkmode/{type?}', function ($type) {
    		Session()->put('darkmode', $type);
    		return redirect()->back();
		})->name('client_darkmode');


		# Start customers
		Route::get('/customers/get', [CustomersController::class, 'get']);
		Route::resource('/customers', CustomersController::class);
		Route::DELETE('/delete_customers', [CustomersController::class,'deleteCustomers']);
		# End customers

		# Start suppliers
		Route::get('/suppliers/get', [SuppliersController::class, 'get']);
		Route::resource('/suppliers', SuppliersController::class);
		Route::DELETE('/delete_suppliers', [SuppliersController::class,'deleteSuppliers']);
		# End suppliers

		# Start products
		
		Route::get('/load_product_by_code/{id}', [ProductsController::class, 'loadProductByCode']);
		Route::get('/products/get', [ProductsController::class, 'get']);
		Route::resource('/products', ProductsController::class);
		Route::DELETE('/delete_products', [ProductsController::class,'deleteProducts']);
		# End products

		# Start invoices
		Route::get('/create_invoice', [InvoicesController::class, 'index']);
		Route::post('/add_temp_item', [InvoicesController::class, 'addTempItem']);
		Route::get('/delete_invoice', [InvoicesController::class, 'deleteInvoice']);
		Route::post('/delete_temp_item/{id}', [InvoicesController::class, 'deleteTempItem']);
		Route::post('/save_invoice/{type}', [InvoicesController::class, 'SaveInvoice']);
		Route::get('/invoices/show', [InvoicesController::class, 'show']);
		Route::get('/invoices/get', [InvoicesController::class, 'get']);
		Route::get('/get_tax_category/{id}', [InvoicesController::class, 'getTaxCategory']);
		Route::get('/get_tax/{id}', [InvoicesController::class, 'getTax']);
		Route::get('/profile', [ClientsController::class, 'profile']);
		Route::post('/profile/{id}', [ClientsController::class, 'updateProfile']);
		Route::post('/update_client_tax/{id}', [ClientsController::class, 'updateClientTax']);
		// reports
		Route::get('/reports/client_case', [ReportsController::class, 'client_case']);
		Route::get('/reports/client_case_private', [ReportsController::class, 'client_case']);
		Route::get('/reports/client_case_get', [ReportsController::class, 'client_case_get']);
		Route::get('/reports/client_case_get/{client}', [ReportsController::class, 'client_case_get_data']);

		Route::get('/reports/client_case_get_list', [ReportsController::class, 'client_case_get_list']);

		Route::get('/reports/client_procedure', [ReportsController::class, 'client_procedure']);
		Route::get('/reports/client_procedure_private', [ReportsController::class, 'client_procedure']);

		Route::get('/reports/client_procedure_get', [ReportsController::class, 'client_procedure_get']);
		Route::get('/reports/client_procedure_get/{client}', [ReportsController::class, 'client_procedure_get_data']);

		Route::get('/reports/client_procedure_get_list', [ReportsController::class, 'client_procedure_get_list']);
		
		

 
	});

	

});


