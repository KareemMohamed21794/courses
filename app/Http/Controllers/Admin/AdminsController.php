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
       // $this->authorize(self::MODEL.'-viewAny');
        $departments = Department::all();
        $positions = Position::all();
        $leaders = Admin::where('position_id',2)->get();

        $segment = $request->segment(2);

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

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
        elseif($segment=='leaders'){

            $title =  $objAdmin->is_super == 1 ? __('messages.scout_groups') : __('messages.group_info');
            $add_title ="مجموعة كشفية";;
            $department_id = 2;
            $position_id = 2;
            $is_super = 0;
        }


        $Governorates = [
            "عمّان",
            "إربد",
            "البلقاء",
            "الزرقاء",
            "العقبة",
            "جرش",
            "عجلون",
            "الكرك",
            "مأدبا",
            "الطفيلة",
            "المفرق",
            "معان"
        ];


        

        return view('auth.admin.admins.index',['title' => $title, 'departments' => $departments, 'positions' => $positions, 'segment' => $segment , 'add_title' => $add_title, 'department_id' => $department_id, 'position_id' => $position_id, 'is_super' => $is_super, 'leaders' => $leaders,'Governorates'=>$Governorates,'objAdmin'=>$objAdmin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize(self::MODEL.'-store');
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
            'name' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
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
            'registration_type' => $request->registration_type,
            'alhayyuh_almuqayaduh' => $request->alhayyuh_almuqayaduh,
            'alhayyuh_almuqayaduh_number' => $request->alhayyuh_almuqayaduh_number,
            'group_classification' => $request->group_classification,
            'group_name' => $request->group_name,
            'date_establishment' => $request->date_establishment,
            'registration_number' => $request->registration_number,
            'website' => $request->website,
            'governorate' => $request->governorate,
            'district' => $request->district,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'workplace' => $request->workplace,
            'job' => $request->job,
            'leaders_number' => $request->leaders_number,
            'persons_number' => $request->persons_number,
            'groups' => $request->groups,
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
        //$this->authorize(self::MODEL.'-viewAny');
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
        //$this->authorize(self::MODEL.'-update');
        if(empty($request->password)){
               $validator = Validator::make($request->all(),[
                'name' => ['string', 'max:255'],
                'username' => 'required|max:255|unique:admins,username,'.$Admin->id.',id',
                'email' => 'required|email|max:255',
                // 'registration_type' => 'required',
                // 'group_classification' => 'required',
                // 'group_name' => 'required',
                // 'date_establishment' => 'required',
                // 'registration_number' => 'required',
                // 'website' => 'required',
                // 'governorate' => 'required',
                // 'district' => 'required',
                // 'street_name' => 'required',
                // 'building_number' => 'required',
                // 'workplace' => 'required',
                // 'job' => 'required',
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'username' => 'required|max:255|unique:admins,username,'.$Admin->id.',id',
                'email' => 'required|email|max:255',
                'password' => ['required', Rules\Password::defaults()],
                // 'registration_type' => 'required',
                // 'group_classification' => 'required',
                // 'group_name' => 'required',
                // 'date_establishment' => 'required',
                // 'registration_number' => 'required',
                // 'website' => 'required',
                // 'governorate' => 'required',
                // 'district' => 'required',
                // 'street_name' => 'required',
                // 'building_number' => 'required',
                // 'workplace' => 'required',
                // 'job' => 'required',
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
        $objAdmin->registration_type = $request->registration_type;
        $objAdmin->alhayyuh_almuqayaduh = $request->alhayyuh_almuqayaduh;
        $objAdmin->group_classification = $request->group_classification;
        $objAdmin->group_name = $request->group_name;
        $objAdmin->date_establishment = $request->date_establishment;
        $objAdmin->registration_number = $request->registration_number;
        $objAdmin->website = $request->website;
        $objAdmin->governorate = $request->governorate;
        $objAdmin->district = $request->district;
        $objAdmin->street_name = $request->street_name;
        $objAdmin->building_number = $request->building_number;
        $objAdmin->workplace = $request->workplace;
        $objAdmin->job = $request->job;
        $objAdmin->alhayyuh_almuqayaduh = $request->alhayyuh_almuqayaduh;
        $objAdmin->alhayyuh_almuqayaduh_number = $request->alhayyuh_almuqayaduh_number;
        $objAdmin->leaders_number = $request->leaders_number;
        $objAdmin->persons_number = $request->persons_number;
        $objAdmin->groups = $request->groups;


        if(!empty($request->password)){
            $objAdmin->password = Hash::make($request->password);
        }

        $objAdmin->save();
        return response()->json(['objAdmin'=>$objAdmin]);

    }

    public function deletelawyer(Request $request , $id)
    {  

        //$this->authorize(self::MODEL.'-update');
        
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
        //$this->authorize(self::MODEL.'-delete');
        $Admin = Admin::where('id',$id)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function deleteAdmins(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Admin = Admin::whereIn('id',$request->ids)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function get(Request $request)
    {

        ini_set('memory_limit', '-1');
        $segment = $request->segment(2);
        if($segment=='admins'){
            $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'username'   => true,
            'name'   => true,
            // 'group_name'   => true,
            'email'   => true,
            'phone'   => true,
            // 'address'   => true,
            // 'super_admin'   => true,
            // "position_name" => true,
            'created_at'   => true,
        ];
        }else{
            $columnsDefault = [
            '#'   => true,
            'id'   => true,
            // 'name'   => true,
            'username'   => true,
            'group_name'   => true,
            'email'   => true,
            'phone'   => true,
            //'address'   => true,
            // 'super_admin'   => true,
            // "position_name" => true,
            'created_at'   => true,
        ];
        }

        //$this->authorize(self::MODEL.'-viewAny');
        
        

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

        elseif($segment=='leaders'){
            $position_id = 2;
        }

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        $active = $request->active;

        if($objAdmin->is_super == 1){
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

        }else{


            $alldata = Admin::where('position_id',$position_id)->where('id',$objAdmin->id)->get();

            if($active=='All'){
                $alldata = Admin::withTrashed()->where('position_id',$position_id)->where('id',$objAdmin->id)->get();
            }
            elseif($active=='Active'){
                $alldata = Admin::where('position_id',$position_id)->where('id',$objAdmin->id)->get();
            }
            elseif($active=='DeActive'){
                $alldata = Admin::onlyTrashed()->where('position_id',$position_id)->where('id',$objAdmin->id)->get();
            }

        }

    


        $alldataResult=array();

        foreach($alldata as $objdata){

            $is_super = "Super Admin";
            if(!$objdata->is_super)  $is_super = "Normal Admin";
            if($segment=='admins'){

                $alldataResult[] = array(
                    "#" => $objdata->id,
                    "id" => $objdata->id,
                    "username"=> $objdata->username,
                    "name" => $objdata->name,
                    //"group_name"=> $objdata->group_name,
                    "email" => $objdata->email,
                    "phone" => $objdata->phone,
                    // "address" => $objdata->address,
                    // "super_admin" => $is_super,
                    // "position_name" => @$objdata->position->display_name,
                    "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
                );
            }else{
                $alldataResult[] = array(
                    "#" => $objdata->id,
                    "id" => $objdata->id,
                    // "name" => $objdata->name,
                    "username"=> $objdata->username,
                    "group_name"=> $objdata->group_name,
                    "email" => $objdata->email,
                    "phone" => $objdata->phone,
                    //"address" => $objdata->address,
                    // "super_admin" => $is_super,
                    // "position_name" => @$objdata->position->display_name,
                    "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
                );

            }
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

        //$this->authorize(self::MODEL.'-update');

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
