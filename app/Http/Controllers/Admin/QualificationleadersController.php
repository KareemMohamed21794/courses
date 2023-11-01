<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QualificationLeader;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use PDF;
use TCPDF;
use Carbon\Carbon;

class QualificationleadersController extends Controller
{
    private const MODEL ='QualificationLeader';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.qualification_leaders');
        $add_title = __('messages.qualification_leader');
        $leaders = Admin::where('is_super',0)->get();

        return view('auth.admin.qualification_leaders.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders]);
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
            'leader_name' => ['required', 'string', 'max:255'],
            'current_qualification' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

       
        $userId = Auth::id();

        $QualificationLeader = QualificationLeader::create([
            'leader_name' =>  $request->leader_name,
            'current_qualification' =>  $request->current_qualification,
            'study_history_mqw' =>  $request->study_history_mqw,
            'place_study_mqw' =>  $request->place_study_mqw,
            'organizer_mqw' =>  $request->organizer_mqw,
            'rent_date_mqw' =>  $request->rent_date_mqw,
            'rent_number_mqw' =>  $request->rent_number_mqw,
            'study_history_qw' =>  $request->study_history_qw,
            'place_study_qw' =>  $request->place_study_qw,
            'organizer_qw' =>  $request->organizer_qw,
            'rent_date_qw' =>  $request->rent_date_qw,
            'rent_number_qw' =>  $request->rent_number_qw,
            'study_history_mqt' =>  $request->study_history_mqt,
            'place_study_mqt' =>  $request->place_study_mqt,
            'organizer_mqt' =>  $request->organizer_mqt,
            'rent_date_mqt' =>  $request->rent_date_mqt,
            'rent_number_mqt' =>  $request->rent_number_mqt,
            'study_history_qt' =>  $request->study_history_qt,
            'place_study_qt' =>  $request->place_study_qt,
            'organizer_qt' =>  $request->organizer_qt,
            'rent_date_qt' =>  $request->rent_date_qt,
            'rent_number_qt' =>  $request->rent_number_qt,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            
        ]);

        return response()->json(['QualificationLeader'=>$QualificationLeader]);
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
        $QualificationLeader  = QualificationLeader::find($id);
        @$QualificationLeader->Admin;
        return response()->json($QualificationLeader);
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
            'leader_name' => ['required', 'string', 'max:255'],
            'current_qualification' => ['required']
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

       
        $userId = Auth::id();
        $objQualificationLeader = QualificationLeader::find($id);
        $objQualificationLeader->admin_id = $request->leader_id ? $request->leader_id : $userId;
        $objQualificationLeader->leader_name =  $request->leader_name;
        $objQualificationLeader->current_qualification =  $request->current_qualification;
        $objQualificationLeader->study_history_mqw =  $request->study_history_mqw;
        $objQualificationLeader->place_study_mqw =  $request->place_study_mqw;
        $objQualificationLeader->organizer_mqw =  $request->organizer_mqw;
        $objQualificationLeader->rent_date_mqw =  $request->rent_date_mqw;
        $objQualificationLeader->rent_number_mqw =  $request->rent_number_mqw;
        $objQualificationLeader->study_history_qw =  $request->study_history_qw;
        $objQualificationLeader->place_study_qw =  $request->place_study_qw;
        $objQualificationLeader->organizer_qw =  $request->organizer_qw;
        $objQualificationLeader->rent_date_qw =  $request->rent_date_qw;
        $objQualificationLeader->rent_number_qw =  $request->rent_number_qw;
        $objQualificationLeader->study_history_mqt =  $request->study_history_mqt;
        $objQualificationLeader->place_study_mqt =  $request->place_study_mqt;
        $objQualificationLeader->organizer_mqt =  $request->organizer_mqt;
        $objQualificationLeader->rent_date_mqt =  $request->rent_date_mqt;
        $objQualificationLeader->rent_number_mqt =  $request->rent_number_mqt;
        $objQualificationLeader->study_history_qt =  $request->study_history_qt;
        $objQualificationLeader->place_study_qt =  $request->place_study_qt;
        $objQualificationLeader->organizer_qt =  $request->organizer_qt;
        $objQualificationLeader->rent_date_qt =  $request->rent_date_qt;
        $objQualificationLeader->rent_number_qt =  $request->rent_number_qt;
        
       
        $objQualificationLeader->save();
        return response()->json(['objQualificationLeader'=>$objQualificationLeader]);
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
        $QualificationLeader = QualificationLeader::where('id',$id)->delete();
        return response()->json(['QualificationLeader'=>$QualificationLeader]);
    }

     public function deletequalification_leaders(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $QualificationLeader = QualificationLeader::whereIn('id',$request->ids)->delete();
        return response()->json(['QualificationLeader'=>$QualificationLeader]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'leader'   => true,
            'leader_name'=> true,
            'current_qualification'=> true,
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

           $alldata = QualificationLeader::get();
        
            if($active=='All'){
                $alldata = QualificationLeader::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = QualificationLeader::get();
            }
            elseif($active=='DeActive'){
                $alldata = QualificationLeader::onlyTrashed()->get();
            }
        }else{

            $alldata = QualificationLeader::where('admin_id',$userId)->get();
            if($active=='All'){
                $alldata = QualificationLeader::withTrashed()->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = QualificationLeader::where('admin_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = QualificationLeader::onlyTrashed()->where('admin_id',$userId)->get();
            }



        }



        $alldataResult=array();

        foreach($alldata as $objdata){

            if($objdata->current_qualification == 'musaeid_qayid_wahdah'){
            $current_qualification = 'مساعد قائد وحده   ';
           }else if($objdata->current_qualification == 'qayid_wahda'){
            $current_qualification = 'قائد وحدة شارة خشبية   ';
           }else if($objdata->current_qualification == 'musaeid_qayid_tadrib'){
            $current_qualification = 'مساعد قائد تدريب';
           }else if($objdata->current_qualification == 'qayid_tadrib'){
            $current_qualification = 'قائد تدريب';
           }else{
            $current_qualification = 'غير مؤهل';
           }


            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "leader" => $objdata->Admin->group_name,
                "leader_name"=> $objdata->leader_name,
                "current_qualification"=> @$current_qualification,
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



    public function ReportQualificationLeaders()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_qualification_leaders');
        $leaders = Admin::where('is_super','!=',1)->get();
        return view('auth.admin.qualification_leaders.report_qualification_leaders', [
            'title' => $title,
            'leaders' => $leaders,
        ]);
    }



    public function ReportQualificationLeadersGet()
    {
        

        
        $leader_id = @$_GET['leader_id'];
        $current_qualification = @$_GET['current_qualification'];

      
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_qualification_leaders');

        return view('auth.admin.qualification_leaders.report_qualification_leaders_get', ['title' => $title,'leader_id' => $leader_id,'current_qualification' => $current_qualification]);
    }



    public function ReportQualificationLeadersGetlist(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            'id'   => true,
            'leader_name'   => true,
            'current_qualification'   => true,
        
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }


        $alldata = QualificationLeader::all();
       
        $title = __('messages.report_qualification_leaders');
        
        if($request->leader_id){
            $alldata = $alldata->where('admin_id',$request->leader_id);
        } 


        if($request->current_qualification){
            $alldata = $alldata->where('current_qualification',$request->current_qualification);
        } 

        




        $alldataResult = array();

        foreach ($alldata as $objdata) {
           if($objdata->current_qualification == 'musaeid_qayid_wahdah'){
            $current_qualification = 'مساعد قائد وحده   ';
           }else if($objdata->current_qualification == 'qayid_wahda'){
            $current_qualification = 'قائد وحدة شارة خشبية   ';
           }else if($objdata->current_qualification == 'musaeid_qayid_tadrib'){
            $current_qualification = 'مساعد قائد تدريب';
           }else if($objdata->current_qualification == 'qayid_tadrib'){
            $current_qualification = 'قائد تدريب';
           }else{
            $current_qualification = 'غير مؤهل';
           }
        


            $alldataResult[] = array(
                "id" => $objdata->id,
                "leader_name" => @$objdata->leader_name,
                "current_qualification" => @$current_qualification,
               
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



public function ExportQualificationLeaders(Request $request)
{


    $fileName = 'qualification_leaders.csv';
    $qualification_leaders = QualificationLeader::all();
    
        
        if($request->leader_id){
            $qualification_leaders = $qualification_leaders->where('admin_id',$request->leader_id);
        } 


        if($request->current_qualification){
            $qualification_leaders = $qualification_leaders->where('current_qualification',$request->current_qualification);
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
    $columns = array(__('messages.leader_name'),__('messages.current_qualification'),__('messages.study_history_mqw'),__('messages.place_study_mqw'),__('messages.organizer_mqw'),__('messages.rent_date_mqw'),__('messages.rent_number_mqw'),__('messages.study_history_qw'),__('messages.place_study_qw'),__('messages.organizer_qw'),__('messages.rent_date_qw'),__('messages.rent_number_qw'),__('messages.study_history_mqt'),__('messages.place_study_mqt'),__('messages.organizer_mqt'),__('messages.rent_date_mqt'),__('messages.rent_number_mqt'),__('messages.study_history_qt'),__('messages.place_study_qt'),__('messages.organizer_qt'),__('messages.rent_date_qt'),__('messages.rent_number_qt'));

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($qualification_leaders, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($qualification_leaders as $qualification_leader) {
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['leader_name']  = $qualification_leader->leader_name;
            
            if($qualification_leader->current_qualification == 'musaeid_qayid_wahdah'){
                $row['current_qualification']  = 'مساعد قائد وحده   ';
            }else if($qualification_leader->current_qualification == 'qayid_wahda'){
                $row['current_qualification']  = 'قائد وحدة شارة خشبية   ';
            }else if($qualification_leader->current_qualification == 'musaeid_qayid_tadrib'){
                $row['current_qualification']  = 'مساعد قائد تدريب';
            }else if($qualification_leader->current_qualification == 'qayid_tadrib'){
                $row['current_qualification']  = 'قائد تدريب';
            }else{
                $row['current_qualification']  = 'غير مؤهل';
            }

            $row['study_history_mqw']  = $qualification_leader->study_history_mqw;
            $row['place_study_mqw']  = $qualification_leader->place_study_mqw;
            $row['organizer_mqw']  = $qualification_leader->organizer_mqw;
            $row['rent_date_mqw']  = $qualification_leader->rent_date_mqw;
            $row['rent_number_mqw']  = $qualification_leader->rent_number_mqw;

            $row['study_history_qw']  = $qualification_leader->study_history_qw;
            $row['place_study_qw']  = $qualification_leader->place_study_qw;
            $row['organizer_qw']  = $qualification_leader->organizer_qw;
            $row['rent_date_qw']  = $qualification_leader->rent_date_qw;
            $row['rent_number_qw']  = $qualification_leader->rent_number_qw;

            $row['study_history_mqt']  = $qualification_leader->study_history_mqt;
            $row['place_study_mqt']  = $qualification_leader->place_study_mqt;
            $row['organizer_mqt']  = $qualification_leader->organizer_mqt;
            $row['rent_date_mqt']  = $qualification_leader->rent_date_mqt;
            $row['rent_number_mqt']  = $qualification_leader->rent_number_mqt;

            $row['study_history_qt']  = $qualification_leader->study_history_qt;
            $row['place_study_qt']  = $qualification_leader->place_study_qt;
            $row['organizer_qt']  = $qualification_leader->organizer_qt;
            $row['rent_date_qt']  = $qualification_leader->rent_date_qt;
            $row['rent_number_qt']  = $qualification_leader->rent_number_qt;
         

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['current_qualification'],$row['study_history_mqw'],$row['place_study_mqw'],$row['organizer_mqw'],$row['rent_date_mqw'],$row['rent_number_mqw'],$row['study_history_qw'],$row['place_study_qw'],$row['organizer_qw'],$row['rent_date_qw'],$row['rent_number_qw'],$row['study_history_mqt'],$row['place_study_mqt'],$row['organizer_mqt'],$row['rent_date_mqt'],$row['rent_number_mqt'],$row['study_history_qt'],$row['place_study_qt'],$row['organizer_qt'],$row['rent_date_qt'],$row['rent_number_qt']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}