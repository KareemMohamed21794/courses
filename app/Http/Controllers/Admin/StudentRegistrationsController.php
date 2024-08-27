<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentRegistration;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use Illuminate\Support\Facades\Mail;
class StudentRegistrationsController extends Controller
{
    private const MODEL ='StudentRegistration';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , $id)
    {

        $segment = $request->segment(2);
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
       
        $admindetails = Admin::find($id);
       
        $title = __('messages.show_students');
        $add_title = __('messages.show_students');
       
        return view('auth.student_registration.index',['title' => $title, 'add_title' => $add_title , 'admindetails'=>$admindetails , 'id'=>$id,'objAdmin'=>$objAdmin]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $id)
    {
        
        //$this->authorize(self::MODEL.'-store');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $segment = $request->segment(2);
        $admindetails = Admin::find($id);

        $title = __('messages.student_registration');
        $add_title = __('messages.student_registration');
     
        return view('auth.student_registration.add',['title' => $title, 'add_title' => $add_title, 'admindetails'=>$admindetails , 'id'=>$id]);
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
            'first_name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'national_id' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'nearest_teacher' => ['required', 'string', 'max:255'],
            'building_number' => ['required', 'string', 'max:255'],
            'guardian_name' => ['required', 'string', 'max:255'],
            'relative_relation' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            //return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }


       
        $StudentRegistration = StudentRegistration::create([
        'admin_id' =>  $request->group_id,
        'first_name' =>  $request->first_name,
        'father_name' =>  $request->father_name,
        'grandfather_name' =>  $request->grandfather_name,
        'family_name' =>  $request->family_name,
        'birth_date' =>  $request->birth_date,
        'birth_place' =>  $request->birth_place,
        'mobile_number' =>  $request->mobile_number,
        'home_number' =>  $request->home_number,
        'national_id' =>  $request->national_id,
        'nationality' =>  $request->nationality,
        'parents_status' =>  $request->parents_status,
        'education_level' =>  $request->education_level,
        'blood_type' =>  $request->blood_type,
        'hobbies' =>  $request->hobbies,
        'health_condition' =>  $request->health_condition,
        'health_condition_type' =>  $request->health_condition_type ? implode( ',', $request->health_condition_type ) : null,
        'city' =>  $request->city,
        'area' =>  $request->area,
        'street' =>  $request->street,
        'nearest_teacher' =>  $request->nearest_teacher,
        'building_number' =>  $request->building_number,
        'guardian_name' =>  $request->guardian_name,
        'division' =>  $request->division,
        'guardian_phone' =>  $request->guardian_phone,
        'guardian_phone_2' =>  $request->guardian_phone_2,
        'guardian_job' =>  $request->guardian_job,
        'relative_relation' =>  $request->relative_relation,
        'guardian_place_work' =>  $request->guardian_place_work,
        'guardian_email' =>  $request->guardian_email,
        'identifier_name' =>  $request->identifier_name,
        'identifier_phone' =>  $request->identifier_phone,
        'notes' =>  $request->notes,
        'text_note' =>  $request->text_note,
        ]);

        // return redirect('student_registration');

   
        return redirect()->back()->with('message', 'تم الاضافه بنجاح');
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
        $StudentRegistration  = StudentRegistration::find($id);
        
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
      
        $title = __('messages.student_registration');
        $add_title = __('messages.student_registration');
        
        return view('auth.student_registration.update',['title' => $title, 'add_title' => $add_title, 'StudentRegistration' => $StudentRegistration, 'id' => $id]);

       // return response()->json($StudentRegistration);
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
               
                'description_ar' => ['required', 'string', 'max:255'],
                'description_en' => ['required', 'string', 'max:255'],
                
            ]);
   

        if ($validator->fails()) {
            //return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

       
        $objStudentRegistration = StudentRegistration::find($id);
        $objStudentRegistration->description_ar = $request->description_ar;
        $objStudentRegistration->description_en = $request->description_en;
        $objStudentRegistration->active = $request->active ? $request->active : 0;
        $objStudentRegistration->save();
        
       

        return redirect('student_registration');
   
        //return response()->json(['objStudentRegistration'=>$objStudentRegistration]);
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
        $StudentRegistration = StudentRegistration::where('id',$id)->delete();
        return response()->json(['StudentRegistration'=>$StudentRegistration]);
    }

     public function deleteStudentRegistrations(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $StudentRegistration = StudentRegistration::whereIn('id',$request->ids)->delete();
        return response()->json(['StudentRegistration'=>$StudentRegistration]);
    }


    public function get(Request $request , $id)
    { 
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
       
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'first_name'   => true,
            'father_name'=>true,
            'grandfather_name'=> true,
            'family_name'=> true,
            'birth_date'=> true,
            'birth_place'=> true,
            'created_at'   => true,
        ];


        $type = $request->type;

        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }

       
        $active = $request->active;
       

           $alldata = StudentRegistration::where('group_id',$id)->get();
        
            if($active=='All'){
                $alldata = StudentRegistration::where('group_id',$id)->withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = StudentRegistration::where('group_id',$id)->get();
            }
            elseif($active=='DeActive'){
                $alldata = StudentRegistration::where('group_id',$id)->onlyTrashed()->get();
            }
        

        $alldataResult=array();

        $page_status = '';
 
        foreach($alldata as $key=> $objdata){

            if($objdata->active == 1){
                $page_status = __('messages.active');
            }else{
                $page_status =__('messages.inactive');
            }

          
            $alldataResult[] = array(
                "#" => $objdata->id,
                
                "id" => $objdata->id,
                "first_name" => $objdata->first_name,
                "father_name"=> $objdata->father_name,
                "grandfather_name"=> $objdata->grandfather_name,
                "family_name"=> $objdata->family_name,
                "birth_date"=> $objdata->birth_date,
                "birth_place"=> $objdata->birth_place,
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