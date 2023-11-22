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


class AdministrativeFinancialReportsController extends Controller
{
    private const MODEL ='File';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {   

        //print_r($firstSegment = request()->segment(2)); die;
        $firstSegment = $firstSegment = request()->segment(2);
        if($firstSegment=='administrative')
        {
            $title = __('messages.administrative');
            $add_title = __('messages.administrative');
        }else{
            $title = __('messages.financial');
            $add_title = __('messages.financial');
        }
        
        

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $exsistdata = File::where('admin_id',$userId)->where('type','administrative_financial')->where('year',date('Y'))->first();

        $leaders = Admin::where('is_super',0)->get();

        return view('auth.admin.administrative_financial_reports.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'exsistdata'=>$exsistdata,'leaders'=>$leaders,'firstSegment'=>$firstSegment]);
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
            // 'administrative_financial1' => ['required'],
            // 'administrative_financial2' => ['required'],
            'year' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();

        if($request->leader_id){
           $userId = $request->leader_id;
        }

        $exsistdata = File::where('admin_id',$userId)->where('type','administrative_financial')->where('year',date('Y'))->first();
      
        if($exsistdata){
            return response()->json(["message" => "هذا السجل موجود من قبل"], Response::HTTP_BAD_REQUEST);

        }

        $administrative_financial1 = '';
        $administrative_financial2 = '';

         if(!empty($request->file('administrative_financial1'))){
            $file = $request->file('administrative_financial1');
            $destinationPath = "public/images/files";
            $administrative_financial1 = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_financial1);
        }


        if(!empty($request->file('administrative_financial2'))){
            $file = $request->file('administrative_financial2');
            $destinationPath = "public/images/files";
            $administrative_financial2 = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_financial2);
        }

        $File = File::create([
            'administrative_financial1' =>  $administrative_financial1,
            'administrative_financial2' =>  $administrative_financial2,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            'type' =>  $request->firstSegment,
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
                // 'administrative_financial1' => ['required'],
                // 'administrative_financial2' => ['required'],
                'year' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $administrative_financial1 = '';
        $administrative_financial2 = '';
        $userId = Auth::id();

        $objFile = File::find($id);
        $objFile->year = $request->year;
        $objFile->admin_id = $request->leader_id ? $request->leader_id : $userId;
        if(!empty($request->file('administrative_financial1'))){
            $oldImage = $objFile->administrative_financial1;
            $file = $request->file('administrative_financial1');
            $destinationPath = "public/images/files";
            $administrative_financial1 = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_financial1);
            $objFile->administrative_financial1 = $administrative_financial1;
            if($objFile->save()){
               @unlink("public/images/files/".$oldImage);
            }
        }


         if(!empty($request->file('administrative_financial2'))){
            $oldImage = $objFile->administrative_financial2;
            $file = $request->file('administrative_financial2');
            $destinationPath = "public/images/files";
            $administrative_financial2 = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_financial2);
            $objFile->administrative_financial2 = $administrative_financial2;
            if($objFile->save()){
               @unlink("public/images/files/".$oldImage);
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

     public function deleteAdministrativeFinancialReport(Request $request)
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
            'file'   => true,
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

        $type = $request->firstSegment;

        if($objAdmin->is_super == 1){

           
           $alldata = File::where('type',$type)->get();
        
            if($active=='All'){
                $alldata = File::where('type',$type)->withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = File::where('type',$type)->get();
            }
            elseif($active=='DeActive'){
                $alldata = File::where('type',$type)->onlyTrashed()->get();
            }
        }else{

            $alldata = File::where('admin_id',$userId)->where('type',$type)->get();
            if($active=='All'){
                $alldata = File::withTrashed()->where('admin_id',$userId)->where('type',$type)->get();
            }
            elseif($active=='Active'){
                $alldata = File::where('admin_id',$userId)->where('type',$type)->get();
            }
            elseif($active=='DeActive'){
                $alldata = File::onlyTrashed()->where('admin_id',$userId)->where('type',$type)->get();
            }



        }



        $alldataResult=array();

        $fileColumn = ($request->firstSegment == 'administrative') ? 'administrative_financial1' : 'administrative_financial2';
        
        foreach($alldata as $objdata){
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "file" => '
                <a target="_blank" href="' . asset('public/images/files/' . $objdata->$fileColumn) . '">download<a>',
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


    public function ReportAdministrative()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_administrative');
        
        return view('auth.admin.administrative_financial_reports.report_administrative', [
            'title' => $title,
        ]);
    }



    public function ReportFinancial()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_financial');
        
        return view('auth.admin.administrative_financial_reports.report_financial', [
            'title' => $title,
        ]);
    }



        public function ExportAdministrativeFinancial(Request $request)
{


    $fileName = 'export_administrative_financial.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    if($objAdmin->is_super == 1){

       $Files = File::where('type','administrative_financial')->get();
    
    }else{

        $Files = File::where('admin_id',$userId)->where('type','administrative_financial')->get();

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
    $columns = array(__('messages.scout_group'),' ملف التقرير الإداري',' ملف التقرير المالي','السنة');

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
            
            $row['administrative_financial1']  =asset('public/images/files/' . $File->administrative_financial1);

            $row['administrative_financial2']  =asset('public/images/files/' . $File->administrative_financial2);

            $row['year']  = $File->year;
         

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['administrative_financial1'],$row['administrative_financial2'],$row['year']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}




 public function ReportArchiveAdministrative()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = 'التقرير الإداري للعام';
        
        return view('auth.admin.administrative_financial_reports.report_archive_administrative', [
            'title' => $title,
        ]);
    }




     public function ReportArchiveFinancial()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = 'التقرير المالي للعام';
        
        return view('auth.admin.administrative_financial_reports.report_archive_financial', [
            'title' => $title,
        ]);
    }



}
