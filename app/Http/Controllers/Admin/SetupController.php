<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setup;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;


class SetupController extends Controller
{
    private const MODEL ='Setup';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.setup');
        $add_title = __('messages.setup');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        $count = Setup::count();


        return view('auth.admin.setup.index',['title' => $title, 'add_title' => $add_title,'objAdmin'=>$objAdmin,'count'=>$count]);
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
            'dead_line' => ['required'],
            'commander_medal_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $secondary_registration_file = '';
        $administrative_file = '';
        $financial_file = '';
        $board_director_meeting_file = '';
        $commander_medal_file = '';
        $achievement_study_requirement_file = '';


        if(!empty($request->file('secondary_registration_file'))){
            $file = $request->file('secondary_registration_file');
            $destinationPath = "public/images/setup";
            $secondary_registration_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration_file);
        }


        if(!empty($request->file('administrative_file'))){
            $file = $request->file('administrative_file');
            $destinationPath = "public/images/setup";
            $administrative_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_file);
        }


        if(!empty($request->file('financial_file'))){
            $file = $request->file('financial_file');
            $destinationPath = "public/images/setup";
            $financial_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $financial_file);
        }


        if(!empty($request->file('board_director_meeting_file'))){
            $file = $request->file('board_director_meeting_file');
            $destinationPath = "public/images/setup";
            $board_director_meeting_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $board_director_meeting_file);
        }



        if(!empty($request->file('commander_medal_file'))){
            $file = $request->file('commander_medal_file');
            $destinationPath = "public/images/setup";
            $commander_medal_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $commander_medal_file);
        }

        if(!empty($request->file('achievement_study_requirement_file'))){
            $file = $request->file('achievement_study_requirement_file');
            $destinationPath = "public/images/setup";
            $achievement_study_requirement_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $achievement_study_requirement_file);
        }


        $Setup = Setup::create([
            'dead_line' =>  $request->dead_line,
            'commander_medal_date' =>  $request->commander_medal_date ,
            'secondary_registration_file' =>  $destinationPath.'/'.$secondary_registration_file ,
            'administrative_file' =>  $destinationPath.'/'.$administrative_file ,
            'financial_file' =>  $destinationPath.'/'.$financial_file,
            'board_director_meeting_file' =>  $destinationPath.'/'.$board_director_meeting_file ,
            'commander_medal_file' =>  $destinationPath.'/'.$commander_medal_file ,
            'achievement_study_requirement_file' =>  $destinationPath.'/'.$achievement_study_requirement_file ,
           
        ]);


        $this->logAction(auth()->id(), 'user', 'add_setup', 'create', 'setup', $Setup->id);

        return response()->json(['Setup'=>$Setup]);
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
        $Setup  = Setup::find($id);

        return response()->json($Setup);
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
            'dead_line' => ['required'],
            'commander_medal_date' => ['required'],
        ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $secondary_registration_file = '';
        $administrative_file = '';
        $financial_file = '';
        $board_director_meeting_file = '';
        $commander_medal_file = '';
        $achievement_study_requirement_file = '';

        $objSetup = Setup::find($id);
       
        $objSetup->dead_line =  $request->dead_line;
        $objSetup->commander_medal_date =  $request->commander_medal_date;

        if(!empty($request->file('secondary_registration_file'))){
            $oldImage = $objSetup->secondary_registration_file;
            $file = $request->file('secondary_registration_file');
            $destinationPath = "public/images/setup";
            $secondary_registration_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $secondary_registration_file);
            $objSetup->secondary_registration_file = $destinationPath.'/'.$secondary_registration_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }


        if(!empty($request->file('administrative_file'))){
            $oldImage = $objSetup->administrative_file;
            $file = $request->file('administrative_file');
            $destinationPath = "public/images/setup";
            $administrative_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $administrative_file);
            $objSetup->administrative_file = $destinationPath.'/'.$administrative_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }


        if(!empty($request->file('financial_file'))){
            $oldImage = $objSetup->financial_file;
            $file = $request->file('financial_file');
            $destinationPath = "public/images/setup";
            $financial_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $financial_file);
            $objSetup->financial_file = $destinationPath.'/'.$financial_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }


        if(!empty($request->file('board_director_meeting_file'))){
            $oldImage = $objSetup->board_director_meeting_file;
            $file = $request->file('board_director_meeting_file');
            $destinationPath = "public/images/setup";
            $board_director_meeting_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $board_director_meeting_file);
            $objSetup->board_director_meeting_file = $destinationPath.'/'.$board_director_meeting_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }


        if(!empty($request->file('commander_medal_file'))){
            $oldImage = $objSetup->commander_medal_file;
            $file = $request->file('commander_medal_file');
            $destinationPath = "public/images/setup";
            $commander_medal_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $commander_medal_file);
            $objSetup->commander_medal_file = $destinationPath.'/'.$commander_medal_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }


        if(!empty($request->file('achievement_study_requirement_file'))){
            $oldImage = $objSetup->achievement_study_requirement_file;
            $file = $request->file('achievement_study_requirement_file');
            $destinationPath = "public/images/setup";
            $achievement_study_requirement_file = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $achievement_study_requirement_file);
            $objSetup->achievement_study_requirement_file = $destinationPath.'/'.$achievement_study_requirement_file;
            if($objSetup->save()){
               @unlink("public/images/setup/".$oldImage);
            }
        }
        
        $objSetup->save();

        $this->logAction(auth()->id(), 'user', 'update_setup', 'update', 'setup', $objSetup->id);
        return response()->json(['objSetup'=>$objSetup]);
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
        $Setup = Setup::where('id',$id)->delete();
        return response()->json(['Setup'=>$Setup]);
    }

     public function deleteSetup(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Setup = Setup::whereIn('id',$request->ids)->delete();
        return response()->json(['Setup'=>$Setup]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'dead_line'   => true,
            'commander_medal_date'   => true,
            'secondary_registration_file'=> true,
            'administrative_file'=> true,
            'financial_file'=> true,
            'board_director_meeting_file'=> true,
            'commander_medal_file'=> true,
            'achievement_study_requirement_file'=> true,
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
       

           $alldata = Setup::get();
        
            if($active=='All'){
                $alldata = Setup::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = Setup::get();
            }
            elseif($active=='DeActive'){
                $alldata = Setup::onlyTrashed()->get();
            }
        



        $alldataResult=array();

        foreach($alldata as $key=> $objdata){
            
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "dead_line" => $objdata->dead_line,
                "commander_medal_date"=> $objdata->commander_medal_date,
                "secondary_registration_file" => '
                <a target="_blank" href="' . asset($objdata->secondary_registration_file) . '">تحميل  نموذج التسجيل السنوي<a>',
                "administrative_file" => '
                <a target="_blank" href="' . asset($objdata->administrative_file) . '">تحميل نموذج الاداري السنوي<a>',
                "financial_file" => '
                <a target="_blank" href="' . asset($objdata->financial_file) . '">تحميل نموذج المالي السنوي<a>',
                "board_director_meeting_file" => '
                <a target="_blank" href="' . asset($objdata->board_director_meeting_file) . '">تحميل نموذج  اجتماعات الهيئه العامه<a>',
                "commander_medal_file" => '
                <a target="_blank" href="' . asset($objdata->commander_medal_file) . '">تحميل نموذج وسام القائد منذر<a>',

                "achievement_study_requirement_file" => '
                <a target="_blank" href="' . asset($objdata->achievement_study_requirement_file) . '">تحميل نموذج انجازات متطلبات دراسه<a>',
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


   
}

