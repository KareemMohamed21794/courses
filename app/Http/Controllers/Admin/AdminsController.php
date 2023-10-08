<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\Problem;
use Illuminate\Http\Request;
use App\Models\Admin;
//use Response;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use Illuminate\Support\Facades\DB;
class AdminsController extends Controller
{
    private const MODEL ='Admin';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(self::MODEL.'-viewAny');
        $departments = Department::all();
        $positions = Position::all();
        $lawyers = Admin::where('position_id',2)->get();

        $segment = $request->segment(2);

        $add_title = "";
        $department_id = 1;
        $position_id = 1;
        $is_super = 1;
        if($segment=='admins'){
            $title = __('messages.Admins');
            $add_title = __('messages.Admin');
            $department_id = 1;
            $position_id = 1;
            $is_super = 1;
            
        }
        elseif($segment=='lawyers'){
            $title = __('messages.lawyers');
            $add_title = __('messages.lawyer');
            $department_id = 2;
            $position_id = 2;
            $is_super = 0;
        }

        elseif($segment=='secretariats'){
            $title = __('messages.secretariats');
            $add_title = __('messages.secretariat');
            $department_id = 3;
            $position_id = 3;
            $is_super = 0;
        }

        

        return view('auth.admin.admins.index',['title' => $title, 'departments' => $departments, 'positions' => $positions, 'segment' => $segment , 'add_title' => $add_title, 'department_id' => $department_id, 'position_id' => $position_id, 'is_super' => $is_super, 'lawyers' => $lawyers]);
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
        $this->authorize(self::MODEL.'-store');
         // print_r('here'); die;
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'department_id' => ['required', 'integer'],
            'position_id' => ['required', 'integer'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'position_id' => $request->position_id,
            'password' => Hash::make($request->password),
            'is_super' => $request->select_is_super,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json(['admin'=>$admin]);
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
        $this->authorize(self::MODEL.'-update');
        $Admin  = Admin::find($id);
        @$Admin->position->department;

        return response()->json($Admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $Admin)
    {
        $this->authorize(self::MODEL.'-update');
        if(empty($request->password)){
               $validator = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'username' => 'required|max:255|unique:admins,username,'.$Admin->id.',id',
                // 'email' => ['required', 'string', 'email', 'max:255','unique:admins,email,'.Auth::guard('admin')->id().',id'],
                'email' => 'required|email|max:255',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'username' => 'required|max:255|unique:admins,username,'.$Admin->id.',id',
                'email' => 'required|email|max:255',
                //'department_id' => ['required', 'integer'],
                //'position_id' => ['required', 'integer'],
                'password' => ['required', Rules\Password::defaults()],
            ]);
        }


        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $objAdmin = Admin::find($Admin->id);
        $objAdmin->name = $request->name;
        $objAdmin->username = $request->username;
        $objAdmin->email = $request->email;
        $objAdmin->phone = $request->phone;
        $objAdmin->address = $request->address;
        //$objAdmin->position_id = $request->position_id;
//        $objAdmin->is_super = $request->select_is_super;

        if(!empty($request->password)){
            $objAdmin->password = Hash::make($request->password);
        }

        $objAdmin->save();
        return response()->json(['objAdmin'=>$objAdmin]);

    }

    public function deletelawyer(Request $request , $id)
    {  

        $this->authorize(self::MODEL.'-update');
        
        $validator = Validator::make($request->all(),[
            'lawyer_id' => ['required', 'integer'],
        ]);
        


        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        
        try {
            DB::transaction(function () use ($id, $request) {
                $old_lawyer_id = $id;
                $new_lawyer_id = $request->lawyer_id;

                $affectedRows = Problem::where('admin_id', $old_lawyer_id)
                    ->withTrashed() // Include both active and soft-deleted records
                    ->update(['admin_id' => $new_lawyer_id]);

                $Admin = Admin::where('id', $old_lawyer_id)->delete();
            });

            return response()->json(['message' => 'Transaction successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(self::MODEL.'-delete');
        $Admin = Admin::where('id',$id)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function deleteAdmins(Request $request)
    {
        $this->authorize(self::MODEL.'-delete');
        $Admin = Admin::whereIn('id',$request->ids)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function get(Request $request)
    {

        $this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'name'   => true,
            'username'   => true,
            'email'   => true,
            'phone'   => true,
            'address'   => true,
            // 'super_admin'   => true,
            // "position_name" => true,
            'created_at'   => true,
        ];

        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }

        $segment = $request->segment(2);
        if($segment=='admins'){
            $position_id = 1;
        }

        elseif($segment=='lawyers'){
            $position_id = 2;
        }

        elseif($segment=='secretariats'){            
            $position_id = 3;
        }

        $active = $request->active;

        $alldata = Admin::where('position_id',$position_id)->get();

        if($active=='All'){
            $alldata = Admin::withTrashed()->where('position_id',$position_id)->get();
        }
        elseif($active=='Active'){
            $alldata = Admin::where('position_id',$position_id)->get();
        }
        elseif($active=='DeActive'){
            $alldata = Admin::onlyTrashed()->where('position_id',$position_id)->get();
        }



        $alldataResult=array();

        foreach($alldata as $objdata){

            $is_super = "Super Admin";
            if(!$objdata->is_super)  $is_super = "Normal Admin";
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "name" => $objdata->name,
                "username"=> $objdata->username,
                "email" => $objdata->email,
                "phone" => $objdata->phone,
                "address" => $objdata->address,
                // "super_admin" => $is_super,
                // "position_name" => @$objdata->position->display_name,
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

    public function Promotion(Request $request , $id)
    {  

        $this->authorize(self::MODEL.'-update');

        $validator = Validator::make($request->all(),[
            'department_id' => ['required', 'integer'],
            'position_id' => ['required', 'integer'],
        ]);



        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $is_super = $request->position_id == 1 ? 1 : 0;

        $objAdmin = Admin::find($id);
        $objAdmin->position_id = $request->position_id;
        $objAdmin->is_super = $is_super;
        $objAdmin->save();
        return response()->json(['objAdmin'=>$objAdmin]);


    }
}
