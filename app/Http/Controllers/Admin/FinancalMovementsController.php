<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\FinancialMovement;
use App\Models\Admin;
use App\Models\Setup;
use Illuminate\Support\Facades\Storage;
use App\Models\StudentRegistration;
use App\Models\Permit;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;

class FinancalMovementsController extends Controller
{
    private const MODEL ='FinancialMovement';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.financial_movements');
        $add_title = __('messages.financial_movement');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $arrPaymentMethod = PaymentMethod::orderBy('id')->get();
        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();

        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->position_id == 1 || $objAdmin->position_id ==6){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }


        if($objAdmin->position_id == 4 || $objAdmin->position_id == 2 ){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }


        if( $objAdmin->position_id == 3){
            $can_add = 1;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }


      

        return view('auth.admin.financial_movements.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'arrPaymentMethod'=>$arrPaymentMethod,'leaders'=>$leaders,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(self::MODEL.'-store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(self::MODEL.'-store');
         
        $validator = Validator::make($request->all(),[
            'admin_id' => ['required'],
            'price' => ['required'],
            'receipt_number' => ['required'],
            'date' => ['required'],
            'payment_method_id' => ['required'],
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();


        $FinancialMovement = FinancialMovement::create([
            'admin_id' =>  $request->admin_id,
            'price' =>  $request->price,
            'receipt_number' =>  $request->receipt_number,
            'date' =>  $request->date,
            'payment_method_id' =>  $request->payment_method_id,
            'user_id' =>  $userId,
          
           
        ]);

        $this->logAction(auth()->id(), 'user', 'add_financial_movement', 'create', 'financial_movements', $FinancialMovement->id);

        return response()->json(['FinancialMovement'=>$FinancialMovement]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize(self::MODEL.'-viewAny');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(self::MODEL.'-update');
        $FinancialMovement  = FinancialMovement::find($id);
        @$FinancialMovement->Admin;
        @$FinancialMovement->PaymentMethod;
        return response()->json($FinancialMovement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(),[
            'admin_id' => ['required'],
            'price' => ['required'],
            'receipt_number' => ['required'],
            'date' => ['required'],
            'payment_method_id' => ['required'],
            
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $objFinancialMovement = FinancialMovement::find($id);
       
        $objFinancialMovement->admin_id =  $request->admin_id;
        $objFinancialMovement->price =  $request->price;
        $objFinancialMovement->receipt_number =  $request->receipt_number;
        $objFinancialMovement->date =  $request->date;
        $objFinancialMovement->payment_method_id =  $request->payment_method_id;
       
        $objFinancialMovement->save();

        $this->logAction(auth()->id(), 'user', 'update_financial_movement', 'update', 'financial_movements', $objFinancialMovement->id);

        return response()->json(['objFinancialMovement'=>$objFinancialMovement]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize(self::MODEL.'-delete');
        $FinancialMovement = FinancialMovement::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_financial_movement', 'delete', 'financial_movements', $id);
        return response()->json(['FinancialMovement'=>$FinancialMovement]);
    }

     public function deletePaymentsReceived(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $FinancialMovement = FinancialMovement::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_financial_movement', 'delete', 'financial_movements', $id);
        }

        return response()->json(['FinancialMovement'=>$FinancialMovement]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'admin_id'   => true,
            'price'   => true,
            'receipt_number'   => true,
            'date'   => true,
            'payment_method_id'   => true,
           
            'created_at'   => true,
        ];

        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $active = $request->active;

        if($objAdmin->is_super == 1 || $objAdmin->position_id == 4 || $objAdmin->position_id == 3){

           $alldata = FinancialMovement::get();
        
            if($active=='All'){
                $alldata = FinancialMovement::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = FinancialMovement::get();
            }
            elseif($active=='DeActive'){
                $alldata = FinancialMovement::onlyTrashed()->get();
            }
        }else if($objAdmin->position_id == 6){
       
            $alldata = FinancialMovement::where('user_id',$userId)->get();
            if($active=='All'){
                $alldata = FinancialMovement::withTrashed()->where('user_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = FinancialMovement::where('user_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = FinancialMovement::onlyTrashed()->where('user_id',$userId)->get();
            }
        }else{
       
            $alldata = FinancialMovement::where('admin_id',$userId)->get();
            if($active=='All'){
                $alldata = FinancialMovement::withTrashed()->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = FinancialMovement::where('admin_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = FinancialMovement::onlyTrashed()->where('admin_id',$userId)->get();
            }
        }
        



        $alldataResult=array();

        foreach($alldata as $key=> $objdata){
            
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "admin_id" => @$objdata->Admin->group_name,
                "price" => $objdata->price,
                "receipt_number" => $objdata->receipt_number,
                "date" => $objdata->date,
                "payment_method_id" => @$objdata->PaymentMethod->name_ar,
                
                "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
            );
        }

       $alldata =$alldataResult ;
        $data = [];
        // internal use; filter selected columns only from raw data
        foreach ( $alldata as $d ) {
            $data[] = $this->filterArray( $d, $columnsDefault );
        }

        // count data
        $totalRecords = $totalDisplay = count( $data );

        // filter by general search keyword
        if ( isset( $request->search ) ) {
            $data         =  $this->filterKeyword( $data, $request->search );
            $totalDisplay = count( $data );
        }

        if ( isset( $request->columns ) && is_array( $request->columns ) ) {
            foreach ( $request->columns as $column ) {
                if ( isset( $column['search'] ) ) {
                    $data         =  $this->filterKeyword( $data, $column['search'], $column['data'] );
                    $totalDisplay = count( $data );
                }
            }
        }

        // sort
        if ( isset( $request->order[0]['column'] ) && $request->order[0]['dir'] ) {
            $column = $request->order[0]['column'];
            $dir    = $request->order[0]['dir'];
            usort( $data, function ( $a, $b ) use ( $column, $dir ) {
                $a = array_slice( $a, $column, 1 );
                $b = array_slice( $b, $column, 1 );
                $a = array_pop( $a );
                $b = array_pop( $b );

                if ( $dir === 'asc' ) {
                    return $a > $b ? true : false;
                }

                return $a < $b ? true : false;
            } );
        }

        // pagination length
        if ( isset( $request->length ) ) {
            $data = array_splice( $data, $_REQUEST['start'], $request->length );
        }

        // return array values only without the keys
        if ( isset( $request->array_values ) && $request->array_values ) {
            $tmp  = $data;
            $data = [];
            foreach ( $tmp as $d ) {

                $data[] = array_values( $d );
            }
        }


        $secho = 0;
        if ( isset( $request->sEcho ) ) {
            $secho = intval( $request->sEcho );
        }

        $result = [
            'recordsTotal'        => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data'               => $data,
        ];


        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        return  json_encode( $result, JSON_PRETTY_PRINT );
    }

    function filterArray( $array, $allowed = [] ) {
        return array_filter(
            $array,
            function ( $val, $key ) use ( $allowed ) { // N.b. $val, $key not $key, $val
                return isset( $allowed[ $key ] ) && ( $allowed[ $key ] === true || $allowed[ $key ] === $val );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    function filterKeyword( $data, $search, $field = '' ) {
        $filter = '';
        if ( isset( $search['value'] ) ) {
            $filter = $search['value'];
        }
        if ( ! empty( $filter ) ) {
            if ( ! empty( $field ) ) {
                if ( strpos( strtolower( $field ), 'date' ) !== false ) {
                    // filter by date range
                    $data = filterByDateRange( $data, $filter, $field );
                } else {
                    // filter by column
                    $data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
                        return (boolean) preg_match( "/$filter/i", $a[ $field ] );
                    } );
                }

            } else {
                // general filter
                $data = array_filter( $data, function ( $a ) use ( $filter ) {
                    return (boolean) preg_grep( "/$filter/i", (array) $a );
                } );
            }
        }

        return $data;
    }

    function filterByDateRange( $data, $filter, $field ) {
        // filter by range
        if ( ! empty( $range = array_filter( explode( '|', $filter ) ) ) ) {
            $filter = $range;
        }

        if ( is_array( $filter ) ) {
            foreach ( $filter as &$date ) {
                // hardcoded date format
                $date = date_create_from_format( 'm/d/Y', stripcslashes( $date ) );
            }
            // filter by date range
            $data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
                // hardcoded date format
                $current = date_create_from_format( 'm/d/Y', $a[ $field ] );
                $from    = $filter[0];
                $to      = $filter[1];
                if ( $from <= $current && $to >= $current ) {
                    return true;
                }

                return false;
            } );
        }

        return $data;
    }  


    public function financial_movements()
    {
        $title = __('messages.group_finances');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $Setup = Setup::first();
        $leaders = Admin::where('position_id',2)->get();
        
        $admin_id = '';

        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
        if(!empty($_GET['admin_id'])){
          $admin_id = $_GET['admin_id'];
        }else{
            $admin_id = $objAdmin->id;
        }

      
       
        $count_aliashbalu = StudentRegistration::where('admin_id',$admin_id)->where('division',1)->where('type','approved')->where('year',date('Y'))->count();
        

        if ($count_aliashbalu >= 1) {
         //$alrusum_wehda_aliashbalu = ceil($count_aliashbalu / 30) * 10;
         $alrusum_wehda_aliashbalu =  10;
        }else{
            $alrusum_wehda_aliashbalu = 0;
        }


        $count_alkashaaf = StudentRegistration::where('admin_id',$admin_id)->where('division',2)->where('type','approved')->where('year',date('Y'))->count();
        

        if ($count_alkashaaf >= 1) {
         //$alrusum_wehda_alkashaaf = ceil($count_alkashaaf / 30) * 10;
         $alrusum_wehda_alkashaaf = 10;
        }else{
            $alrusum_wehda_alkashaaf = 0;
        }



        $count_almutaqadima = StudentRegistration::where('admin_id',$admin_id)->where('division',3)->where('type','approved')->where('year',date('Y'))->count();

        
        if ($count_almutaqadima >= 1) {
         //$alrusum_wehda_almutaqadima = ceil($count_almutaqadima / 30) * 10;
         $alrusum_wehda_almutaqadima =  10;
        }else{
            $alrusum_wehda_almutaqadima = 0;
        }


        $count_aljawaluh = StudentRegistration::where('admin_id',$admin_id)->where('division',4)->where('type','approved')->where('year',date('Y'))->count();


        if ($count_aljawaluh >= 1) {
         //$alrusum_wehda_aljawaluh = ceil($count_aljawaluh / 30) * 10;
         $alrusum_wehda_aljawaluh =  10;
        }else{
            $alrusum_wehda_aljawaluh = 0;
        }


        $count_leaders = StudentRegistration::where('admin_id',$admin_id)->where('division',5)->where('type','approved')->where('year',date('Y'))->count();


        if ($count_leaders >= 1) {
           // $alrusum_wehda_leaders = ceil($count_leaders / 30) * 10;
            $alrusum_wehda_leaders =  0;
        }else{
            $alrusum_wehda_leaders = 0;
        }
       
         if($Setup && $Setup->dead_line){
            
            $count_late_students = StudentRegistration::where('admin_id',$admin_id)->where('type','approved')->where('created_at','>=',$Setup->dead_line)->where('year',date('Y'))->count();
        }else{
             $count_late_students = 0;
           
        }
        

       

        
     
        $alrusum  = 0.50;
        $alrusum_late  = ($alrusum * 50) / 100;
        $total_alrusum_late = $alrusum + $alrusum_late;


        $total_alrusum_wehda_leaders = ($count_leaders * $alrusum) + $alrusum_wehda_leaders;
        $total_alrusum_wehda_aliashbalu = ($count_aliashbalu * $alrusum) + $alrusum_wehda_aliashbalu;
        $total_alrusum_wehda_alkashaaf = ($count_alkashaaf * $alrusum) + $alrusum_wehda_alkashaaf;
        $total_alrusum_wehda_almutaqadima = ($count_almutaqadima * $alrusum) + $alrusum_wehda_almutaqadima;
        $total_alrusum_wehda_aljawaluh = ($count_aljawaluh * $alrusum ) + $alrusum_wehda_aljawaluh;


        $final_total_alrusum = ($total_alrusum_wehda_leaders + $total_alrusum_wehda_aliashbalu + $total_alrusum_wehda_alkashaaf + $total_alrusum_wehda_almutaqadima + $total_alrusum_wehda_aljawaluh) + ($count_late_students * $total_alrusum_late);


        $total_permits = Permit::where('admin_id', $admin_id)
            ->whereBetween('permits.created_at',[$first_day_year,$last_day_year])
            ->join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
            ->sum('type_activity.price');

        $total_credit = $final_total_alrusum + $total_permits;

        $total_debit = FinancialMovement::where('admin_id', $admin_id)->whereBetween('created_at',[$first_day_year,$last_day_year])->sum('price');

        $remain = $total_debit - $total_credit;

        $objAdmin_group = Admin::find($admin_id);


        ////total permits 

        $sum = Permit::where('admin_id', $objAdmin_group->id)
        ->whereBetween('permits.created_at',[$first_day_year,$last_day_year])
        ->join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
        ->sum('type_activity.price');
        

        $allPermit = Permit::where('admin_id',$objAdmin_group->id)->whereBetween('created_at',[$first_day_year,$last_day_year])->with('TypeActivity')->get();


        return view('auth.admin.financial_movements.financial_movements',['title' => $title,'objAdmin'=>$objAdmin,'total_credit'=>$total_credit,'total_debit'=>$total_debit , 'remain'=>$remain,'leaders'=>$leaders,'admin_id'=>$admin_id,'objAdmin_group'=>$objAdmin_group,'final_total_alrusum'=>$final_total_alrusum,'total_permits'=>$total_permits,'sum'=>$sum,'allPermit'=>$allPermit,'count_aliashbalu'=>$count_aliashbalu,'count_alkashaaf'=>$count_alkashaaf,'count_almutaqadima'=>$count_almutaqadima,'count_aljawaluh'=>$count_aljawaluh,'count_leaders'=>$count_leaders,'count_late_students'=>$count_late_students,'alrusum_wehda_aliashbalu'=>$alrusum_wehda_aliashbalu,'alrusum_wehda_alkashaaf'=>$alrusum_wehda_alkashaaf,'alrusum_wehda_almutaqadima'=>$alrusum_wehda_almutaqadima,'alrusum_wehda_aljawaluh'=>$alrusum_wehda_aljawaluh,'alrusum_wehda_leaders'=>$alrusum_wehda_leaders,'alrusum'=>$alrusum,'alrusum_late'=>$alrusum_late,'total_alrusum_late'=>$total_alrusum_late,'total_alrusum_wehda_leaders'=>$total_alrusum_wehda_leaders,'total_alrusum_wehda_aliashbalu'=>$total_alrusum_wehda_aliashbalu,'total_alrusum_wehda_alkashaaf'=>$total_alrusum_wehda_alkashaaf,'total_alrusum_wehda_almutaqadima'=>$total_alrusum_wehda_almutaqadima,'total_alrusum_wehda_aljawaluh'=>$total_alrusum_wehda_aljawaluh,'final_total_alrusum'=>$final_total_alrusum,'leaders'=>$leaders,'admin_id'=>$admin_id,'objAdmin_group'=>$objAdmin_group,'Setup'=>$Setup]);
    }





      public function financial_claims()
    {
        $title = __('messages.group_finances');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        $objAdmin->claim_number = empty($objAdmin->claim_number) ? '001' : str_pad($objAdmin->claim_number + 1, 3, '0', STR_PAD_LEFT);
        $objAdmin->save();
     
        return view('auth.admin.financial_movements.financial_claims',['title' => $title,'objAdmin'=>$objAdmin]);
    }


    public function ReportFinancialMovements()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_financial_movements');
        $leaders = Admin::where('is_super','!=',1)->get();
        return view('auth.admin.financial_movements.report_financial_movements', [
            'title' => $title,
            'leaders' => $leaders,
        ]);
    }



    public function ReportFinancialMovementsGet()
    {
        $leader_id = @$_GET['leader_id'];
        $Setup = Setup::first();
        $objAdmin_data = Admin::find($leader_id);
        $obj_admin_name = $objAdmin_data ? $objAdmin_data->group_name : 'الكل';
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
        $title = __('messages.report_financial_movements'). ' - ' .$obj_admin_name;

        $admin_id = $objAdmin_data->id;

        $count_aliashbalu = StudentRegistration::where('admin_id',$admin_id)->where('division',1)->where('type','approved')->where('year',date('Y'))->count();
        

        if ($count_aliashbalu >= 1) {
         //$alrusum_wehda_aliashbalu = ceil($count_aliashbalu / 30) * 10;
         $alrusum_wehda_aliashbalu =  10;
        }else{
            $alrusum_wehda_aliashbalu = 0;
        }


        $count_alkashaaf = StudentRegistration::where('admin_id',$admin_id)->where('division',2)->where('type','approved')->where('year',date('Y'))->count();
        

        if ($count_alkashaaf >= 1) {
         //$alrusum_wehda_alkashaaf = ceil($count_alkashaaf / 30) * 10;
         $alrusum_wehda_alkashaaf = 10;
        }else{
            $alrusum_wehda_alkashaaf = 0;
        }



        $count_almutaqadima = StudentRegistration::where('admin_id',$admin_id)->where('division',3)->where('type','approved')->where('year',date('Y'))->count();

        
        if ($count_almutaqadima >= 1) {
         //$alrusum_wehda_almutaqadima = ceil($count_almutaqadima / 30) * 10;
         $alrusum_wehda_almutaqadima =  10;
        }else{
            $alrusum_wehda_almutaqadima = 0;
        }


        $count_aljawaluh = StudentRegistration::where('admin_id',$admin_id)->where('division',4)->where('type','approved')->where('year',date('Y'))->count();


        if ($count_aljawaluh >= 1) {
         //$alrusum_wehda_aljawaluh = ceil($count_aljawaluh / 30) * 10;
         $alrusum_wehda_aljawaluh =  10;
        }else{
            $alrusum_wehda_aljawaluh = 0;
        }


        $count_leaders = StudentRegistration::where('admin_id',$admin_id)->where('division',5)->where('type','approved')->where('year',date('Y'))->count();


        if ($count_leaders >= 1) {
           // $alrusum_wehda_leaders = ceil($count_leaders / 30) * 10;
            $alrusum_wehda_leaders =  0;
        }else{
            $alrusum_wehda_leaders = 0;
        }
       
         if($Setup && $Setup->dead_line){
            
            $count_late_students = StudentRegistration::where('admin_id',$admin_id)->where('type','approved')->where('created_at','>=',$Setup->dead_line)->where('year',date('Y'))->count();
        }else{
             $count_late_students = 0;
           
        }
        

       

        
     
        $alrusum  = 0.50;
        $alrusum_late  = ($alrusum * 50) / 100;
        $total_alrusum_late = $alrusum + $alrusum_late;


        $total_alrusum_wehda_leaders = ($count_leaders * $alrusum) + $alrusum_wehda_leaders;
        $total_alrusum_wehda_aliashbalu = ($count_aliashbalu * $alrusum) + $alrusum_wehda_aliashbalu;
        $total_alrusum_wehda_alkashaaf = ($count_alkashaaf * $alrusum) + $alrusum_wehda_alkashaaf;
        $total_alrusum_wehda_almutaqadima = ($count_almutaqadima * $alrusum) + $alrusum_wehda_almutaqadima;
        $total_alrusum_wehda_aljawaluh = ($count_aljawaluh * $alrusum ) + $alrusum_wehda_aljawaluh;


        $final_total_alrusum = ($total_alrusum_wehda_leaders + $total_alrusum_wehda_aliashbalu + $total_alrusum_wehda_alkashaaf + $total_alrusum_wehda_almutaqadima + $total_alrusum_wehda_aljawaluh) + ($count_late_students * $total_alrusum_late);


        $total_permits = Permit::where('admin_id', $admin_id)
            ->whereBetween('permits.created_at',[$first_day_year,$last_day_year])
            ->join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
            ->sum('type_activity.price');

        $total_credit = $final_total_alrusum + $total_permits;

        $total_debit = FinancialMovement::where('admin_id', $admin_id)->whereBetween('created_at',[$first_day_year,$last_day_year])->sum('price');

        $remain = $total_debit - $total_credit;

        $objAdmin_group = Admin::find($admin_id);

        return view('auth.admin.financial_movements.report_financial_movements_get', ['title' => $title,'leader_id' => $leader_id,'total_credit'=>$total_credit,'total_debit'=>$total_debit , 'remain'=>$remain,'admin_id'=>$admin_id,'objAdmin_group'=>$objAdmin_group,'final_total_alrusum'=>$final_total_alrusum,'total_permits'=>$total_permits]);
    }



    public function ReportFinancialMovementsGetlist(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            'order'   => true,
            'admin_id'   => true,
            'price'   => true,
            'receipt_number'   => true,
            'date'   => true,
            'payment_method_id'   => true,
           
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }


        $alldata = FinancialMovement::all();
       
        $title = __('messages.report_secondary_registrations');
        
        if($request->leader_id){
            $alldata = $alldata->where('admin_id',$request->leader_id);
        } 

      
        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {
           
           $alldataResult[] = array(
               
                "order" => $key+1,
                "admin_id" => @$objdata->Admin->group_name,
                "price" => $objdata->price,
                "receipt_number" => $objdata->receipt_number,
                "date" => $objdata->date,
                "payment_method_id" => @$objdata->PaymentMethod->name_ar,
                
               
            );
            
        }


        // dd($alldataResult);
        $alldata = $alldataResult;
       
        $data = [];
        // internal use; filter selected columns only from raw data
        foreach ($alldata as $d) {
            $data[] = $this->filterArray($d, $columnsDefault);
        }


        // count data
        $totalRecords = $totalDisplay = count($data);

        // filter by general search keyword
        if (isset($request->search)) {
            $data = $this->filterKeyword($data, $request->search);
            $totalDisplay = count($data);
        }

        if (isset($request->columns) && is_array($request->columns)) {
            foreach ($request->columns as $column) {
                if (isset($column['search'])) {
                    $data = $this->filterKeyword($data, $column['search'], $column['data']);
                    $totalDisplay = count($data);
                }
            }
        }

        // sort
        if (isset($request->order[0]['column']) && $request->order[0]['dir']) {
            $column = $request->order[0]['column'];
            $dir = $request->order[0]['dir'];
            usort($data, function ($a, $b) use ($column, $dir) {
                $a = array_slice($a, $column, 1);
                $b = array_slice($b, $column, 1);
                $a = array_pop($a);
                $b = array_pop($b);

                if ($dir === 'asc') {
                    return $a > $b ? true : false;
                }

                return $a < $b ? true : false;
            });
        }

        // pagination length
        if (isset($request->length)) {
            $data = array_splice($data, $_REQUEST['start'], $request->length);
        }

        // return array values only without the keys
        if (isset($request->array_values) && $request->array_values) {
            $tmp = $data;
            $data = [];
            foreach ($tmp as $d) {

                $data[] = array_values($d);
            }
        }

        $secho = 0;
        if (isset($request->sEcho)) {
            $secho = intval($request->sEcho);
        }

        $result = [
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data' => $data,
        ];

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        return json_encode($result, JSON_PRETTY_PRINT);
    }


}
