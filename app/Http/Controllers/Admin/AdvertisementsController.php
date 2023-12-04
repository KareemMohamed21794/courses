<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;

class AdvertisementsController extends Controller
{
    private const MODEL ='Advertisement';
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
            $title = __('messages.issued');
            $add_title = __('messages.issued');
        }else{
            $title = __('messages.advertisements');
            $add_title = __('messages.advertisement');
        }
        

        $leaders = Admin::where('is_super',0)->get();

        return view('auth.admin.advertisements.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders]);
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
            'description' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'group_type' => ['required'],
            'file' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();

        $arrGroups = array();

        if($request->group_type == 'kashfih'){

           $arrGroups =  Admin::where('group_classification','kashfih')->pluck('id')->toArray();

        }elseif($request->group_type == 'irshad'){

            $arrGroups =  Admin::where('group_classification','irshad')->pluck('id')->toArray();

        }elseif($request->group_type == 'all'){

            $arrGroups =  Admin::pluck('id')->toArray();
            
        }elseif($request->group_type == 'group_name'){

            $arrGroups =  $request->admin_id ? $request->admin_id : array();
            
        }


         $document = '';

         if(!empty($request->file('file'))){
            $file = $request->file('file');
            $destinationPath = "public/images/advertisements";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
        }


        $Advertisement = array();
        
        foreach ($arrGroups as $key => $objGroup) {
            $Advertisement = Advertisement::create([
            'admin_id' =>  $objGroup,
            'group_type' =>  $request->group_type,
            'file' =>  $document,
            'file_name' =>  $request->file_name,
            'description' =>  $request->description,
            ]);
        }
        


        return response()->json(['Advertisement'=>$Advertisement]);
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
        $Advertisement  = Advertisement::find($id);
        @$Advertisement->Admin;

        return response()->json($Advertisement);
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
               'description' => ['required', 'string', 'max:255'],
                'file_name' => ['required', 'string', 'max:255'],
                'file' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $document = '';
        $userId = Auth::id();


        $objAdvertisement = Advertisement::find($id);
        $objAdvertisement->description = $request->description;
        $objAdvertisement->file_name = $request->file_name;
        if(!empty($request->file('file'))){
            $oldImage = $objAdvertisement->file;
            $file = $request->file('file');
            $destinationPath = "public/images/advertisements";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
            $objAdvertisement->file = $document;
            if($objAdvertisement->save()){
               @unlink("public/images/advertisements/".$oldImage);
            }
        }

        $objAdvertisement->save();
        return response()->json(['objAdvertisement'=>$objAdvertisement]);
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
        $Advertisement = Advertisement::where('id',$id)->delete();
        return response()->json(['Advertisement'=>$Advertisement]);
    }

     public function deleteadvertisements(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Advertisement = Advertisement::whereIn('id',$request->ids)->delete();
        return response()->json(['Advertisement'=>$Advertisement]);
    }


    public function get(Request $request)
    { 

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'admin_id'   => true,
            'file'=> true,
            'file_name'=>true,
            'description'=>true,
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

           $alldata = Advertisement::get();
        
            if($active=='All'){
                $alldata = Advertisement::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = Advertisement::get();
            }
            elseif($active=='DeActive'){
                $alldata = Advertisement::onlyTrashed()->get();
            }
        }else{

            $alldata = Advertisement::where('admin_id',$userId)->get();
            if($active=='All'){
                $alldata = Advertisement::withTrashed()->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = Advertisement::where('admin_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = Advertisement::onlyTrashed()->where('admin_id',$userId)->get();
            }



        }

        $alldataResult=array();
 
        foreach($alldata as $objdata){
          
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "admin_id" => @$objdata->Admin->group_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/advertisements/' . $objdata->file) . '">download<a>',
                "file_name"=> $objdata->file_name,
                "description"=> $objdata->description,
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




    public function ExportAdvertisements(Request $request)
    {


        $fileName = 'export_advertisements.csv';
        
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super == 1){

           $Advertisements = Advertisement::get();
        
        }else{

            $Advertisements = Advertisement::where('admin_id',$userId)->get();

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
        $columns = array(__('messages.scout_group'),'الملف','اسم الملف' ,'الشرح');

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($Advertisements, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            // Write the data rows
            foreach ($Advertisements as $Advertisement) {
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['admin_id']  = $Advertisement->Admin->group_name;
                
                $row['file']  =asset('public/images/advertisements/' . $Advertisement->file);

                $row['file_name']  = $Advertisement->file_name;

                $row['description']  = $Advertisement->description;
             

                // Write the row data to the CSV file
                fputcsv($file, array($row['admin_id'],$row['file'],$row['file_name'],$row['description']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
