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


     public function ShowStudents(Request $request , $id)
    {

        $segment = $request->segment(2);
        $userId = Auth::id();

        $objAdmin = Admin::find($userId);
       
        $admindetails = Admin::find($id);
       
        $title = __('messages.show_students');
        $add_title = __('messages.show_students');

        if($id != $userId){
            return view('auth.404',['title' => $title, 'add_title' => $add_title , 'admindetails'=>$admindetails , 'id'=>$id,'objAdmin'=>$objAdmin]
            );
        }else{
            return view('auth.student_registration.index',['title' => $title, 'add_title' => $add_title , 'admindetails'=>$admindetails , 'id'=>$id,'objAdmin'=>$objAdmin]
            );
        }
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $id)
    {
        $id = $this->decodeSecureId($id);
         
        //$this->authorize(self::MODEL.'-store');
        $userId = Auth::id();
        // print_r($userId);die;
        $objAdmin = Admin::find($userId);
        $segment = $request->segment(2);
        $admindetails = Admin::findOrFail($id);

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
            'grandfather_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            'nationality' => ['required'],
            'national_id' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:255'],
            
        ]);

        if ($validator->fails()) {
            //return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $full_name = $request->first_name.' '.$request->father_name.' '.$request->grandfather_name.' '.$request->family_name;

        $exsist_student = StudentRegistration::where('full_name',$full_name)->where('year',date('Y'))->first();

        if($exsist_student){
             return redirect()->back()->with('message', 'هذا الطالب  موجود من قبل');
        }


       
        $StudentRegistration = StudentRegistration::create([
        'admin_id' =>  $request->group_id,
        'first_name' =>  $request->first_name,
        'father_name' =>  $request->father_name,
        'grandfather_name' =>  $request->grandfather_name,
        'family_name' =>  $request->family_name,
        'full_name' =>  $request->first_name.' '.$request->father_name.' '.$request->grandfather_name.' '.$request->family_name,
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
        'health_condition_type' =>  $request->health_condition_type ,
        'city' =>  $request->city,
        'area' =>  $request->area ? $request->area : $request->amman_region,
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
        'type' => '',
        'year' => date('Y'),
        ]);

        $this->logAction(auth()->id(), 'user', 'add_student', 'create', ' student_registrations', $StudentRegistration->id);

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
        $this->logAction(auth()->id(), 'user', 'delete_student', 'delete', ' student_registrations', $id);
        return response()->json(['StudentRegistration'=>$StudentRegistration]);
    }

     public function deleteStudentRegistrations(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $StudentRegistration = StudentRegistration::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_student', 'delete', ' student_registrations', $id);
        }
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
            'order'   => true,
            'id'   => true,
            'first_name'   => true,
            'father_name'=>true,
            'grandfather_name'=> true,
            'family_name'=> true,
            'birth_date'=> true,
            'birth_place'=> true,
            'type'   => true,
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
       

           $alldata = StudentRegistration::where('admin_id',$id)->get();
        
            if($active=='All'){
                $alldata = StudentRegistration::where('admin_id',$id)->withTrashed()->get();
            }
            elseif($active=='Active'){
                $alldata = StudentRegistration::where('admin_id',$id)->get();
            }
            elseif($active=='DeActive'){
                $alldata = StudentRegistration::where('admin_id',$id)->onlyTrashed()->get();
            }
        

        $alldataResult=array();

        $page_status = '';
 
        foreach($alldata as $key=> $objdata){

            $type = "معلقه";
            if($objdata->type=='approved'){
                $type = "مقبول";
            }

            if($objdata->active == 1){
                $page_status = __('messages.active');
            }else{
                $page_status =__('messages.inactive');
            }

          
            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "first_name" => $objdata->first_name,
                "father_name"=> $objdata->father_name,
                "grandfather_name"=> $objdata->grandfather_name,
                "family_name"=> $objdata->family_name,
                "birth_date"=> $objdata->birth_date,
                "birth_place"=> $objdata->birth_place,
                "type"=> $type,
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



    public function accept_student_registration(Request $request, $id)
    {
         

        $objStudentRegistration = StudentRegistration::find($id);
        $objStudentRegistration->type = "approved";       
        $objStudentRegistration->save();

        $this->logAction(auth()->id(), 'user', 'accept_student', 'accepted', ' student_registrations', $objStudentRegistration->id);

        // $objUser = $objStudentRegistration->Admin;

        // if(!empty($objUser->email)){
        //     $recipient = $objUser->email;
        //     $subject = 'موافقه نموذج التسجيل';

        //     $data = ['content' => 'This is the email content.']; // Data to pass to the view

        //     $fromEmail = 'admin@tawasol.privatescouts.org'; 
        //     // The "from" email address

        //     Mail::send('emails.secondary_registrations', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
        //         $mail->to($recipient)
        //             ->from($fromEmail) // Set the "from" email address
        //             ->subject($subject);
        //     });
        // }
        


        // print_r($objUser); die;



        return redirect('/admin/show_students/'.$objStudentRegistration->admin_id);

    }



    public function AnuulRegistrationArchive()
    {
        
        //$this->authorize(self::MODEL.'-store');
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);


        $Students = StudentRegistration::where('admin_id',$objAdmin->id)->where('type','approved')->select('full_name','id')->groupBy('full_name','id')->get();

        $title = __('messages.annual_registration_archive');
        $add_title = __('messages.annual_registration_archive');
     
        return view('auth.student_registration.annual_registration_archive',['title' => $title, 'add_title' => $add_title,'Students'=>$Students,'objAdmin'=>$objAdmin]);
    }



    public function AddAnuulRegistrationArchive(Request $request)
    {
        
        if($request->student_id && count($request->student_id) > 0){

            foreach ($request->student_id as $key => $student_id) {
            $objStudentRegistration = StudentRegistration::find($student_id);

            $exsist_student = StudentRegistration::where('full_name',$objStudentRegistration->full_name)->where('year',date('Y'))->first();

            if(!$exsist_student){

                $StudentRegistration = StudentRegistration::create([
                'admin_id' =>  $request->admin_id,
                'first_name' =>  $objStudentRegistration->first_name,
                'father_name' =>  $objStudentRegistration->father_name,
                'grandfather_name' =>  $objStudentRegistration->grandfather_name,
                'family_name' =>  $objStudentRegistration->family_name,
                'full_name' =>  $objStudentRegistration->full_name,
                'birth_date' =>  $objStudentRegistration->birth_date,
                'birth_place' =>  $objStudentRegistration->birth_place,
                'mobile_number' =>  $objStudentRegistration->mobile_number,
                'home_number' =>  $objStudentRegistration->home_number,
                'national_id' =>  $objStudentRegistration->national_id,
                'nationality' =>  $objStudentRegistration->nationality,
                'parents_status' =>  $objStudentRegistration->parents_status,
                'education_level' =>  $objStudentRegistration->education_level,
                'blood_type' =>  $objStudentRegistration->blood_type,
                'hobbies' =>  $objStudentRegistration->hobbies,
                'health_condition' =>  $objStudentRegistration->health_condition,
                'health_condition_type' =>  $objStudentRegistration->health_condition_type ,
                'city' =>  $objStudentRegistration->city,
                'area' =>  $objStudentRegistration->area ,
                'street' =>  $objStudentRegistration->street,
                'nearest_teacher' =>  $objStudentRegistration->nearest_teacher,
                'building_number' =>  $objStudentRegistration->building_number,
                'guardian_name' =>  $objStudentRegistration->guardian_name,
                'division' =>  $objStudentRegistration->division,
                'guardian_phone' =>  $objStudentRegistration->guardian_phone,
                'guardian_phone_2' =>  $objStudentRegistration->guardian_phone_2,
                'guardian_job' =>  $objStudentRegistration->guardian_job,
                'relative_relation' =>  $objStudentRegistration->relative_relation,
                'guardian_place_work' =>  $objStudentRegistration->guardian_place_work,
                'guardian_email' =>  $objStudentRegistration->guardian_email,
                'identifier_name' =>  $objStudentRegistration->identifier_name,
                'identifier_phone' =>  $objStudentRegistration->identifier_phone,
                'notes' =>  $objStudentRegistration->notes,
                'text_note' =>  $objStudentRegistration->text_note,
                'type' => '',
                'year' => date('Y'),
                ]);

                $this->logAction(auth()->id(), 'user', 'add_AnuulRegistrationArchive', 'create', ' student_registrations', $StudentRegistration->id);
                       
            }
        }

        }
        
        

         return redirect('admin/annual_registration_archive');

   
    }



    public function ReportStudentRegistration()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_secondary_registrations');
        $leaders = Admin::where('is_super','!=',1)->get();
        return view('auth.student_registration.report_student_registration', [
            'title' => $title,
            'leaders' => $leaders,
        ]);
    }



    public function ReportStudentRegistrationGet()
    {
        

        
        $leader_id = @$_GET['leader_id'];
      
        $objAdmin_data = Admin::find($leader_id);
        $obj_admin_name = $objAdmin_data ? $objAdmin_data->group_name : 'الكل';
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_secondary_registrations'). ' - ' .$obj_admin_name;

        return view('auth.student_registration.report_student_registration_get', ['title' => $title,'leader_id' => $leader_id]);
    }



    public function ReportQualificationLeadersGetlist(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
           
            'order'   => true,
            'id'   => true,
            'group_name'   => true,
            'first_name'   => true,
            'father_name'=>true,
            'grandfather_name'=> true,
            'family_name'=> true,
            'birth_date'=> true,
            'birth_place'=> true,
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }


        $alldata = StudentRegistration::all();
       
        $title = __('messages.report_secondary_registrations');
        
        if($request->leader_id){
            $alldata = $alldata->where('admin_id',$request->leader_id);
        } 



        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {
           
            $alldataResult[] = array(
                "order" => $key+1,
                "id" => $objdata->id,
                "group_name" => @$objdata->Admin->group_name,
                "first_name" => $objdata->first_name,
                "father_name"=> $objdata->father_name,
                "grandfather_name"=> $objdata->grandfather_name,
                "family_name"=> $objdata->family_name,
                "birth_date"=> $objdata->birth_date,
                "birth_place"=> $objdata->birth_place,
              
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


    public function ExportStudentRegistrations(Request $request)
    {
      

        $fileName = 'student_registrations.csv';
        $student_registrations = StudentRegistration::all();
        
            
            if($request->leader_id){

                $student_registrations = $student_registrations->where('admin_id',$request->leader_id);
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
        $columns = array(__('messages.scout_group'),__('messages.first_name'),__('messages.father_name'),__('messages.grandfather_name'),__('messages.family_name'),__('messages.birth_date'),__('messages.birth_place'));

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($student_registrations, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            // Write the data rows
            foreach ($student_registrations as $student_registration) {
               
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['group_name']  = @$student_registration->Admin->group_name;
                $row['first_name']  = $student_registration->first_name;
                $row['father_name']  = $student_registration->father_name;
                $row['grandfather_name']  = $student_registration->grandfather_name;
                $row['family_name']  = $student_registration->family_name;
                $row['birth_date']  = $student_registration->birth_date;
                $row['birth_place']  = $student_registration->birth_place;
             
                // Write the row data to the CSV file
                fputcsv($file, array($row['group_name'],$row['first_name'],$row['father_name'],$row['grandfather_name'],$row['family_name'],$row['birth_date'],$row['birth_place']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function decodeSecureId($encoded, $secretKey = 'mySuperSecretKey') {
    // Revert to standard base64 characters if you made it URL-safe
    $base64 = str_replace(['-', '_'], ['+', '/'], $encoded);

    // Because we removed '=' in the encode function, we might need to pad it back
    // Base64 strings often need padding to a multiple of 4. Let's do a quick fix:
    $padLength = 4 - (strlen($base64) % 4);
    if ($padLength < 4) {
        $base64 .= str_repeat('=', $padLength);
    }

    // Base64-decode
    $decoded = base64_decode($base64, true);
    if ($decoded === false) {
        // Decoding failure
        return false;
    }

    // Split into "id" and "signature"
    $parts = explode(':', $decoded);
    if (count($parts) !== 2) {
        // Not in "id:signature" format
        return false;
    }

    list($idStr, $signature) = $parts;

    // Recompute the HMAC signature
    $expectedSignature = hash_hmac('sha256', $idStr, $secretKey);

    // Compare signatures to detect tampering
    if (!hash_equals($expectedSignature, $signature)) {
        // Signatures do not match => tampered
        return false;
    }

    // At this point, ID is verified. Convert to integer and return
    return (int) $idStr;
}



}