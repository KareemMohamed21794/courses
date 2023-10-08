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

        if(@$objAdmin->is_super){
            // Fetch notifications from the Problem model
            $problemNotifications = Problem::where('type','procedure')
            ->where('status','pending')
            ->where('send_email',0)
            ->get();
        }else{
            // Fetch notifications from the Problem model
            $problemNotifications = Problem::where('type','procedure')
            ->where('status','pending')
            ->where('admin_id',@$objAdmin->id)
            ->where('send_email',0)
            ->get();
        }


        
        foreach ($problemNotifications as $problem) {

            if(empty($problem->number_days_remind)) continue;

            
            $notificationDate = Carbon::parse($problem->file_open_date)->addDays($problem->number_days_remind);

            if (Carbon::now()->isSameDay($notificationDate)) {

                $body = "المعامله $problem->subject لم تتم عليا اى اجراء";
                 
                # send email 
                $recipient = $objAdmin->email;
                $subject = __('messages.remind_notification_title');

                $data= [
                        'source' => 'Problem',
                        'id' => $problem->id,
                        'title' => __('messages.remind_notification_title'),
                        'body' => "المعامله $problem->subject لم تتم عليا اى اجراء",
                ];

                $fromEmail = 'info@qalam.lawjo.net'; 
                 

            }
        }

        
        $userId = \Auth::id();
        if(request()->segment(1)=='admin'){
            $title = "الاداره: ".__('messages.Dashboard');
        }else{
            $title = "الموكل :".__('messages.Dashboard');
        }

        $count_admins = Admin::where('position_id',1)->count();
        $count_lawyers = Admin::where('position_id',2)->count();
        $count_secretariats = Admin::where('position_id',3)->count();
        $count_clients = Client::count();
        $count_procedure = 0;
        $count_case = 0;
        if (Auth::guard('admin')->check()) {
            if(Auth::user()->is_super){
                $count_procedure = Problem::where('type','procedure')->count();
                $count_case = Problem::where('type','case')->count();
            }else{
                $count_procedure = Problem::where('type','procedure')->where('admin_id',$userId)->count();
                $count_case = Problem::where('type','case')->where('admin_id',$userId)->count();
            }
            
        }else{
            $count_procedure = Problem::where('type','procedure')->where('client_id',$userId)->count();
            $count_case = Problem::where('type','case')->where('client_id',$userId)->count();
        }

        // Get today's date
        $today = Carbon::today();

        // Get the start and end of the current week
        $startOfWeek = $today;
        $endOfWeek = $today->copy()->addDays(7); // 7 days from today



        // Get the start and end of the current month
        $startOfMonth = $today;
        $endOfMonth = $today->copy()->addDays(30); // 30 days from today

       
 
        $daily_procedures = ProblemProcedure::whereDate('date', $today)
        ->whereHas('problem', function ($query) {
            $query->where('type', 'procedure');
        })
        ->orderBy('date', 'desc')
        ->get();
 
        $weekly_procedures = ProblemProcedure::whereBetween('date', [$startOfWeek, $endOfWeek])
        ->whereHas('problem', function ($query) {
            $query->where('type', 'procedure');
        })
        ->orderBy('date', 'desc')
        ->get();   
 

       $monthly_procedures = ProblemProcedure::whereBetween('date', [$startOfMonth, $endOfMonth])
        ->whereHas('problem', function ($query) {
            $query->where('type', 'procedure');
        })
        ->orderBy('date', 'desc')
        ->get();       



        $daily_cases = ProblemProcedure::whereDate('next_session_date', $today)
        ->whereHas('problem', function ($query) {
            $query->where('type', 'case');
        })
        ->orderBy('next_session_date', 'desc')
        ->get();

 
        $weekly_cases = ProblemProcedure::whereBetween('next_session_date', [$startOfWeek, $endOfWeek])
        ->whereHas('problem', function ($query) {
            $query->where('type', 'case');
        })
        ->orderBy('next_session_date', 'desc')
        ->get();   
 

       $monthly_cases = ProblemProcedure::whereBetween('next_session_date', [$startOfMonth, $endOfMonth])
        ->whereHas('problem', function ($query) {
            $query->where('type', 'case');
        })
        ->orderBy('next_session_date', 'desc')
        ->get();        

        
        
        return view('auth.admin.dashboard',['title' => $title,'count_admins' => $count_admins,'count_lawyers' => $count_lawyers,'count_secretariats' => $count_secretariats,'count_clients' => $count_clients,'count_procedure' => $count_procedure,'count_case' => $count_case,'daily_procedures' => $daily_procedures,'weekly_procedures' => $weekly_procedures,'monthly_procedures' => $monthly_procedures,'daily_cases' => $daily_cases,'weekly_cases' => $weekly_cases,'monthly_cases' => $monthly_cases]);
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
