<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupLeader;
use App\Models\ScoutExperience;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use TCPDF;
use DB;
use Illuminate\Support\Facades\Mail;

class GroupLeadersController extends Controller
{
    private const MODEL ='GroupLeader';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        

        $ids = GroupLeader::select('admin_id')->groupBy('admin_id')->pluck('admin_id')->toArray();


        $leaders = Admin::where('is_super',0)->whereNull('deleted_at')->get();


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $objgroup = Admin::find($id);
        $title = __('messages.group_leader') . $objgroup->group_name;
        $add_title = __('messages.Add_leader');
        $added = "";
        if($objAdmin->is_super == 0 && $userId != $id){
         
          return view('auth.404',['title' => $title, 'add_title' => $add_title , 'objgroup'=>$objgroup , 'id'=>$id,'objAdmin'=>$objAdmin]
            );
        }

        
        
        

        if($objgroup->position_id == 1  || $objgroup->position_id == 3){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
            $can_accept = 1;
            $can_reject = 1;
        }


        if($objgroup->position_id == 4){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
            $can_accept = 0;
            $can_reject = 0;
        }


        if($objgroup->position_id ==2){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 0;
            $can_accept = 0;
            $can_reject = 0;

            
        }

        $added = GroupLeader::where('admin_id',$objgroup->id)->first();

        if($objgroup->is_super == 0){
        GroupLeader::where('admin_id', $objgroup->id)
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        GroupLeader::withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
         
        }
         

        return view('auth.admin.group_leaders.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders, 'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print, 'can_accept'=>$can_accept, 'can_reject'=>$can_reject,'added'=>$added,'objgroup'=>$objgroup]);
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
    public function store(Request $request,$id)
    {
       
     DB::beginTransaction(); // Start a database transaction
        //$this->authorize(self::MODEL.'-store');
       
        $validator = Validator::make($request->all(),[
            // 'leader_id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'grandfather_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'job' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        // Check if the admin already exists
        $exsist_admin =  GroupLeader::where('admin_id', $id)->first();

        if ($exsist_admin) {
            return response()->json(['error' => 'This user already exists as a Group Leader.'], Response::HTTP_BAD_REQUEST);
        }


        $GroupLeader = GroupLeader::create([
            'admin_id' =>  $id,
            'first_name' =>  $request->first_name,
            'father_name' =>  $request->father_name,
            'grandfather_name' =>  $request->grandfather_name,
            'family_name' =>  $request->family_name,
            'birth_place' =>  $request->birth_place,
            'birth_date' =>  $request->birth_date,
            'job' =>  $request->job,
            'scout' =>  $request->scout,
            'specialization_scout' =>  $request->specialization_scout,
            'year_scout' =>  $request->year_scout,
            'place_scout' =>  $request->place_scout,
            'vacation_scout' =>  $request->vacation_scout,
            'note_scout' =>  $request->note_scout,
            'academic' =>  $request->academic,
            'specialization_academic' =>  $request->specialization_academic,
            'year_academic' =>  $request->year_academic,
            'college' =>  $request->college,
            'work_place' =>  $request->work_place,
            'phone' =>  $request->phone,
            'Job_title' =>  $request->Job_title,
            'city' =>  $request->city,
            'area' =>  $request->amman_region ? $request->amman_region : $request->area,
            'street' =>  $request->street,
            'building_number' =>  $request->building_number,
            'nearest_teacher' =>  $request->nearest_teacher,
            'home_phone' =>  $request->home_phone,
            'marital_status' =>  $request->marital_status,
            'phone_comunication' =>  $request->phone_comunication,
            'email' =>  $request->email,
            'fax' =>  $request->fax,
            'mailbox' =>  $request->mailbox,
            'city_comunication' =>  $request->city_comunication,
            'zip_code' =>  $request->zip_code,
            
            
        ]);


        $mission = $request->mission;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $other_lawer = $request->other_lawer;
        $reason_leave = $request->reason_leave;

        if($request->Place_group){
            foreach ($request->Place_group as $key => $Place_group) {

                $ScoutExperience = new ScoutExperience();
                $ScoutExperience->group_leader_id = $GroupLeader->id;
                $ScoutExperience->place = $Place_group;
                $ScoutExperience->mission = $mission[$key];
                $ScoutExperience->date_from = $date_from[$key];
                $ScoutExperience->date_to = $date_to[$key];
                $ScoutExperience->reason_leave = $reason_leave[$key];
                $ScoutExperience->save();
            }
        }


        $this->logAction(auth()->id(), 'user', 'add_group_leader', 'create', 'group_leaders', $GroupLeader->id);

        DB::commit(); // Commit the transaction
       
        return response()->json(['GroupLeader'=>$GroupLeader]);
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
        $GroupLeader  = GroupLeader::find($id);
        @$GroupLeader->Admin;

        return response()->json($GroupLeader);
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
        DB::beginTransaction(); // Start a database transaction
        //$this->authorize(self::MODEL.'-update');
       // print_r($request->all());die;
            $validator = Validator::make($request->all(),[
                // 'leader_id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'grandfather_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'job' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


      

       
        $userId = Auth::id();
        $objGroupLeader = GroupLeader::find($id);
        $objGroupLeader->first_name =  $request->first_name;
        $objGroupLeader->father_name =  $request->father_name;
        $objGroupLeader->grandfather_name =  $request->grandfather_name;
        $objGroupLeader->family_name =  $request->family_name;
        $objGroupLeader->birth_place =  $request->birth_place;
        $objGroupLeader->birth_date =  $request->birth_date;
        $objGroupLeader->job =  $request->job;
        $objGroupLeader->scout =  $request->scout;
        $objGroupLeader->specialization_scout =  $request->specialization_scout;
        $objGroupLeader->year_scout =  $request->year_scout;
        $objGroupLeader->place_scout =  $request->place_scout;
        $objGroupLeader->vacation_scout =  $request->vacation_scout;
        $objGroupLeader->note_scout =  $request->note_scout;
        $objGroupLeader->academic =  $request->academic;
        $objGroupLeader->specialization_academic =  $request->specialization_academic;
        $objGroupLeader->year_academic =  $request->year_academic;
        $objGroupLeader->college =  $request->college;
        $objGroupLeader->work_place =  $request->work_place;
        $objGroupLeader->phone =  $request->phone;
        $objGroupLeader->Job_title =  $request->Job_title;
        $objGroupLeader->city =  $request->city;
        $objGroupLeader->area =  $request->amman_region ? $request->amman_region : $request->area;
        $objGroupLeader->street =  $request->street;
        $objGroupLeader->building_number =  $request->building_number;
        $objGroupLeader->nearest_teacher =  $request->nearest_teacher;
        $objGroupLeader->home_phone =  $request->home_phone;
        $objGroupLeader->marital_status =  $request->marital_status;
        $objGroupLeader->phone_comunication =  $request->phone_comunication;
        $objGroupLeader->email =  $request->email;
        $objGroupLeader->fax =  $request->fax;
        $objGroupLeader->mailbox =  $request->mailbox;
        $objGroupLeader->city_comunication =  $request->city_comunication;
        $objGroupLeader->zip_code =  $request->zip_code;
       
        $objGroupLeader->save();


        $this->logAction(auth()->id(), 'user', 'update_group_leader', 'update', 'group_leaders', $objGroupLeader->id);
        DB::commit(); // Commit the transaction
        return response()->json(['objGroupLeader'=>$objGroupLeader]);
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
        ScoutExperience::where('group_leader_id',$id)->delete();
        $GroupLeader = GroupLeader::where('id',$id)->delete();

        $this->logAction(auth()->id(), 'user', 'delete_group_leader', 'delete', 'group_leaders', $id);
        return response()->json(['GroupLeader'=>$GroupLeader]);
    }

     public function deleteGroupLeaders(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        ScoutExperience::whereIn('group_leader_id',$request->ids)->delete();
        $GroupLeader = GroupLeader::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_group_leader', 'delete', 'board_directors', $id);
        }

        return response()->json(['GroupLeader'=>$GroupLeader]);
    }


    public function get(Request $request , $id)
    { 

        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'first_name'=> true,
            'father_name'=>true,
            'family_name' =>true,
            'job' =>true,
            'grandfather_name'=>true,
            'birth_place'=>true,
            'birth_date'=>true,
            'phone'=>true,
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

        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';


        

            $alldata = GroupLeader::where('admin_id',$id)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            if($active=='All'){
                $alldata = GroupLeader::withTrashed()->where('admin_id',$id)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = GroupLeader::where('admin_id',$id)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = GroupLeader::onlyTrashed()->where('admin_id',$id)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }




        $alldataResult=array();

        foreach($alldata as $key=> $objdata){

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "first_name"=> $objdata->first_name,
                "father_name" =>$objdata->father_name,
                "grandfather_name"=>$objdata->grandfather_name,
                "family_name" =>$objdata->family_name,
                "job" =>$objdata->job,
                
                "birth_place"=>$objdata->birth_place,
                "birth_date"=>Date('Y-m-d',strtotime($objdata->birth_date)),
                "phone"=>$objdata->phone,
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


    
 

}
