<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizingStudy;
use App\Models\OrganizingStudieSeparate;
use App\Models\OrganizingStudieFile;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;
use Lang;
use DB;
use Illuminate\Support\Facades\Mail;
class OrganizingStudiesController extends Controller
{
    private const MODEL ='OrganizingStudy';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        
        $title = __('messages.organizing_study');
        $add_title = __('messages.organizing_study');
        

        $leaders = Admin::where('is_super',0)->get();

        if($objAdmin->is_super == 0){
        OrganizingStudy::where('admin_id', $objAdmin->id)
        ->update(['read' => 1]);
        
        }else{
        OrganizingStudy::whereNotNull('id')->update(['read' => 1]);
         
        }


        return view('auth.admin.organizing_study.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders]);

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
       
        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '20000M');
        set_time_limit(0);


        DB::beginTransaction(); // Start a database transaction
        $validator = Validator::make($request->all(),[
            'support_group' => ['required'],
            'study_place' => ['required', 'string', 'max:255'],
            'practical_place' => ['required', 'string', 'max:255'],
            'proposed_time_study' => ['required'],
            'type_qualification' => ['required', 'string', 'max:255'],
            'maximum_number_students' => ['required'],
            'proposed_study_supervisor' => ['required', 'string', 'max:255'],
            'qualification_study_supervisor' => ['required', 'string', 'max:255'],
            'proposed_study_leader' => ['required', 'string', 'max:255'],
            'qualification_study_leader' => ['required', 'string', 'max:255'],
            'list_supervisor' => ['required', 'string', 'max:255'],
            //'file' => ['required'],
            
        ]);


        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();
        
        $OrganizingStudy = OrganizingStudy::create([
        'admin_id' =>  $userId,
        'support_group' =>  $request->support_group,
        'study_place' =>  $request->study_place,
        'study_location' =>  $request->study_location,
        'practical_place' =>  $request->practical_place,
        'practical_location' =>  $request->practical_location,
        'proposed_time_study' =>  $request->proposed_time_study,
        'connected_from' =>  $request->connected_from,
        'connected_to' =>  $request->connected_to,
        'type_qualification' =>  $request->type_qualification,
        'maximum_number_students' =>  $request->maximum_number_students,
        'proposed_study_supervisor' =>  $request->proposed_study_supervisor,
        'qualification_study_supervisor' =>  $request->qualification_study_supervisor,
        'vacation_number_supervisor' =>  $request->vacation_number_supervisor,
        'proposed_study_leader' =>  $request->proposed_study_leader,
        'qualification_study_leader' =>  $request->qualification_study_leader,
        'vacation_number_leader' =>  $request->vacation_number_leader,
        'list_supervisor' =>  $request->list_supervisor,
        ]);

        $separate_date = $request->separate_date;

        if(count($request->separate_day) > 0 && $request->proposed_time_study =='separate' ){
            foreach ($request->separate_day as $key => $separate_day) {

                $OrganizingStudieSeparate = new OrganizingStudieSeparate();
                $OrganizingStudieSeparate->organizing_studies_id = $OrganizingStudy->id;
                $OrganizingStudieSeparate->day = $separate_day;
                $OrganizingStudieSeparate->date = $separate_date[$key];
                $OrganizingStudieSeparate->save();
            }
        }

       
        if($request->documents){
            foreach ($this->upload('images/organizing_study_files', ['documents']) as $file) {
        $OrganizingStudieFile = new OrganizingStudieFile();
        $OrganizingStudieFile->organizing_studies_id = $OrganizingStudy->id;
        $OrganizingStudieFile->file = $file;
        $OrganizingStudieFile->save();
        }
        }
        
 
        DB::commit(); // Commit the transaction
        return response()->json(['OrganizingStudy'=>$OrganizingStudy]);
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
        $OrganizingStudy  = OrganizingStudy::find($id);
        @$OrganizingStudy->Admin;
        @$OrganizingStudy->OrganizingStudieSeparate;
        return response()->json($OrganizingStudy);
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

        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '20000M');
        set_time_limit(0);


        DB::beginTransaction(); // Start a database transaction
       
            $validator = Validator::make($request->all(),[
            'support_group_update' => ['required'],
            'study_place' => ['required', 'string', 'max:255'],
            'practical_place' => ['required', 'string', 'max:255'],
            'proposed_time_study' => ['required'],
            'type_qualification' => ['required', 'string', 'max:255'],
            'maximum_number_students' => ['required'],
            'proposed_study_supervisor' => ['required', 'string', 'max:255'],
            'qualification_study_supervisor' => ['required', 'string', 'max:255'],
            'proposed_study_leader' => ['required', 'string', 'max:255'],
            'qualification_study_leader' => ['required', 'string', 'max:255'],
            'list_supervisor' => ['required', 'string', 'max:255'],
                
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $document = '';
        $userId = Auth::id();


        $objOrganizingStudy = OrganizingStudy::find($id);
        $objOrganizingStudy->support_group = $request->support_group_update;
        $objOrganizingStudy->study_place = $request->study_place;
        $objOrganizingStudy->study_location = $request->study_location;
        $objOrganizingStudy->practical_place = $request->practical_place;
        $objOrganizingStudy->practical_location = $request->practical_location;
        $objOrganizingStudy->proposed_time_study = $request->proposed_time_study;
        $objOrganizingStudy->connected_from = $request->connected_from;
        $objOrganizingStudy->connected_to = $request->connected_to;
        $objOrganizingStudy->type_qualification = $request->type_qualification;
        $objOrganizingStudy->maximum_number_students = $request->maximum_number_students;
        $objOrganizingStudy->proposed_study_supervisor = $request->proposed_study_supervisor;
        $objOrganizingStudy->qualification_study_supervisor = $request->qualification_study_supervisor;
        $objOrganizingStudy->vacation_number_supervisor = $request->vacation_number_supervisor;
        $objOrganizingStudy->proposed_study_leader = $request->proposed_study_leader;
        $objOrganizingStudy->qualification_study_leader = $request->qualification_study_leader;
        $objOrganizingStudy->vacation_number_leader = $request->vacation_number_leader;
        $objOrganizingStudy->list_supervisor = $request->list_supervisor;
       
        // if(!empty($request->file('file'))){
        //     $oldImage = $objOrganizingStudy->file;
        //     $file = $request->file('file');
        //     $destinationPath = "public/images/organizing_study";
        //     $document = rand().time().'.'.$file->getClientOriginalExtension();
        //     $file->move($destinationPath, $document);
        //     $objOrganizingStudy->file = $document;
        //     if($objOrganizingStudy->save()){
        //        @unlink("public/images/organizing_study/".$oldImage);
        //     }
        // }

        $objOrganizingStudy->save();

        /// delete days 
       OrganizingStudieSeparate::where('organizing_studies_id',$objOrganizingStudy->id)->delete();

        ///add days 

        $separate_date = $request->separate_date;

        if(count($request->separate_day) > 0 && $request->proposed_time_study =='separate' ){
            foreach ($request->separate_day as $key => $separate_day) {
                

                if($separate_day){
                   
                    $OrganizingStudieSeparate = new OrganizingStudieSeparate();
                    $OrganizingStudieSeparate->organizing_studies_id = $objOrganizingStudy->id;
                    $OrganizingStudieSeparate->day = $separate_day;
                    $OrganizingStudieSeparate->date = $separate_date[$key];
                    $OrganizingStudieSeparate->save();
                }

               
            }
        }

        DB::commit(); // Commit the transaction

        return response()->json(['objOrganizingStudy'=>$objOrganizingStudy]);
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
        OrganizingStudieSeparate::where('organizing_studies_id',$id)->delete();
        OrganizingStudieFile::where('organizing_studies_id',$id)->delete();
        $OrganizingStudy = OrganizingStudy::where('id',$id)->delete();
        return response()->json(['OrganizingStudy'=>$OrganizingStudy]);
    }

     public function deleteorganizing_study(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        OrganizingStudieSeparate::whereIn('organizing_studies_id',$request->ids)->delete();
        OrganizingStudieFile::whereIn('organizing_studies_id',$request->ids)->delete();
        $OrganizingStudy = OrganizingStudy::whereIn('id',$request->ids)->delete();
        return response()->json(['OrganizingStudy'=>$OrganizingStudy]);
    }


    public function get(Request $request)
    { 
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');

         

        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'study_place'=>true,
            'practical_place'=>true,
            'proposed_time_study'=> true,
            'maximum_number_students'=> true,
            'proposed_study_supervisor'=> true,
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
        if($objAdmin->is_super == 1){

           $alldata = OrganizingStudy::get();
        
            if($active=='All'){
                $alldata = OrganizingStudy::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = OrganizingStudy::get();
            }
            elseif($active=='DeActive'){
                $alldata = OrganizingStudy::onlyTrashed()->get();
            }
        }else{

            $alldata = OrganizingStudy::where('admin_id',$userId)->get();
            if($active=='All'){
                $alldata = OrganizingStudy::withTrashed()->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = OrganizingStudy::where('admin_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = OrganizingStudy::onlyTrashed()->where('admin_id',$userId)->get();
            }



        }

        $alldataResult=array();
 
        foreach($alldata as $key=> $objdata){

            $status = '';
            $proposed_time_study = "";

            if($objdata->status == 'rejected'){
              $status = 'مرفوض';  
            }elseif($objdata->status == 'approved'){
                $status = 'مقبول';
            }else{
                $status = 'قيد الانتظار';
            }

            if($objdata->proposed_time_study == 'connected'){
              $proposed_time_study = 'ايام متصله';  
            }else{
                $proposed_time_study = 'ايام منفصله';
            }

               $alldataResult[] = array(
                "order" => $key+1,
                "#" => $objdata->id,
                "id" => $objdata->id,
                
               "study_place"=> $objdata->study_place,
               "practical_place"=> $objdata->practical_place,
               "proposed_time_study"=> $proposed_time_study,
               "maximum_number_students"=> $objdata->maximum_number_students,
               "proposed_study_supervisor"=> $objdata->proposed_study_supervisor,
                "status"=> $status,
                "reject_notes"=> $objdata->reject_notes,
                "created_at" => Date('Y-m-d',strtotime($objdata->created_at)),
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




    public function ExportOrganizingStudy(Request $request)
   {
    $fileName = 'export_organizing_study.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    
    if ($objAdmin->is_super == 1) {
        $arrOrganizingStudy = OrganizingStudy::get();
        $columns = array(__('messages.scout_group'), 'الملف', 'اسم الملف', 'الشرح');
    } else {
        $arrOrganizingStudy = OrganizingStudy::where('admin_id', $userId)->get();
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
    $callback = function () use ($arrOrganizingStudy, $columns, $objAdmin) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($arrOrganizingStudy as $OrganizingStudy) {
            $row = array();

            if ($objAdmin->is_super == 1) {
                // Show group_name only for super admin
                $row['admin_id'] = $objOrganizingStudy->Admin->group_name;
            }

            $row['file'] = asset('public/images/organizing_study/' . $objOrganizingStudy->file);
            $row['file_name'] = $objOrganizingStudy->file_name;
            $row['description'] = $objOrganizingStudy->description;

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


   public function upload($folder = 'images/organizing_study_files', $keys = ['file'], $validation = 'mimes:jpeg,png,jpg,gif,bmp,pdf,docx,doc,csv,xlsx,xls,ppt,odt,ods,odp,svg|max:2048|sometimes')
    {
        $uploadedFiles = [];

        foreach ($keys as $key) {
            $files = request()->validate([$key . '.*' => $validation]);

            foreach (request()->file($key) as $index => $file) {
                if ($file->isValid()) {
                    $uploadedFiles[] = Storage::disk('public')->putFile($folder, $file, 'public');
                }
            }
        }

        return $uploadedFiles;
    }



  public function reject_accept_organizing($status,$id)
    {
       
        $objOrganizingStudy = OrganizingStudy::find($id);
        $objOrganizingStudy->status = $status;
        $objOrganizingStudy->reject_notes = null;
        $objOrganizingStudy->save();
        return response()->json(['objOrganizingStudy'=>$objOrganizingStudy]);
    }


    public function organizing_study_rejected(Request $request)
    {
        
        $request_id = $request->request_id;
        $reject_notes = $request->reject_notes;
        $objOrganizingStudy = OrganizingStudy::find($request_id);
        $objOrganizingStudy->status = 'rejected';
        $objOrganizingStudy->reject_notes = $reject_notes;
        
        $objOrganizingStudy->save();
        return response()->json(['objOrganizingStudy'=>$objOrganizingStudy]);
    }


    public function OrganizingStudyFiles($organizing_study_id)
    {
        
        $title = __('messages.organizing_study_files');
        $add_title = __('messages.organizing_study_files');
        $segment = 'organizing_study_files';
       
        
        return view('auth.admin.organizing_study.files',['title' => $title, 'organizing_study_id' => $organizing_study_id,'add_title'=>$add_title,'segment'=>$segment]);
    }


     public function getOrganizingStudyFiles(Request $request , $organizing_study_id)
    {
       
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'file'   => true,
            'created_at'   => true,
        ];
        
        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }
        
        $active = $request->active;

        $alldata = OrganizingStudieFile::where('organizing_studies_id',$organizing_study_id)->get();

        if($active=='All'){
            $alldata = OrganizingStudieFile::withTrashed()->where('organizing_studies_id',$organizing_study_id)->get();
        }
        elseif($active=='Active'){
            $alldata = OrganizingStudieFile::where('organizing_studies_id',$organizing_study_id)->get();
        }
        elseif($active=='DeActive'){
            $alldata = OrganizingStudieFile::onlyTrashed()->where('organizing_studies_id',$organizing_study_id)->get();
        }
        
 
        $alldataResult=array();

        foreach($alldata as $objdata){

            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "file" => '
                <a target="_blank" href="' . asset('storage/app/public/' . $objdata->file) . '">download<a>',
                "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
            );
        }
 
         
       // dd($alldataResult);
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



      public function SaveOrganizingStudyFiles(Request $request , $organizing_study_id)
    {
        $rules = [
            'file' => ['required'],
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


       foreach ($this->upload('images/organizing_study_files', ['file']) as $file) {
        $OrganizingStudieFile = new OrganizingStudieFile();
        $OrganizingStudieFile->organizing_studies_id = $organizing_study_id;
        $OrganizingStudieFile->file = $file;
        $OrganizingStudieFile->save();
        }

        return response()->json(['OrganizingStudieFile'=>$OrganizingStudieFile]);
    }



     public function deleteOrganizingStudyFiles($id)
    {
        $OrganizingStudieFile = OrganizingStudieFile::where('id',$id)->delete();
        return response()->json(['OrganizingStudieFile'=>$OrganizingStudieFile]);
    }

    public function deleteSelectedOrganizingStudyFiles(Request $request)
    {
        
        $OrganizingStudieFile = OrganizingStudieFile::whereIn('id',$request->ids)->delete();
        return response()->json(['OrganizingStudieFile'=>$OrganizingStudieFile]);
    }
}
