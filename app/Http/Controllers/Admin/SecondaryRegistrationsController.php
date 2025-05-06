<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Admin;
use App\Models\Setup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentRegistration;
use Validator;
use Auth;
use Lang;
use PDF;
use TCPDF;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
class SecondaryRegistrationsController extends Controller
{
    private const MODEL ='File';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.secondary_registrations');
        $add_title = __('messages.secondary_registrations');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $exsistdata = File::where('admin_id',$userId)->where('type','secondary_registration')->where('year',date('Y'))->first();


        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();

        ///// update read 


        if($objAdmin->is_super == 0){
        File::where('admin_id', $objAdmin->id)
        ->where('type','secondary_registration')
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        File::withTrashed() // Include both active and soft-deleted records
        ->where('type','secondary_registration')
        ->update(['read' => 1]);
         
        }


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->position_id == 1  || $objAdmin->position_id == 3){
            $can_add = 1;
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
            $can_print = 0;
        }


        return view('auth.admin.secondary_registrations.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'exsistdata'=>$exsistdata,'leaders'=>$leaders,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print,'objAdmin'=>$objAdmin]);
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
         //print_r($request->year); die;
        $validator = Validator::make($request->all(),[
            'secondary_registration' => ['required'],
            'year' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }



        $userId = Auth::id();

        if($request->leader_id){
           $userId = $request->leader_id;
        }

        $exsistdata = File::where('admin_id',$userId)->where('type','secondary_registration')->where('year',date('Y'))->first();


        if($exsistdata){
            return response()->json(["message" => "هذا السجل موجود من قبل"], Response::HTTP_BAD_REQUEST);

        }


        $secondary_registration = '';

         if(!empty($request->file('secondary_registration'))){
            $file = $request->file('secondary_registration');
            $destinationPath = "public/images/files";
            $secondary_registration = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration);
        }

        $File = File::create([
            'secondary_registration' =>  $secondary_registration,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            'type' =>  'secondary_registration',
            'year' =>  $request->year,
        ]);

        $this->logAction(auth()->id(), 'user', 'add_secondary_registration', 'create', ' files', $File->id);

        return response()->json(['File'=>$File]);
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
        $File  = File::find($id);
        @$File->Admin;

        return response()->json($File);
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
                // 'secondary_registration' => ['required'],
                'year' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $secondary_registration = '';

        $userId = Auth::id();

        $objFile = File::find($id);
        $objFile->year = $request->year;
        $objFile->admin_id = $request->leader_id ? $request->leader_id : $userId;
        if(!empty($request->file('secondary_registration'))){
            $oldImage = $objFile->secondary_registration;
            $file = $request->file('secondary_registration');
            $destinationPath = "public/images/files";
            $secondary_registration = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration);
            $objFile->secondary_registration = $secondary_registration;
            if($objFile->save()){
               @unlink("public/images/files/".$oldImage);
            }
        }
        $objFile->save();

        $this->logAction(auth()->id(), 'user', 'update_secondary_registration', 'update', ' files', $objFile->id);
        return response()->json(['objFile'=>$objFile]);
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
        $objFile = File::where('id',$id)->first();
        $File = File::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_'.$objFile->type, 'delete', ' files', $id);
        return response()->json(['File'=>$File]);
    }

     public function deleteSecondaryRegistrations(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        foreach ($request->ids as $key => $id) {
            $objFile = File::where('id',$id)->first();
            $this->logAction(auth()->id(), 'user', 'delete_'.$objFile->type, 'delete', ' files', $id);
        }
        $File = File::whereIn('id',$request->ids)->delete();
       
        return response()->json(['File'=>$File]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'count'   => true,
            'approved_count'   => true,
            // 'year'   => true,
            // 'status'   => true,
            // 'created_at'   => true,
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
        // if($objAdmin->is_super == 1|| $objAdmin->position_id == 4|| $objAdmin->position_id == 3){

        //    $alldata = File::where('type','secondary_registration')->get();
        
        //     if($active=='All'){
        //         $alldata = File::where('type','secondary_registration')->withTrashed()->get();
        //     }
        //     elseif($active=='Active'){
        //         $alldata = File::where('type','secondary_registration')->get();
        //     }
        //     elseif($active=='DeActive'){
        //         $alldata = File::where('type','secondary_registration')->onlyTrashed()->get();
        //     }
        // }else{

        //     $alldata = File::where('admin_id',$userId)->where('type','secondary_registration')->get();
        //     if($active=='All'){
        //         $alldata = File::withTrashed()->where('admin_id',$userId)->where('type','secondary_registration')->get();
        //     }
        //     elseif($active=='Active'){
        //         $alldata = File::where('admin_id',$userId)->where('type','secondary_registration')->get();
        //     }
        //     elseif($active=='DeActive'){
        //         $alldata = File::onlyTrashed()->where('admin_id',$userId)->where('type','secondary_registration')->get();
        //     }



        // }




        if($objAdmin->is_super == 1|| $objAdmin->position_id == 4|| $objAdmin->position_id == 3){

           // $alldata = StudentRegistration::
           // join('admins', 'student_registrations.admin_id', '=', 'admins.id')
           // ->select('student_registrations.admin_id','admins.group_name', \DB::raw('count(*) as registration_count'))
           // ->groupBy('student_registrations.admin_id','admins.group_name')
           // ->get();


           $alldata = StudentRegistration::
            join('admins', 'student_registrations.admin_id', '=', 'admins.id')
            ->select(
                'student_registrations.admin_id',
                'admins.group_name',
                \DB::raw('count(*) as registration_count'),
                \DB::raw("SUM(CASE WHEN student_registrations.type = 'approved' THEN 1 ELSE 0 END) as approved_count")
            )
            ->groupBy('student_registrations.admin_id', 'admins.group_name')
            ->get();


        
        }else{

           
            $alldata = StudentRegistration::
            where('student_registrations.admin_id',$userId)
           ->join('admins', 'student_registrations.admin_id', '=', 'admins.id')
           ->select(
                'student_registrations.admin_id',
                'admins.group_name',
                \DB::raw('count(*) as registration_count'),
                \DB::raw("SUM(CASE WHEN student_registrations.type = 'approved' THEN 1 ELSE 0 END) as approved_count")
            )
            ->groupBy('student_registrations.admin_id', 'admins.group_name')
            ->get();
           

        }

        

        $alldataResult=array();

        foreach($alldata as $key=> $objdata){
            // $status = "معلقه";
            // if($objdata->status=='pending'){
            //     $status = "معلقه";
            // }elseif ($objdata->status=='approved') {
            //     $status = "<span style='color:green;font-weight:bold'>مقبول</span>" .  "<br><a target='_blank' href = '".url('admin/download_secondary_registration')."/".$objdata->id." '>تحميل  الشهادة</>";;

            //     if($objAdmin->is_super == 0){
 
            //         $status = "<a target='_blank' href = '".url('admin/download_secondary_registration')."/".$objdata->id." '>تحميل  الشهادة</>";
            //     }

            // }
            // elseif ($objdata->status=='rejected') {
            //     $status = "<span style='color:red;font-weight:bold'>مرفوض</span>";
            // }


            $alldataResult[] = array(
                "#" => $objdata->admin_id,
                "order" => $key+1,
                "id" => $objdata->admin_id,
                "leader" => @$objdata->group_name,
                "count" => @$objdata->registration_count,
                "approved_count"=> @$objdata->approved_count,
                //  "secondary_registration" => '
                // <a target="_blank" href="' . asset('public/images/files/' . $objdata->secondary_registration) . '">تحميل الملف<a>',
                // "year" => $objdata->year,
                // "status"=>$status,
                // "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
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



    public function ReportSecondaryRegistrations()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_secondary_registration');
        
        return view('auth.admin.secondary_registrations.report_secondary_registrations', [
            'title' => $title,
        ]);
    }



    public function ReportSecondaryRegistrationsGet()
    {
        

        
        $year = @$_GET['year'];
        $type = @$_GET['type'];

      
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       if($type == 'secondary_registration'){
            $title = __('messages.report_secondary_registration') . ' - ' . 'سنة ' .$year;
           
        }elseif ($type == 'administrative') {
            $title = __('messages.report_administrative') . ' - ' . 'سنة ' .$year;
        }elseif ($type == 'financial') {
            $title = __('messages.report_financial') . ' - ' . 'سنة ' .$year;
        }else{
            $title = __('messages.report_board_director_meetings') . ' - ' . 'سنة ' .$year;
        }
        


        return view('auth.admin.secondary_registrations.report_secondary_registrations_get', ['title' => $title,'year' => $year,'type' => $type]);
    }



    public function report_secondary_registrations_get_list(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            'order'   => true,
            'id'   => true,
            'name'   => true,
            'phone'   => true,
            'address'   => true,
            'email'   => true,
        
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }


        $alldata = Admin::where('is_super','!=',1);
        $alldata = $alldata->get();


         if($request->type == 'secondary_registration'){
            $title = __('messages.report_secondary_registration');
           
            $ArrAdminFilesID = File::where('type','secondary_registration')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);



        }elseif ($request->type == 'administrative') {
            $title = __('messages.report_administrative');

            $ArrAdminFilesID = File::where('type','administrative')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);
        }elseif ($request->type == 'financial') {
            $title = __('messages.report_financial');

            $ArrAdminFilesID = File::where('type','financial')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);
        }else{
            $title = __('messages.report_board_director_meeting');

            $ArrAdminFilesID = File::where('type','board_director_meetings')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);
        }



        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {


            $alldataResult[] = array(
                "order" => $key+1,
                "id" => $objdata->id,
                "name" => @$objdata->group_name,
                "phone" => @$objdata->phone,
                "address" => @$objdata->address,
                "email" => @$objdata->email,
               
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


    public function ExportSecondaryRegistrations(Request $request)
    {


        $fileName = 'export_secondary_registrations.csv';
        
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super == 1){

           $Files = File::where('type','secondary_registration')->get();
        
        }else{

            $Files = File::where('admin_id',$userId)->where('type','secondary_registration')->get();

        }
        
         

        // Set the response headers with the correct character encoding
        $headers = array(
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // If you need to display Arabic column header, make sure to encode it as well
        $columns = array(__('messages.scout_group'),'نموذج التسجيل','السنة');

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($Files, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            // Write the data rows
            foreach ($Files as $File) {
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['leader_name']  = $File->Admin->name;
                
                $row['secondary_registration']  =asset('public/images/files/' . $File->secondary_registration);

                $row['year']  = $File->year;

                $group_name = $File->Admin->group_name;
             

                // Write the row data to the CSV file
                fputcsv($file, array($group_name,$row['secondary_registration'],$row['year']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }







public function ReportArchiveSecondaryRegistrations()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = 'أرشيف  التسجيل السنوي';
        
        return view('auth.admin.secondary_registrations.report_archive_secondary_registrations', [
            'title' => $title,
        ]);
    }



    public function ReportArchiveSecondaryRegistrationsGet()
    {
        

        
        $year = @$_GET['year'];
        $type = @$_GET['type'];

      
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       if($type == 'secondary_registration_archive'){
            $title = 'أرشيف  التسجيل السنوي'  . ' - ' . 'سنة ' .$year;
        }elseif ($type == 'administrative_archive') {
            $title = 'أرشيف  الإداري للعام'  . ' - ' . 'سنة ' .$year;
        }elseif ($type == 'financial_archive'){
            $title = 'أرشيف  المالي للعام'  . ' - ' . 'سنة ' .$year;
        }else{
            $title = 'أرشيف  محاضر اجتماعات الهيئة العامة'  . ' - ' . 'سنة ' .$year;
        }
        


        return view('auth.admin.secondary_registrations.report_archive_secondary_registrations_get', ['title' => $title,'year' => $year,'type' => $type]);
    }



    public function report_archive_secondary_registrations_get_list(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'file'   => true,
            'year'   => true,
        
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }



        if($request->type == 'secondary_registration_archive'){
            $title = 'أرشيف التسجيل السنوي';
           
            $alldata = File::where('type','secondary_registration')->where('year',$request->year)->orderBy('id')->get();

        }elseif ($request->type == 'administrative_archive') {
           $title = 'الأرشيف الإداري للعام';
           
           $alldata = File::where('type','administrative')->where('year',$request->year)->get();
        }elseif ($request->type == 'financial_archive'){
            $title = 'الأرشيف المالي للعام';
           
            $alldata = File::where('type','financial')->where('year',$request->year)->get();
        }else{
            $title = 'أرشيف محاضر اجتماعات الهيئة العامة';
           
            $alldata = File::where('type','board_director_meetings')->where('year',$request->year)->get();
        }



        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {


            if($request->type == 'secondary_registration_archive'){
            $file ='
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->secondary_registration) . '">تحميل الملف<a>';
        

            }elseif ($request->type == 'administrative_archive') {
               $file ='
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->administrative_financial1) . '">تحميل الملف<a>';
               
            }elseif ($request->type == 'financial_archive'){
                $file ='
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->administrative_financial2) . '">تحميل الملف<a>';
               
            }else{
                $file ='
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->board_director_meetings) . '">تحميل الملف<a>';
               
            }


            $alldataResult[] = array(
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "file" => $file,
                "year" => $objdata->year,
               
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


    public function ExportArchiveSecondaryRegistrations(Request $request)
{


    $fileName = 'export_secondary_registrations.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    if($objAdmin->is_super == 1){

       $Files = File::where('type','secondary_registration')->get();
    
    }else{

        $Files = File::where('admin_id',$userId)->where('type','secondary_registration')->get();

    }
    
     

    // Set the response headers with the correct character encoding
    $headers = array(
        "Content-type"        => "text/csv; charset=utf-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    // If you need to display Arabic column header, make sure to encode it as well
    $columns = array(__('messages.scout_group'),'نموذج التسجيل','السنة');

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($Files, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($Files as $File) {
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['leader_name']  = $File->Admin->name;
            
            $row['secondary_registration']  =asset('public/images/files/' . $File->secondary_registration);

            $row['year']  = $File->year;
         

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['secondary_registration'],$row['year']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


public function accept_second_registration(Request $request, $id)
    {
         

        $objFile = File::find($id);
        $objFile->status = "approved";       
        $objFile->save();

        $this->logAction(auth()->id(), 'user', 'accept_'.$objFile->type, 'accepted', ' files', $objFile->id);

        $objUser = $objFile->Admin;

        if(!empty($objUser->email)){
            $recipient = $objUser->email;
            $subject = 'موافقه نموذج التسجيل';

            $data = ['content' => 'This is the email content.']; // Data to pass to the view

            $fromEmail = 'admin@tawasol.privatescouts.org'; 
            // The "from" email address

            Mail::send('emails.secondary_registrations', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                $mail->to($recipient)
                    ->from($fromEmail) // Set the "from" email address
                    ->subject($subject);
            });
        }
        


        // print_r($objUser); die;



        return redirect('/admin/secondary_registrations');

    }

    public function reject_second_registration(Request $request, $id)
    {
         

        $objFile = File::find($id);
        $objFile->status = "rejected";       
        $objFile->save();
        $this->logAction(auth()->id(), 'user', 'reject_'.$objFile->type, 'rejected', ' files', $objFile->id);
        return redirect('/admin/secondary_registrations');

    }


    public function download_secondary_registration($id)
    {
        $title = 'تحميل الشهاده' ;
        $objFile = File::find($id);


        // $title = "Hello";
        // $date = date('Y-m-d');
        // $clientName = "John Doe";
        // $lawyerName = "Jane Smith";
        // $transactions = [
        //     "Transaction 1",
        //     "Transaction 2",
        //     "Transaction 3"
        // ];

        // $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // $pdf->setPrintHeader(false); // Disable header
        // $pdf->SetFont('dejavusans', '', 12, '', false);
        // $pdf->AddPage();

        // $viewData = compact('objFile');
        // $html = view('auth.admin.secondary_registrations.download_secondary_registration', $viewData)->render();

        // $pdf->writeHTML($html);

        // $pdf->Output('filename.pdf', 'D');


        return view('auth.admin.secondary_registrations.download_secondary_registration',['title' => $title,'objFile'=>$objFile]);
    }


    public function total_secondary_registration_old()
    {
        $title = __('messages.total_secondary_registration');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        
        $alldata = Admin::where('admins.id',2)->join('files', 'files.admin_id', '=', 'admins.id')
            ->join('student_registrations', 'admins.id', '=', 'student_registrations.admin_id')
            ->select(
                'admins.secondary_registration_fees', 
                'files.year', 
                'admins.name',
                DB::raw('COUNT(student_registrations.id) as registration_count')
            )
            ->groupBy('admins.secondary_registration_fees', 'files.year', 'admins.name')
            ->get()
            ->map(function ($item) {
                // Calculate registration_price after retrieving data
                $item->registration_price = $item->secondary_registration_fees * $item->registration_count;
                return $item;
            });

          

        
        return view('auth.admin.secondary_registrations.total_secondary_registration',['title' => $title,'alldata'=>$alldata]);
    }




    public function total_secondary_registration()
    {
        $title = __('messages.total_secondary_registration');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();
        $Setup = Setup::first();

        $admin_id = '';


        if(!empty($_GET['admin_id']) ){
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


        $final_total_alrusum = ($total_alrusum_wehda_leaders + $total_alrusum_wehda_aliashbalu + $total_alrusum_wehda_alkashaaf + $total_alrusum_wehda_almutaqadima + $total_alrusum_wehda_aljawaluh);


        $objAdmin_group = Admin::find($admin_id);

        return view('auth.admin.secondary_registrations.total_secondary_registration',['title' => $title,'objAdmin'=>$objAdmin,'count_aliashbalu'=>$count_aliashbalu,'count_alkashaaf'=>$count_alkashaaf,'count_almutaqadima'=>$count_almutaqadima,'count_aljawaluh'=>$count_aljawaluh,'count_leaders'=>$count_leaders,'count_late_students'=>$count_late_students,'alrusum_wehda_aliashbalu'=>$alrusum_wehda_aliashbalu,'alrusum_wehda_alkashaaf'=>$alrusum_wehda_alkashaaf,'alrusum_wehda_almutaqadima'=>$alrusum_wehda_almutaqadima,'alrusum_wehda_aljawaluh'=>$alrusum_wehda_aljawaluh,'alrusum_wehda_leaders'=>$alrusum_wehda_leaders,'alrusum'=>$alrusum,'alrusum_late'=>$alrusum_late,'total_alrusum_late'=>$total_alrusum_late,'total_alrusum_wehda_leaders'=>$total_alrusum_wehda_leaders,'total_alrusum_wehda_aliashbalu'=>$total_alrusum_wehda_aliashbalu,'total_alrusum_wehda_alkashaaf'=>$total_alrusum_wehda_alkashaaf,'total_alrusum_wehda_almutaqadima'=>$total_alrusum_wehda_almutaqadima,'total_alrusum_wehda_aljawaluh'=>$total_alrusum_wehda_aljawaluh,'final_total_alrusum'=>$final_total_alrusum,'leaders'=>$leaders,'admin_id'=>$admin_id,'objAdmin_group'=>$objAdmin_group,'Setup'=>$Setup]);
    }


       public function get_totall_secondary_registration(Request $request)
    { 
        
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'year'=> true,
            'count'=>true,
            'price'=>true,
            'total_price'=>true,
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
        if($objAdmin->position_id == 1 || $objAdmin->position_id == 3 || $objAdmin->position_id == 4 || $objAdmin->position_id == 6){

           $alldata = Admin::join('files', 'files.admin_id', '=', 'admins.id')
            ->join('student_registrations', 'admins.id', '=', 'student_registrations.admin_id')
            ->select(
                'admins.secondary_registration_fees', 
                'files.year', 
                'admins.name',
                DB::raw('COUNT(student_registrations.id) as registration_count')
            )
            ->groupBy('admins.secondary_registration_fees', 'files.year', 'admins.name')
            ->get()
            ->map(function ($item) {
                // Calculate registration_price after retrieving data
                $item->registration_price = $item->secondary_registration_fees * $item->registration_count;
                return $item;
            });
        
        }else{

            $alldata = Admin::where('admins.id', $objAdmin->id)->join('files', 'files.admin_id', '=', 'admins.id')
            ->join('student_registrations', 'admins.id', '=', 'student_registrations.admin_id')
            ->select(
                'admins.secondary_registration_fees', 
                'files.year', 
                'admins.name',
                DB::raw('COUNT(student_registrations.id) as registration_count')
            )
            ->groupBy('admins.secondary_registration_fees', 'files.year', 'admins.name')
            ->get()
            ->map(function ($item) {
                // Calculate registration_price after retrieving data
                $item->registration_price = $item->secondary_registration_fees * $item->registration_count;
                return $item;
            });
            



        }

        $alldataResult=array();

        foreach($alldata as $key=> $objdata){

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->name,
                "year" => $objdata->year,
                "count" => $objdata->registration_count,
                "price"=> @$objdata->secondary_registration_fees,
                "total_price"=> @$objdata->registration_price,
                "created_at" => Date('Y-m-d',strtotime($objdata->created_at)),
            );
        }

       $alldata =$alldataResult ;
        $data = [];
        // internal use; filter selected columns only from raw data
        foreach ( $alldata as $d ) {
            $data[] = $this->filterArrayTotal( $d, $columnsDefault );
        }

        // count data
        $totalRecords = $totalDisplay = count( $data );

        // filter by general search keyword
        if ( isset( $request->search ) ) {
            $data         =  $this->filterKeywordTotal( $data, $request->search );
            $totalDisplay = count( $data );
        }

        if ( isset( $request->columns ) && is_array( $request->columns ) ) {
            foreach ( $request->columns as $column ) {
                if ( isset( $column['search'] ) ) {
                    $data         =  $this->filterKeywordTotal( $data, $column['search'], $column['data'] );
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

    function filterArrayTotal( $array, $allowed = [] ) {
        return array_filter(
            $array,
            function ( $val, $key ) use ( $allowed ) { // N.b. $val, $key not $key, $val
                return isset( $allowed[ $key ] ) && ( $allowed[ $key ] === true || $allowed[ $key ] === $val );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    function filterKeywordTotal( $data, $search, $field = '' ) {
        $filter = '';
        if ( isset( $search['value'] ) ) {
            $filter = $search['value'];
        }
        if ( ! empty( $filter ) ) {
            if ( ! empty( $field ) ) {
                if ( strpos( strtolower( $field ), 'date' ) !== false ) {
                    // filter by date range
                    $data = filterByDateRangeTotal( $data, $filter, $field );
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

    function filterByDateRangeTotal( $data, $filter, $field ) {
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

}
