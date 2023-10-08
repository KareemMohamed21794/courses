<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Warehouse;
use App\Models\InvoiceHeader;
use App\Models\InvoiceFooter;
use App\Models\PurchaseFooter;
use App\Models\PurchaseHeader;
use App\Models\ManufactureHeader;
use App\Models\Problem;
use App\Models\ProblemProcedure;
use App\Models\Client;
use App\Models\Admin;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        # check for email
        $notifications = [];

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $problemNotifications = array();

        
        $userId = \Auth::id();
        if(request()->segment(1)=='admin'){
            $title = "الاداره: ".__('messages.Dashboard');
        }else{
            $title = "الموكل :".__('messages.Dashboard');
        }

        $count_admins = Admin::where('position_id',1)->count();
        $count_lawyers = Admin::where('position_id',2)->count();
         
        
        
        return view('auth.admin.dashboard',['title' => $title,'count_admins' => $count_admins,'count_lawyers' => $count_lawyers]);
    }

    public function update_warehouses()
    { 
        // ini_set('max_execution_time', '0');
        // ini_set('memory_limit', '20000M');
        // set_time_limit(0);

        // $arrProducts = Product::all();

        

        // foreach ($arrProducts as $objProduct) {
        //     $product_id = $objProduct->id;
        //     $product_quantity = 0;
            

        //     $objWarehouse = Warehouse::where('product_id',$product_id)->first();
        //     $product_quantity+=$objWarehouse->quantity;

            
        //     $arrPurhases = PurchaseHeader::join('purchase_footers', 'purchase_headers.id', '=', 'purchase_footers.purchase_header_id')
        //     ->select('purchase_footers.product_quantity','purchase_footers.created_at','purchase_headers.id')
        //     ->where('product_id',$product_id)
        //     ->where('status','approved')
        //     ->get();


        //     foreach ($arrPurhases as $objPurhase) {
        //         $product_quantity+= $objPurhase->product_quantity;
        //     }


        //     $arrManufactureHeader = ManufactureHeader::where('product_id',$product_id)
        //     ->where('is_product',1)
        //     ->where('status','delivered')
        //     ->get();

            
        //     foreach ($arrManufactureHeader as $objManufacture) {
        //         $product_quantity+= $objManufacture->deliver_quantity;
        //     }

        //     $arrReturns = ItemReturn::where('product_id',$product_id)->get();

        //     foreach ($arrReturns as $objReturn) {
        //         $product_quantity+= $objReturn->quantity;
        //     }

        //     $arrSales = InvoiceHeader::join('invoice_footers', 'invoice_headers.id', '=', 'invoice_footers.invoice_header_id')
        //     ->select('invoice_footers.productQuantity','invoice_footers.created_at','invoice_headers.id')
        //     ->where('product_id',$product_id)
        //     ->where('status','approved')
        //     ->get();

        //     foreach ($arrSales as $objSale) {
        //         $product_quantity-= $objSale->productQuantity;
        //     }


        //     $arrManufactures = ManufactureHeader::join('manufacture_footers', 'manufacture_headers.id', '=', 'manufacture_footers.manufacture_header_id')
        //     ->select('manufacture_footers.productQuantity','manufacture_footers.created_at','manufacture_headers.id')
        //     ->where('manufacture_footers.product_id',$product_id)
        //     ->where('status','approved')
        //     ->get();


        //     foreach ($arrManufactures as $objManufacture) {
        //         $product_quantity-= $objManufacture->productQuantity;
        //     }


        //     $arrManufactures = ManufactureHeader::join('manufacture_footers', 'manufacture_headers.id', '=', 'manufacture_footers.manufacture_header_id')
        //     ->select('manufacture_footers.productQuantity','manufacture_footers.created_at','manufacture_headers.id')
        //     ->where('manufacture_footers.product_id',$product_id)
        //     ->where('status','delivered')
        //     ->get();


        //     foreach ($arrManufactures as $objManufacture) {
        //         $product_quantity-= $objManufacture->productQuantity;
        //     }

        //     $objProduct = Product::find($product_id);
        //     $objProduct->quantity = $product_quantity;
        //     $objProduct->save();            

            
        // }
        
       
        print_r('test'); die;


    }

    public function upload_csv()
    {
        $title = "Upload CSV";
        return view('auth.admin.upload_csv', [
            'title' => $title,
        ]);
    }

    public function upload_csv_save(Request $request)
    {
        //DB::table('test_upload')->truncate();

        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        

        $files = request()->file('file');
        foreach ($files as $file){
            Excel::import(new DataImport, $file);
        }

        // $arrData = DB::table('test_upload')->get();

        // return response()->view('auth.admin.test_upload', [
        //     'arrData' => $arrData
        // ])->header('Content-Type', 'text/vwl');

        
    }
}
