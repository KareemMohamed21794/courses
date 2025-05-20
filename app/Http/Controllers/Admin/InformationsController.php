<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use Illuminate\Support\Facades\Mail;
class InformationsController extends Controller
{
    private const MODEL ='Information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super == 1){
            $title = __('messages.incoming');
            $add_title = __('messages.incoming');
        }else{
            $title = __('messages.issued');
            $add_title = __('messages.issued');
        }
        

        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();

         ///// update read 


        if($objAdmin->is_super == 0){
        Information::where('admin_id', $objAdmin->id)
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        Information::withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
         
        }


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->position_id == 1  || $objAdmin->position_id == 3){
            $can_add = 0;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }


        if($objAdmin->position_id == 4){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }


        if($objAdmin->position_id ==2){
            $can_add = 1;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }

        return view('auth.admin.requests.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print,'objAdmin'=>$objAdmin]);
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
         // print_r('here'); die;
        $validator = Validator::make($request->all(),[
            // 'description' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'file' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        


        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
         $document = '';

         if(!empty($request->file('file'))){
            $file = $request->file('file');
            $destinationPath = "public/images/requests";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
        }


       
        $Information = Information::create([
        'admin_id' => $userId,
        'group_type' =>  $request->group_type,
        'file' =>  $document,
        'file_name' =>  $request->file_name,
        'description' =>  $request->description,
        ]);

        $this->logAction(auth()->id(), 'user', 'send_request', 'create', 'informations', $Information->id);

        $recipient = 'admin@tawasol.com';
        //$recipient = 'mahmoud.ali.29992@gmail.com';
        $subject = 'لديك وارد';

        $data = ['group_name' => $objAdmin->group_name]; // Data to pass to the view

        $fromEmail = 'admin@tawasol.privatescouts.org'; 
        // The "from" email address

        Mail::send('emails.requests', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
            $mail->to($recipient)
                ->from($fromEmail) // Set the "from" email address
                ->subject($subject);
        });
        
        


        return response()->json(['Information'=>$Information]);
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
        $Information  = Information::find($id);
        @$Information->Admin;

        return response()->json($Information);
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
        //$this->authorize(self::MODEL.'-update');
       
            $validator = Validator::make($request->all(),[
               // 'description' => ['required', 'string', 'max:255'],
                'file_name' => ['required', 'string', 'max:255'],
                'file' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $document = '';
        $userId = Auth::id();


        $objInformation = Information::find($id);
        $objInformation->description = $request->description;
        $objInformation->file_name = $request->file_name;
        if(!empty($request->file('file'))){
            $oldImage = $objInformation->file;
            $file = $request->file('file');
            $destinationPath = "public/images/requests";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
            $objInformation->file = $document;
            if($objInformation->save()){
               @unlink("public/images/requests/".$oldImage);
            }
        }

        $objInformation->save();

        $this->logAction(auth()->id(), 'user', 'update_request', 'update', 'informations', $id);
        return response()->json(['objInformation'=>$objInformation]);
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
        $Information = Information::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_request', 'delete', 'informations', $id);
        return response()->json(['Information'=>$Information]);
    }

     public function deleterequests(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Information = Information::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_request', 'delete', 'informations', $id);
        }
        return response()->json(['Information'=>$Information]);
    }


    public function get(Request $request)
    { 
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        if($objAdmin->is_super == 1){
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'admin_id'   => true,
            'file_name'=>true,
            'file'=> true,
            'status'=> true,
            'reject_notes'=> true,
            'description'=>true,
            'created_at'   => true,
        ];

        }else{

            $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'file_name'=>true,
            'file'=> true,
            'status'=> true,
            'reject_notes'=> true,
            'description'=>true,
            'created_at'   => true,
        ];

        }

        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }

       
        $active = $request->active;
        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
        if($objAdmin->is_super == 1|| $objAdmin->position_id == 4|| $objAdmin->position_id == 3){

           $alldata = Information::whereBetween('created_at',[$first_day_year,$last_day_year])->get();
        
            if($active=='All'){
                $alldata = Information::withTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = Information::whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = Information::onlyTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
        }else{

            $alldata = Information::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            if($active=='All'){
                $alldata = Information::withTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = Information::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = Information::onlyTrashed()->where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }



        }

        

        $alldataResult=array();
 
        foreach($alldata as $key=> $objdata){

            $status = '';

            if($objdata->status == 'rejected'){
              $status = 'مرفوض';  
            }elseif($objdata->status == 'approved'){
                $status = 'مقبول';
            }else{
                $status = 'قيد الانتظار';
            }

            if($objAdmin->is_super == 1){
          
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "admin_id" => @$objdata->Admin->group_name,
                "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/requests/' . $objdata->file) . '">تحميل الملف<a>',
                
                "status"=> $status,
                "reject_notes"=> $objdata->reject_notes,
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
            );

            }else{



                $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/requests/' . $objdata->file) . '">تحميل الملف<a>',
                "status"=> $status,
                "reject_notes"=> $objdata->reject_notes,
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
            );

            }
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




    public function ExportRequests(Request $request)
    {
        $fileName = 'export_requests.csv';
        
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
       
        if ($objAdmin->is_super == 1) {
            $Informations = Information::whereBetween('created_at',[$first_day_year,$last_day_year])->orWhere('status','approved')->get();
            $columns = array(__('messages.scout_group'), 'الملف', 'اسم الملف', 'الشرح');
        } else {
            $Informations = Information::where('admin_id', $userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            $columns = array('الملف', 'اسم الملف', 'الشرح');
        }

        // Set the response headers with the correct character encoding
        $headers = array(
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function () use ($Informations, $columns, $objAdmin) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            // Write the data rows
            foreach ($Informations as $Information) {
                $row = array();

                if ($objAdmin->is_super == 1) {
                    // Show group_name only for super admin
                    $row['admin_id'] = $Information->Admin->group_name;
                }

                $row['file'] = asset('public/images/requests/' . $Information->file);
                $row['file_name'] = $Information->file_name;
                $row['description'] = $Information->description;

                // Write the row data to the CSV file
                if ($objAdmin->is_super == 1) {
                    fputcsv($file, array($row['admin_id'], $row['file'], $row['file_name'], $row['description']));
                } else {
                    fputcsv($file, array($row['file'], $row['file_name'], $row['description']));
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    public function reject_accept($status,$id)
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $objInformation = Information::find($id);
        $objInformation->status = $status;
        $objInformation->reject_notes = null;
        $objInformation->save();


        $this->logAction(auth()->id(), 'user', 'accept_request', 'accepted', 'informations', $id);

        $recipient = 'admin@tawasol.com';
        //$recipient = 'mahmoud.ali.29992@gmail.com';
        $subject = 'تم قبول الوارد';

        $data = ['content' => 'تم قبول الوارد' ,'group_name' => $objAdmin->group_name]; // Data to pass to the view

        $fromEmail = 'admin@tawasol.privatescouts.org'; 
        // The "from" email address

        // Mail::send('emails.requests', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
        //     $mail->to($recipient)
        //         ->from($fromEmail) // Set the "from" email address
        //         ->subject($subject);
        // });
        


        return response()->json(['objInformation'=>$objInformation]);
    }


public function RejectedRequest(Request $request)
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $request_id = $request->request_id;
        $reject_notes = $request->reject_notes;
        $objInformation = Information::find($request_id);
        $objInformation->status = 'rejected';
        $objInformation->reject_notes = $reject_notes;
        
        $objInformation->save();

        $this->logAction(auth()->id(), 'user', 'reject_request', 'rejected', 'informations', $request_id);

        $recipient = 'admin@tawasol.com';
        //$recipient = 'mahmoud.ali.29992@gmail.com';
        $subject = 'تم رفض الوارد';

        $data = ['content' => $reject_notes,'group_name' => $objAdmin->group_name]; // Data to pass to the view

        $fromEmail = 'admin@tawasol.privatescouts.org'; 
        // The "from" email address

        Mail::send('emails.requests', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
            $mail->to($recipient)
                ->from($fromEmail) // Set the "from" email address
                ->subject($subject);
        });
        


        return response()->json(['objInformation'=>$objInformation]);
    }


    public function ReportArchiveRequests()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.archive_requests') ;
        
        return view('auth.admin.requests.report_archive_requests', [
            'title' => $title,
        ]);
    }



    public function ReportArchiveRequestsGet()
    {
        $year = @$_GET['year'];
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       
        $title = __('messages.archive_requests') . ' - ' . 'سنة ' .$year;

        return view('auth.admin.requests.report_archive_requests_get', ['title' => $title,'year' => $year]);
    }



    public function report_archive_Requests_get_list(Request $request)
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        ini_set('memory_limit', '-1');

        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'admin_id'   => true,
            'file_name'=>true,
            'file'=> true,
            'status'=> true,
            'reject_notes'=> true,
            'description'=>true,
            'created_at'   => true,
        ];


        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }

        
        // Set the first day of the provided year at midnight (00:00:00)
        $first_day_year = date('Y-m-d 00:00:00', strtotime("first day of january $request->year"));

        // Set the last day of the provided year at 23:59:59
        $last_day_year = $request->year . '-12-31 23:59:59';

        $title = __('messages.archive_advertisements');
        
        // Fetch all advertisements where the created_at date is between the first and last day of the provided year
        if($objAdmin->position_id == 2){
        $alldata = Information::where(function($query) use ($objAdmin, $first_day_year, $last_day_year) {
        $query->where('admin_id', $objAdmin->id)
              ->whereBetween('created_at', [$first_day_year, $last_day_year])
               ->where(function($q) {
                  $q->where('status', '!=', 'rejected')
                    ->orWhereNull('status');
              });
        })
        ->get();

        }else{
            
        $alldata = Information::where(function($query) use ($first_day_year, $last_day_year) {
        $query->whereBetween('created_at', [$first_day_year, $last_day_year])
              ->where(function($q) {
                  $q->where('status', '!=', 'rejected')
                    ->orWhereNull('status');
              });
        })
        ->get();
        }

       
       
        $alldataResult=array();
 
        foreach($alldata as $key=> $objdata){

            $status = '';

            if($objdata->status == 'rejected'){
              $status = 'مرفوض';  
            }elseif($objdata->status == 'approved'){
                $status = 'مقبول';
            }else{
                $status = 'قيد الانتظار';
            }

          
          
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "admin_id" => @$objdata->Admin->group_name,
                "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/requests/' . $objdata->file) . '">تحميل الملف<a>',
                
                "status"=> $status,
                "reject_notes"=> $objdata->reject_notes,
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
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
