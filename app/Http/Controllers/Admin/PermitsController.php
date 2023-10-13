<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permit;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;

class PermitsController extends Controller
{
    private const MODEL ='Permit';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.permits');
        $add_title = __('messages.permits');

        return view('auth.admin.permits.index',['title' => $title, 'add_title' => $add_title]);
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
            'activity_name' => ['required', 'string', 'max:255'],
            'nature_activity' => ['required'],
            'place_activity' => ['required', 'string', 'max:255'],
            'activity_history' => ['required'],
            'number_days' => ['required'],
            'alwahda' => ['required'],
            'activity_leader' => ['required', 'string', 'max:255'],
            'number_leader' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();

        $Permit = Permit::create([
            'activity_name' =>  $request->activity_name,
            'nature_activity' =>  $request->nature_activity,
            'activity_description' =>  $request->activity_description,
            'place_activity' =>  $request->place_activity,
            'activity_history' =>  $request->activity_history,
            'number_days' =>  $request->number_days,
            'alwahda' =>  $request->alwahda,
            'alwahda_description' =>  $request->alwahda_description,
            'activity_leader' =>  $request->activity_leader,
            'number_leader' =>  $request->number_leader,
            'admin_id' =>  $userId,
            
        ]);

        return response()->json(['Permit'=>$Permit]);
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
        $Permit  = Permit::find($id);

        return response()->json($Permit);
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
               'activity_name' => ['required', 'string', 'max:255'],
                'nature_activity' => ['required'],
                'place_activity' => ['required', 'string', 'max:255'],
                'activity_history' => ['required'],
                'number_days' => ['required'],
                'alwahda' => ['required'],
                'activity_leader' => ['required', 'string', 'max:255'],
                'number_leader' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $secondary_registration = '';



        $objPermit = Permit::find($id);

        $objPermit->activity_name =  $request->activity_name;
        $objPermit->nature_activity =  $request->nature_activity;
        $objPermit->activity_description =  $request->activity_description;
        $objPermit->place_activity =  $request->place_activity;
        $objPermit->activity_history =  $request->activity_history;
        $objPermit->number_days =  $request->number_days;
        $objPermit->alwahda =  $request->alwahda;
        $objPermit->alwahda_description =  $request->alwahda_description;
        $objPermit->activity_leader =  $request->activity_leader;
        $objPermit->number_leader =  $request->number_leader;
       
        $objPermit->save();
        return response()->json(['objPermit'=>$objPermit]);
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
        $Permit = Permit::where('id',$id)->delete();
        return response()->json(['Permit'=>$Permit]);
    }

     public function deletepermits(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Permit = Permit::whereIn('id',$request->ids)->delete();
        return response()->json(['Permit'=>$Permit]);
    }


    public function get(Request $request)
    {

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'activity_name'=> true,
            'place_activity' =>true,
            'activity_history' =>true,
            'activity_leader'=>true,
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

           $alldata = Permit::get();
        
            if($active=='All'){
                $alldata = Permit::withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = Permit::get();
            }
            elseif($active=='DeActive'){
                $alldata = Permit::onlyTrashed()->get();
            }
        }else{

            $alldata = Permit::where('admin_id',$userId)->get();
            if($active=='All'){
                $alldata = Permit::withTrashed()->where('admin_id',$userId)->get();
            }
            elseif($active=='Active'){
                $alldata = Permit::where('admin_id',$userId)->get();
            }
            elseif($active=='DeActive'){
                $alldata = Permit::onlyTrashed()->where('admin_id',$userId)->get();
            }



        }



        $alldataResult=array();

        foreach($alldata as $objdata){
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "activity_name"=> $objdata->activity_name,
                "place_activity" =>$objdata->place_activity,
                "activity_history" =>$objdata->activity_history,
                "activity_leader"=>$objdata->activity_leader,
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
