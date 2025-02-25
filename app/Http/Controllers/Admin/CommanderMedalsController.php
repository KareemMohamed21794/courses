<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommanderMedal;
use App\Models\Admin;
use App\Models\Setup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;

class CommanderMedalsController extends Controller
{
    private const MODEL ='CommanderMedal';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.commander_medals');
        $add_title = __('messages.commander_medals');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();
        $Setup = Setup::first();
        
        if($Setup && $Setup->commander_medal_date >= date('Y-m-d')){
            $check_date = true;
        }else{
            $check_date = false;
        }



        if($objAdmin->is_super == 0){
        CommanderMedal::where('admin_id', $objAdmin->id)
        ->update(['read' => 1]);
        
        }else{
        CommanderMedal::whereNotNull('id')->update(['read' => 1]);
         
        }


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->position_id == 1 ){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }


        if($objAdmin->position_id == 3){
            $can_add = 1;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 0;
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




        return view('auth.admin.commander_medals.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'leaders'=>$leaders,'check_date'=>$check_date,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print]);
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
            'document' => ['required'],
            'year' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }



        $Setup = Setup::first();
        
        if($Setup && $Setup->commander_medal_date >= date('Y-m-d')){
            $check_date = true;
        }else{
            $check_date = false;
        }

        if (!$check_date) {
            // Return an error response if $check_date is true
            return response()->json([
                'status' => 'error',
                'message' => 'تاريخ وسام  القائد منتهي  '
            ], 400); // Use 400 Bad Request or another appropriate status code
        }


        $userId = Auth::id();

        if($request->leader_id){
           $userId = $request->leader_id;
        }

       

        $document = '';

         if(!empty($request->file('document'))){
            $file = $request->file('document');
            $destinationPath = "public/images/commander_medals";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
        }

        

        $CommanderMedal = CommanderMedal::create([
            'document' =>  $document,
            'year' =>  $request->year,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
           
        ]);

        $this->logAction(auth()->id(), 'user', 'add_commander_medal', 'create', 'commander_medals', $CommanderMedal->id);

        return response()->json(['CommanderMedal'=>$CommanderMedal]);
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
        $CommanderMedal  = CommanderMedal::find($id);
        @$CommanderMedal->Admin;

        return response()->json($CommanderMedal);
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
        $CommanderMedal = CommanderMedal::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_commander_medal', 'delete', 'commander_medals', $id);
        return response()->json(['CommanderMedal'=>$CommanderMedal]);
    }

     public function deleteCommanderMedals(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $CommanderMedal = CommanderMedal::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_commander_medal', 'delete', 'commander_medals', $id);
        }
        return response()->json(['CommanderMedal'=>$CommanderMedal]);
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
            'document'   => true,
            'year'   => true,
            'status'=> true,
            'reject_notes'=> true,
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
        $year = date("Y");
        if($objAdmin->is_super == 1|| $objAdmin->position_id == 4|| $objAdmin->position_id == 3){

           $alldata = CommanderMedal::where('year',$year)->get();
        
            if($active=='All'){
                $alldata = CommanderMedal::withTrashed()->where('year',$year)->get();
            }
            elseif($active=='Active'){
                $alldata = CommanderMedal::where('year',$year)->get();
            }
            elseif($active=='DeActive'){
                $alldata = CommanderMedal::onlyTrashed()->where('year',$year)->get();
            }
        }else{

            $alldata = CommanderMedal::where('admin_id',$userId)->where('year',$year)->get();
            if($active=='All'){
                $alldata = CommanderMedal::withTrashed()->where('admin_id',$userId)->where('year',$year)->get();
            }
            elseif($active=='Active'){
                $alldata = CommanderMedal::where('admin_id',$userId)->where('year',$year)->get();
            }
            elseif($active=='DeActive'){
                $alldata = CommanderMedal::onlyTrashed()->where('admin_id',$userId)->where('year',$year)->get();
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
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "document" => '
                <a target="_blank" href="' . asset('public/images/commander_medals/' . $objdata->document) . '">تحميل الملف<a>',
                "year"=> $objdata->year,
                "status"=> $status,
                "reject_notes"=> $objdata->reject_notes,
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


   



    public function ExportCommanderMedal(Request $request)
    {


    $fileName = 'export_achievements_study_requirements.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    if($objAdmin->is_super == 1){

       $Files = CommanderMedal::get();
    
    }else{

        $Files = CommanderMedal::where('admin_id',$userId)->get();

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
    $columns = array(__('messages.scout_group'),'الملف');

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
            
            $row['document']  =asset('public/images/commander_medals/' . $File->document);

            $row['year']  = $File->year;

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['document'],$row['year']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    }


    public function reject_accept($status,$id)
    {
       
        $objCommanderMedal = CommanderMedal::find($id);
        $objCommanderMedal->status = $status;
        $objCommanderMedal->reject_notes = null;
        $objCommanderMedal->save();
        $this->logAction(auth()->id(), 'user', 'accept_commander_medal', 'accepted', 'commander_medals', $objCommanderMedal->id);
        return response()->json(['objCommanderMedal'=>$objCommanderMedal]);
    }



    public function RejectedCommanderMedal(Request $request)
    {
        
        $request_id = $request->request_id;
        $reject_notes = $request->reject_notes;
        $objCommanderMedal = CommanderMedal::find($request_id);
        $objCommanderMedal->status = 'rejected';
        $objCommanderMedal->reject_notes = $reject_notes;
        
        $objCommanderMedal->save();
        $this->logAction(auth()->id(), 'user', 'reject_commander_medal', 'rejected', 'commander_medals', $objCommanderMedal->id);
        return response()->json(['objCommanderMedal'=>$objCommanderMedal]);
    }



    public function ReportCommanderMedals()
    {
       $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_commander_medals_monzer');
        
        return view('auth.admin.commander_medals.report_commander_medals', [
            'title' => $title,
        ]);
    }



    public function ReportCommanderMedalsGet()
    {
        

        
        $year = @$_GET['year'];
        $type = @$_GET['type'];

      
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       
        $title = __('messages.report_commander_medals_monzer') . ' - ' . 'سنة ' .$year;
           


        return view('auth.admin.commander_medals.report_commander_medals_get', ['title' => $title,'year' => $year,'type' => $type]);
    }



    public function report_commander_medals_get_list(Request $request)
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
        
        $title = __('messages.report_commander_medals_monzer');
           
        $ArrAdminFilesID = CommanderMedal::where('year',$request->year)->pluck('admin_id')->toArray();

        $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);




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




    public function ReportArchiveCommanderMedals()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.archive_commander_medals_monzer');
        
        return view('auth.admin.commander_medals.report_archive_commander_medals', [
            'title' => $title,
        ]);
    }



    public function ReportArchiveCommanderMedalsGet()
    {
        

        
        $year = @$_GET['year'];
        $type = @$_GET['type'];

      
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       
        $title = __('messages.archive_commander_medals_monzer') . ' - ' . 'سنة ' .$year;
      


        return view('auth.admin.commander_medals.report_archive_commander_medals_get', ['title' => $title,'year' => $year,'type' => $type]);
    }



    public function report_archive_commander_medals_get_list(Request $request)
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



        
        $title = 'أرشيف التسجيل السنوي';
           
        $alldata = CommanderMedal::where('year',$request->year)->orderBy('id')->get();

        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {
           
            $file =
        


            $alldataResult[] = array(
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "file" => '<a target="_blank" href="' . asset('public/images/commander_medals/' . $objdata->document) . '">تحميل الملف<a>',
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





}