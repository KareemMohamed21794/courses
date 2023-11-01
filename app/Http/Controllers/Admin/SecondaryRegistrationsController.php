<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use PDF;
use TCPDF;
use Carbon\Carbon;

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
        $title = __('messages.secondary_registration');
        $add_title = __('messages.secondary_registration');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $exsistdata = File::where('admin_id',$userId)->where('type','secondary_registration')->where('year',date('Y'))->first();


        $leaders = Admin::where('is_super',0)->get();


        return view('auth.admin.secondary_registrations.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'exsistdata'=>$exsistdata,'leaders'=>$leaders]);
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
            $destinationPath = "images/files";
            $secondary_registration = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration);
        }

        $File = File::create([
            'secondary_registration' =>  $secondary_registration,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            'type' =>  'secondary_registration',
            'year' =>  $request->year,
        ]);

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
            $destinationPath = "images/files";
            $secondary_registration = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration);
            $objFile->secondary_registration = $secondary_registration;
            if($objFile->save()){
               @unlink("images/files/".$oldImage);
            }
        }
        $objFile->save();
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
        $File = File::where('id',$id)->delete();
        return response()->json(['File'=>$File]);
    }

     public function deleteSecondaryRegistrations(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $File = File::whereIn('id',$request->ids)->delete();
        return response()->json(['File'=>$File]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'leader'   => true,
            'secondary_registration'   => true,
            'year'   => true,
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
        if($objAdmin->is_super == 1){

           $alldata = File::where('type','secondary_registration')->get();
        
            if($active=='All'){
                $alldata = File::where('type','secondary_registration')->withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = File::where('type','secondary_registration')->get();
            }
            elseif($active=='DeActive'){
                $alldata = File::where('type','secondary_registration')->onlyTrashed()->get();
            }
        }else{

            $alldata = File::where('admin_id',$userId)->where('type','secondary_registration')->get();
            if($active=='All'){
                $alldata = File::withTrashed()->where('admin_id',$userId)->where('type','secondary_registration')->get();
            }
            elseif($active=='Active'){
                $alldata = File::where('admin_id',$userId)->where('type','secondary_registration')->get();
            }
            elseif($active=='DeActive'){
                $alldata = File::onlyTrashed()->where('admin_id',$userId)->where('type','secondary_registration')->get();
            }



        }



        $alldataResult=array();

        foreach($alldata as $objdata){
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "leader" => $objdata->Admin->group_name,
                 "secondary_registration" => '
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->secondary_registration) . '">download<a>',
                "year" => $objdata->year,
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
            $title = __('messages.report_secondary_registration');
           
        }elseif ($type == 'administrative_financial') {
            $title = __('messages.report_administrative_financial');
        }else{
            $title = __('messages.board_director_meeting');
        }
        


        return view('auth.admin.secondary_registrations.report_secondary_registrations_get', ['title' => $title,'year' => $year,'type' => $type]);
    }



    public function report_secondary_registrations_get_list(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
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



        }elseif ($request->type == 'administrative_financial') {
            $title = __('messages.report_administrative_financial');

            $ArrAdminFilesID = File::where('type','administrative_financial')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);
        }else{
            $title = __('messages.report_board_director_meeting');

            $ArrAdminFilesID = File::where('type','board_director_meetings')->where('year',$request->year)->pluck('admin_id')->toArray();

            $alldata = $alldata->whereNotIn('id',$ArrAdminFilesID);
        }



        $alldataResult = array();

        foreach ($alldata as $objdata) {


            $alldataResult[] = array(
                "id" => $objdata->id,
                "name" => @$objdata->name,
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
         

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['secondary_registration'],$row['year']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
