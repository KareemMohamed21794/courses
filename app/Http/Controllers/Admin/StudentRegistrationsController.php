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
use PDF;
use TCPDF;
use Carbon\Carbon;
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
        $id = $this->decodeSecureId($id);

       
        $segment = $request->segment(2);
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
       
        $admindetails = Admin::findOrFail($id);
       
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
       
        $admindetails = Admin::findOrFail($id);
       
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
            'division' => ['required'],
            'sex' => ['required'],
            
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
        'full_name' =>  $full_name,
        'birth_date' =>  $request->birth_date,
        'birth_place' =>  $request->birth_place,
        'mobile_number' =>  $request->mobile_number,
        'home_number' =>  $request->home_number,
        'national_id' =>  $request->national_id,
        'nationality' =>  $request->nationality,
        'parents_status' =>  $request->parents_status,
        'education_level' =>  $request->education_level,
        'blood_type' =>  $request->blood_type,
        'sex' =>  $request->sex,
        'hobbies' =>  $request->hobbies,
        'health_condition' =>  $request->health_condition,
        'health_condition_type' =>  $request->health_condition_type ,
        'city' =>  $request->city,
        'area' =>  $request->area ?? $request->amman_region,
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

        //$this->logAction("", 'user', 'add_student', 'create', ' student_registrations', $StudentRegistration->id);

        // return redirect('student_registration');

   
        return redirect()->back()->with('message', 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        // $this->authorize(self::MODEL.'-viewAny');

        $id = $this->decodeSecureId($id);
        $userId = Auth::id();
       
        $objAdmin = Admin::find($userId);
        $segment = $request->segment(2);
        $StudentRegistration = StudentRegistration::findOrFail($id);
        $StudentRegistration->Admin;
        $title = __('messages.show_student');
        $add_title = __('messages.show_student');
     
        return view('auth.student_registration.show',['title' => $title, 'add_title' => $add_title, 'StudentRegistration'=>$StudentRegistration , 'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {
       
        //$this->authorize(self::MODEL.'-update');
        $id = $this->decodeSecureId($id);
        $userId = Auth::id();
       
        $objAdmin = Admin::find($userId);
        $segment = $request->segment(2);
        $StudentRegistration  = StudentRegistration::findOrFail($id);
        $StudentRegistration->Admin;
        $title = __('messages.edit_student_registration');
        $add_title = __('messages.edit_student_registration');
        
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
            'first_name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'grandfather_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            'nationality' => ['required'],
            'national_id' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'division' => ['required'],
            'sex' => ['required'],
            
        ]);
   

        if ($validator->fails()) {
            //return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $full_name = $request->first_name.' '.$request->father_name.' '.$request->grandfather_name.' '.$request->family_name;

        $exsist_student = StudentRegistration::where('full_name',$full_name)->where('year',date('Y'))->where('id','!=',$id)->first();

        if($exsist_student){
             return redirect()->back()->with('message', 'هذا الطالب  موجود من قبل');
        }

       
        $objStudentRegistration = StudentRegistration::find($id);
        $objStudentRegistration->first_name = $request->first_name;
        $objStudentRegistration->father_name = $request->father_name;
        $objStudentRegistration->grandfather_name = $request->grandfather_name;
        $objStudentRegistration->family_name = $request->family_name;
        $objStudentRegistration->full_name = $full_name;
        $objStudentRegistration->birth_date = $request->birth_date;
        $objStudentRegistration->birth_place = $request->birth_place;
        $objStudentRegistration->mobile_number = $request->mobile_number;
        $objStudentRegistration->home_number = $request->home_number;
        $objStudentRegistration->national_id = $request->national_id;
        $objStudentRegistration->nationality = $request->nationality;
        $objStudentRegistration->parents_status = $request->parents_status;
        $objStudentRegistration->education_level = $request->education_level;
        $objStudentRegistration->blood_type = $request->blood_type;
        $objStudentRegistration->sex = $request->sex;
        $objStudentRegistration->hobbies = $request->hobbies;
        $objStudentRegistration->health_condition = $request->health_condition;
        $objStudentRegistration->health_condition_type = $request->health_condition_type;
        $objStudentRegistration->city = $request->city;
        $objStudentRegistration->area = $request->area ?? $request->amman_region;
        $objStudentRegistration->street = $request->street;
        $objStudentRegistration->nearest_teacher = $request->nearest_teacher;
        $objStudentRegistration->building_number = $request->building_number;
        $objStudentRegistration->guardian_name = $request->guardian_name;
        $objStudentRegistration->division = $request->division;
        $objStudentRegistration->guardian_phone = $request->guardian_phone;
        $objStudentRegistration->guardian_phone_2 = $request->guardian_phone_2;
        $objStudentRegistration->guardian_job = $request->guardian_job;
        $objStudentRegistration->relative_relation = $request->relative_relation;
        $objStudentRegistration->guardian_place_work = $request->guardian_place_work;
        $objStudentRegistration->guardian_email = $request->guardian_email;
        $objStudentRegistration->identifier_name = $request->identifier_name;
        $objStudentRegistration->identifier_phone = $request->identifier_phone;
        $objStudentRegistration->notes = $request->notes;
        $objStudentRegistration->text_note = $request->text_note;
        $objStudentRegistration->year = date('Y');
        $objStudentRegistration->save();

        return redirect()->back()->with('message', 'تم  التعديل بنجاح');
   
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
            'mobile_number'=> true,
            'home_number'=> true,
            'nationality'=> true,
            'national_id'=> true,
            'parents_status'=> true,
            'education_level'=> true,
            'blood_type'=> true,
            'sex'=> true,
            'hobbies'=> true,
            // 'health_condition'=> true,
            'health_condition_type'=> true,
            'city'=> true,
            'area'=> true,
            'street'=> true,
            'nearest_teacher'=> true,
            'building_number'=> true,
            'division'=> true,
            'guardian_name'=> true,
            'guardian_phone'=> true,
            'guardian_phone_2'=> true,
            'guardian_job'=> true,
            'relative_relation'=> true,
            'guardian_place_work'=> true,
            'guardian_email'=> true,
            'identifier_name'=> true,
            'identifier_phone'=> true,
            'text_note'=> true,
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
       

           $alldata = StudentRegistration::where('admin_id',$id)->orderBy('type')->get();
        
            if($active=='All'){
                $alldata = StudentRegistration::where('admin_id',$id)->withTrashed()->orderBy('type')->get();
            }
            elseif($active=='Active'){
                $alldata = StudentRegistration::where('admin_id',$id)->orderBy('type')->get();
            }
            elseif($active=='DeActive'){
                $alldata = StudentRegistration::where('admin_id',$id)->onlyTrashed()->orderBy('type')->get();
            }
        

        $alldataResult=array();

        $page_status = '';
        $sex = '';
        $division = '';
        $nationalityNames = [
            'jordanian' => 'أردني',
            'emirati' => 'إماراتي',
            'bahraini' => 'بحريني',
            'tunisian' => 'تونسي',
            'algerian' => 'جزائري',
            'comorian' => 'جزر القمر',
            'djiboutian' => 'جيبوتي',
            'saudi' => 'سعودي',
            'sudanian' => 'سوداني',
            'syrian' => 'سوري',
            'somali' => 'صومالي',
            'iraqi' => 'عراقي',
            'omanian' => 'عماني',
            'palestinian' => 'فلسطيني',
            'qatari' => 'قطري',
            'kuwaitian' => 'كويتي',
            'lebanese' => 'لبناني',
            'libyan' => 'ليبي',
            'egyptian' => 'مصري',
            'moroccan' => 'مغربي',
            'mauritanian' => 'موريتاني',
            'yemeni' => 'يمني',
            'american' => 'أمريكي',
            'british' => 'بريطاني',
            'french' => 'فرنسي',
            'german' => 'ألماني',
            'canadian' => 'كندي',
            'australian' => 'أسترالي',
            'chinese' => 'صيني',
            'indian' => 'هندي',
            'japanese' => 'ياباني',
            'south_african' => 'جنوب أفريقي',
            'brazilian' => 'برازيلي',
            'russian' => 'روسي',
            'italian' => 'إيطالي',
            'spanish' => 'إسباني',
            'portuguese' => 'برتغالي',
            'swedish' => 'سويدي',
            'norwegian' => 'نرويجي',
            'dutch' => 'هولندي',
            'greek' => 'يوناني',
            'turkish' => 'تركي',
            'pakistani' => 'باكستاني',
            'afghan' => 'أفغاني',
            'iranian' => 'إيراني',
            'malaysian' => 'ماليزي',
            'singaporean' => 'سنغافوري',
            'vietnamese' => 'فيتنامي',
            'thai' => 'تايلاندي',
            'indonesian' => 'إندونيسي',
            'mexican' => 'مكسيكي',
            'colombian' => 'كولومبي',
            'chilean' => 'تشيلي',
            'argentinian' => 'أرجنتيني',
            'peruvian' => 'بيروفي',
        ];

        $parentsStatusNames = [
            'married' => 'متزوج',
            'divorced' => 'مطلق',
            'separated' => 'منفصل',
            'widowed' => 'أرمل/أرملة',
        ];

        $educationLevelNames = [
            'primary_school' => 'ابتدائي',
            'middle_school' => 'إعدادي',
            'high_school' => 'ثانوية عامة',
            'diploma' => 'دبلوم',
            'bachelor' => 'بكالوريوس',
            'master' => 'ماجستير',
            'phd' => 'دكتوراه',
        ];


        $bloodTypeNames = [
            'A+' => 'A+',
            'A-' => 'A-',
            'B+' => 'B+',
            'B-' => 'B-',
            'AB+' => 'AB+',
            'AB-' => 'AB-',
            'O+' => 'O+',
            'O-' => 'O-',
        ];


        $healthConditionNames = [
            'yes' => 'نعم',
            'no'  => 'لا',
        ];


        $cityNames = [
            '1' => 'عمان',
            '2' => 'إربد',
            '3' => 'الزرقاء',
            '4' => 'العقبة',
            '5' => 'مأدبا',
            '6' => 'الكرك',
            '7' => 'جرش',
            '8' => 'عجلون',
            '9' => 'المفرق',
            '10' => 'الطفيلة',
            '11' => 'معان',
            '12' => 'البلقاء',
        ];

        $AreaNames = [
            'أبو نصير',
            'شفا بدران',
            'الجبيهة',
            'طارق',
            'ماركا',
            'بسمان',
            'العبدلي',
            'تلاع العلي وأم السماق وخلدا',
            'صويلح',
            'المدينة',
            'النصر',
            'اليرموك',
            'زهران',
            'وادي السير',
            'بدر الجديدة',
            'مرج الحمام',
            'بدر',
            'راس العين',
            'القويسمة وأبو علندا والجويدة و الرقيم',
            'أم قصير والمقابلين والبنيات',
            'خريبة السوق وجاوا واليادودة',
            'احد'
        ];




 
        foreach($alldata as $key=> $objdata){
            // Map nationality to the Arabic name (previous code)
            $nationality = isset($nationalityNames[$objdata->nationality]) ? $nationalityNames[$objdata->nationality] : '';

            // Map parents_status to the Arabic name
            $parentsStatus = isset($parentsStatusNames[$objdata->parents_status]) ? $parentsStatusNames[$objdata->parents_status] : '';
            
            // Map education_level to the Arabic name
            $educationLevel = isset($educationLevelNames[$objdata->education_level]) ? $educationLevelNames[$objdata->education_level] : '';
            
            // Map blood_type to the Arabic name
            $bloodType = isset($bloodTypeNames[$objdata->blood_type]) ? $bloodTypeNames[$objdata->blood_type] : '';

            // Map health_condition to the Arabic name
            $healthCondition = isset($healthConditionNames[$objdata->health_condition]) ? $healthConditionNames[$objdata->health_condition] : '';

            // Map city to the Arabic name
            $city = isset($cityNames[$objdata->city]) ? $cityNames[$objdata->city] : '';

            // Map area to the Arabic name
            $area = isset($AreaNames[$objdata->area]) ? $AreaNames[$objdata->area] : '';

            $type = "معلقه";
            if($objdata->type=='approved'){
                $type = "مقبول";
            }

            if($objdata->active == 1){
                $page_status = __('messages.active');
            }else{
                $page_status =__('messages.inactive');
            }


            if($objdata->sex == 'male'){
                $sex = __('messages.male');
            }elseif($objdata->sex == 'female'){
                $sex =__('messages.female');
            }


            if($objdata->division == '1'){
                $division = 'الاشبال/الزهرات';
            }elseif($objdata->division == '2'){
                $division ='الكشاف/المرشدات';
            }elseif($objdata->division == '3'){
                $division ='المتقدم/المتقدمات';
            }elseif($objdata->division == '4'){
                $division ='الجواله/الدليلات';
            }elseif($objdata->division == '5'){
                $division ='القادة/القائدات';
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
                "mobile_number"=> $objdata->mobile_number,
                "home_number"=> $objdata->home_number,
                "nationality" => $nationality,  // Here is the nationality in Arabic
                "national_id" => $objdata->national_id,
                "parents_status" => $parentsStatus,  // Parents status in Arabic
                "education_level" => $educationLevel,  // Education level in Arabic
                "blood_type" => $bloodType,  // Blood type in Arabic
                "sex"=> @$sex,
                "hobbies"=> $objdata->hobbies,
                "health_condition_type"=> $objdata->health_condition_type,
                "city"=> $city,
                "area"=> $area,
                "street"=> $objdata->street,
                "nearest_teacher"=> $objdata->nearest_teacher,
                "building_number"=> $objdata->building_number,
                "division"=> @$division,
                "guardian_name"=> $objdata->guardian_name,
                "guardian_phone"=> $objdata->guardian_phone,
                "guardian_phone_2"=> $objdata->guardian_phone_2,
                "guardian_job"=> $objdata->guardian_job,
                "relative_relation"=> $objdata->relative_relation,
                "guardian_place_work"=> $objdata->guardian_place_work,
                "guardian_email"=> $objdata->guardian_email,
                "identifier_name"=> $objdata->identifier_name,
                "identifier_phone"=> $objdata->identifier_phone,
                "text_note"=> $objdata->text_note,
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

        $encode_id = "";
        $encode_id = $objStudentRegistration->admin_id;
        $encodeId = $this->encodeSecureId($encode_id);
        

        return redirect('/admin/show_students/'.$encodeId);

    }


    public function approve_student_registration(Request $request)
    {
        
        $studentRegistrations = StudentRegistration::whereIn('id', $request->ids)->get();

        foreach ($studentRegistrations as $registration) {
            $registration->type = "approved";
            $registration->save();

            $this->logAction(
                auth()->id(),
                'user',
                'accept_student',
                'accepted',
                'student_registrations',
                $registration->id
            );
        }

        return response()->json(['status' => 'success', 'message' => 'تمت الموافقة على المحدد.']);
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
            'mobile_number'=> true,
            'home_number'=> true,
            'nationality'=> true,
            'national_id'=> true,
            'parents_status'=> true,
            'education_level'=> true,
            'blood_type'=> true,
            'sex'=> true,
            'hobbies'=> true,
            // 'health_condition'=> true,
            'health_condition_type'=> true,
            'city'=> true,
            'area'=> true,
            'street'=> true,
            'nearest_teacher'=> true,
            'building_number'=> true,
            'division'=> true,
            'guardian_name'=> true,
            'guardian_phone'=> true,
            'guardian_phone_2'=> true,
            'guardian_job'=> true,
            'relative_relation'=> true,
            'guardian_place_work'=> true,
            'guardian_email'=> true,
            'identifier_name'=> true,
            'identifier_phone'=> true,
            'text_note'=> true,
            'type'   => true,
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

        $sex = '';
        $division = '';


        $nationalityNames = [
            'jordanian' => 'أردني',
            'emirati' => 'إماراتي',
            'bahraini' => 'بحريني',
            'tunisian' => 'تونسي',
            'algerian' => 'جزائري',
            'comorian' => 'جزر القمر',
            'djiboutian' => 'جيبوتي',
            'saudi' => 'سعودي',
            'sudanian' => 'سوداني',
            'syrian' => 'سوري',
            'somali' => 'صومالي',
            'iraqi' => 'عراقي',
            'omanian' => 'عماني',
            'palestinian' => 'فلسطيني',
            'qatari' => 'قطري',
            'kuwaitian' => 'كويتي',
            'lebanese' => 'لبناني',
            'libyan' => 'ليبي',
            'egyptian' => 'مصري',
            'moroccan' => 'مغربي',
            'mauritanian' => 'موريتاني',
            'yemeni' => 'يمني',
            'american' => 'أمريكي',
            'british' => 'بريطاني',
            'french' => 'فرنسي',
            'german' => 'ألماني',
            'canadian' => 'كندي',
            'australian' => 'أسترالي',
            'chinese' => 'صيني',
            'indian' => 'هندي',
            'japanese' => 'ياباني',
            'south_african' => 'جنوب أفريقي',
            'brazilian' => 'برازيلي',
            'russian' => 'روسي',
            'italian' => 'إيطالي',
            'spanish' => 'إسباني',
            'portuguese' => 'برتغالي',
            'swedish' => 'سويدي',
            'norwegian' => 'نرويجي',
            'dutch' => 'هولندي',
            'greek' => 'يوناني',
            'turkish' => 'تركي',
            'pakistani' => 'باكستاني',
            'afghan' => 'أفغاني',
            'iranian' => 'إيراني',
            'malaysian' => 'ماليزي',
            'singaporean' => 'سنغافوري',
            'vietnamese' => 'فيتنامي',
            'thai' => 'تايلاندي',
            'indonesian' => 'إندونيسي',
            'mexican' => 'مكسيكي',
            'colombian' => 'كولومبي',
            'chilean' => 'تشيلي',
            'argentinian' => 'أرجنتيني',
            'peruvian' => 'بيروفي',
        ];

        $parentsStatusNames = [
            'married' => 'متزوج',
            'divorced' => 'مطلق',
            'separated' => 'منفصل',
            'widowed' => 'أرمل/أرملة',
        ];

        $educationLevelNames = [
            'primary_school' => 'ابتدائي',
            'middle_school' => 'إعدادي',
            'high_school' => 'ثانوية عامة',
            'diploma' => 'دبلوم',
            'bachelor' => 'بكالوريوس',
            'master' => 'ماجستير',
            'phd' => 'دكتوراه',
        ];


        $bloodTypeNames = [
            'A+' => 'A+',
            'A-' => 'A-',
            'B+' => 'B+',
            'B-' => 'B-',
            'AB+' => 'AB+',
            'AB-' => 'AB-',
            'O+' => 'O+',
            'O-' => 'O-',
        ];


        $healthConditionNames = [
            'yes' => 'نعم',
            'no'  => 'لا',
        ];


        $cityNames = [
            '1' => 'عمان',
            '2' => 'إربد',
            '3' => 'الزرقاء',
            '4' => 'العقبة',
            '5' => 'مأدبا',
            '6' => 'الكرك',
            '7' => 'جرش',
            '8' => 'عجلون',
            '9' => 'المفرق',
            '10' => 'الطفيلة',
            '11' => 'معان',
            '12' => 'البلقاء',
        ];

        $AreaNames = [
            'أبو نصير',
            'شفا بدران',
            'الجبيهة',
            'طارق',
            'ماركا',
            'بسمان',
            'العبدلي',
            'تلاع العلي وأم السماق وخلدا',
            'صويلح',
            'المدينة',
            'النصر',
            'اليرموك',
            'زهران',
            'وادي السير',
            'بدر الجديدة',
            'مرج الحمام',
            'بدر',
            'راس العين',
            'القويسمة وأبو علندا والجويدة و الرقيم',
            'أم قصير والمقابلين والبنيات',
            'خريبة السوق وجاوا واليادودة',
            'احد'
        ];

        foreach ($alldata as $key=> $objdata) {


            // Map nationality to the Arabic name (previous code)
            $nationality = isset($nationalityNames[$objdata->nationality]) ? $nationalityNames[$objdata->nationality] : '';

            // Map parents_status to the Arabic name
            $parentsStatus = isset($parentsStatusNames[$objdata->parents_status]) ? $parentsStatusNames[$objdata->parents_status] : '';
            
            // Map education_level to the Arabic name
            $educationLevel = isset($educationLevelNames[$objdata->education_level]) ? $educationLevelNames[$objdata->education_level] : '';
            
            // Map blood_type to the Arabic name
            $bloodType = isset($bloodTypeNames[$objdata->blood_type]) ? $bloodTypeNames[$objdata->blood_type] : '';

            // Map health_condition to the Arabic name
            $healthCondition = isset($healthConditionNames[$objdata->health_condition]) ? $healthConditionNames[$objdata->health_condition] : '';

            // Map city to the Arabic name
            $city = isset($cityNames[$objdata->city]) ? $cityNames[$objdata->city] : '';

            // Map area to the Arabic name
            $area = isset($AreaNames[$objdata->area]) ? $AreaNames[$objdata->area] : '';

            $type = "معلقه";
            if($objdata->type=='approved'){
                $type = "مقبول";
            }

            if($objdata->sex == 'male'){
                $sex = __('messages.male');
            }elseif($objdata->sex == 'female'){
                $sex =__('messages.female');
            }


            if($objdata->division == '1'){
                $division = 'الاشبال/الزهرات';
            }elseif($objdata->division == '2'){
                $division ='الكشاف/المرشدات';
            }elseif($objdata->division == '3'){
                $division ='المتقدم/المتقدمات';
            }elseif($objdata->division == '4'){
                $division ='الجواله/الدليلات';
            }elseif($objdata->division == '5'){
                $division ='القادة/القائدات';
            }
           
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
                "mobile_number"=> $objdata->mobile_number,
                "home_number"=> $objdata->home_number,
                "nationality" => $nationality,  // Here is the nationality in Arabic
                "national_id" => $objdata->national_id,
                "parents_status" => $parentsStatus,  // Parents status in Arabic
                "education_level" => $educationLevel,  // Education level in Arabic
                "blood_type" => $bloodType,  // Blood type in Arabic
                "sex"=> @$sex,
                "hobbies"=> $objdata->hobbies,
                "health_condition_type"=> $objdata->health_condition_type,
                "city"=> $city,
                "area"=> $area,
                "street"=> $objdata->street,
                "nearest_teacher"=> $objdata->nearest_teacher,
                "building_number"=> $objdata->building_number,
                "division"=> @$division,
                "guardian_name"=> $objdata->guardian_name,
                "guardian_phone"=> $objdata->guardian_phone,
                "guardian_phone_2"=> $objdata->guardian_phone_2,
                "guardian_job"=> $objdata->guardian_job,
                "relative_relation"=> $objdata->relative_relation,
                "guardian_place_work"=> $objdata->guardian_place_work,
                "guardian_email"=> $objdata->guardian_email,
                "identifier_name"=> $objdata->identifier_name,
                "identifier_phone"=> $objdata->identifier_phone,
                "text_note"=> $objdata->text_note,
                "type"=> $type,
              
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
        $columns = array(__('messages.scout_group'),__('messages.first_name'),__('messages.father_name'),__('messages.grandfather_name'),__('messages.family_name'),__('messages.birth_date'),__('messages.birth_place'),
        'رقم الهاتف','رقم المنزل','الجنسية','الرقم الوطني','الحالة بين الأبوين','المؤهل العلمي','نوع الدم','الجنس','الهوايات','ما هي الأمراض مزمنة أو الظروف الصحية','المدينة','المنطقة','اسم الشارع','أقرب معلم',
        'رقم البناء','الفرقة','اسم ولي الأمر','رقم ولي الأمر 1','رقم ولي الأمر 2','مهنة ولي الأمر','صلة القرابة','مكان عمل ولي الأمر','البريد الإلكتروني لولي الأمر','اسم المعرف','رقم المعرف','الملاحظات','الحاله'
       );
 
        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($student_registrations, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            $sex = '';
            $division = '';

            $nationalityNames = [
                'jordanian' => 'أردني',
                'emirati' => 'إماراتي',
                'bahraini' => 'بحريني',
                'tunisian' => 'تونسي',
                'algerian' => 'جزائري',
                'comorian' => 'جزر القمر',
                'djiboutian' => 'جيبوتي',
                'saudi' => 'سعودي',
                'sudanian' => 'سوداني',
                'syrian' => 'سوري',
                'somali' => 'صومالي',
                'iraqi' => 'عراقي',
                'omanian' => 'عماني',
                'palestinian' => 'فلسطيني',
                'qatari' => 'قطري',
                'kuwaitian' => 'كويتي',
                'lebanese' => 'لبناني',
                'libyan' => 'ليبي',
                'egyptian' => 'مصري',
                'moroccan' => 'مغربي',
                'mauritanian' => 'موريتاني',
                'yemeni' => 'يمني',
                'american' => 'أمريكي',
                'british' => 'بريطاني',
                'french' => 'فرنسي',
                'german' => 'ألماني',
                'canadian' => 'كندي',
                'australian' => 'أسترالي',
                'chinese' => 'صيني',
                'indian' => 'هندي',
                'japanese' => 'ياباني',
                'south_african' => 'جنوب أفريقي',
                'brazilian' => 'برازيلي',
                'russian' => 'روسي',
                'italian' => 'إيطالي',
                'spanish' => 'إسباني',
                'portuguese' => 'برتغالي',
                'swedish' => 'سويدي',
                'norwegian' => 'نرويجي',
                'dutch' => 'هولندي',
                'greek' => 'يوناني',
                'turkish' => 'تركي',
                'pakistani' => 'باكستاني',
                'afghan' => 'أفغاني',
                'iranian' => 'إيراني',
                'malaysian' => 'ماليزي',
                'singaporean' => 'سنغافوري',
                'vietnamese' => 'فيتنامي',
                'thai' => 'تايلاندي',
                'indonesian' => 'إندونيسي',
                'mexican' => 'مكسيكي',
                'colombian' => 'كولومبي',
                'chilean' => 'تشيلي',
                'argentinian' => 'أرجنتيني',
                'peruvian' => 'بيروفي',
            ];

            $parentsStatusNames = [
                'married' => 'متزوج',
                'divorced' => 'مطلق',
                'separated' => 'منفصل',
                'widowed' => 'أرمل/أرملة',
            ];

            $educationLevelNames = [
                'primary_school' => 'ابتدائي',
                'middle_school' => 'إعدادي',
                'high_school' => 'ثانوية عامة',
                'diploma' => 'دبلوم',
                'bachelor' => 'بكالوريوس',
                'master' => 'ماجستير',
                'phd' => 'دكتوراه',
            ];


            $bloodTypeNames = [
                'A+' => 'A+',
                'A-' => 'A-',
                'B+' => 'B+',
                'B-' => 'B-',
                'AB+' => 'AB+',
                'AB-' => 'AB-',
                'O+' => 'O+',
                'O-' => 'O-',
            ];


            $healthConditionNames = [
                'yes' => 'نعم',
                'no'  => 'لا',
            ];


            $cityNames = [
                '1' => 'عمان',
                '2' => 'إربد',
                '3' => 'الزرقاء',
                '4' => 'العقبة',
                '5' => 'مأدبا',
                '6' => 'الكرك',
                '7' => 'جرش',
                '8' => 'عجلون',
                '9' => 'المفرق',
                '10' => 'الطفيلة',
                '11' => 'معان',
                '12' => 'البلقاء',
            ];

            $AreaNames = [
                'أبو نصير',
                'شفا بدران',
                'الجبيهة',
                'طارق',
                'ماركا',
                'بسمان',
                'العبدلي',
                'تلاع العلي وأم السماق وخلدا',
                'صويلح',
                'المدينة',
                'النصر',
                'اليرموك',
                'زهران',
                'وادي السير',
                'بدر الجديدة',
                'مرج الحمام',
                'بدر',
                'راس العين',
                'القويسمة وأبو علندا والجويدة و الرقيم',
                'أم قصير والمقابلين والبنيات',
                'خريبة السوق وجاوا واليادودة',
                'احد'
            ];

            // Write the data rows
            foreach ($student_registrations as $student_registration) {

                // Map nationality to the Arabic name (previous code)
                $nationality = isset($nationalityNames[$student_registration->nationality]) ? $nationalityNames[$student_registration->nationality] : '';

                // Map parents_status to the Arabic name
                $parentsStatus = isset($parentsStatusNames[$student_registration->parents_status]) ? $parentsStatusNames[$student_registration->parents_status] : '';
                
                // Map education_level to the Arabic name
                $educationLevel = isset($educationLevelNames[$student_registration->education_level]) ? $educationLevelNames[$student_registration->education_level] : '';
                
                // Map blood_type to the Arabic name
                $bloodType = isset($bloodTypeNames[$student_registration->blood_type]) ? $bloodTypeNames[$student_registration->blood_type] : '';

                // Map health_condition to the Arabic name
                $healthCondition = isset($healthConditionNames[$student_registration->health_condition]) ? $healthConditionNames[$student_registration->health_condition] : '';

                // Map city to the Arabic name
                $city = isset($cityNames[$student_registration->city]) ? $cityNames[$student_registration->city] : '';

                // Map area to the Arabic name
                $area = isset($AreaNames[$student_registration->area]) ? $AreaNames[$student_registration->area] : '';

                $type = "معلقه";
                if($student_registration->type=='approved'){
                    $type = "مقبول";
                }


                if($student_registration->sex == 'male'){
                $sex = __('messages.male');
                }elseif($student_registration->sex == 'female'){
                    $sex =__('messages.female');
                }


                if($student_registration->division == '1'){
                    $division = 'الاشبال/الزهرات';
                }elseif($student_registration->division == '2'){
                    $division ='الكشاف/المرشدات';
                }elseif($student_registration->division == '3'){
                    $division ='المتقدم/المتقدمات';
                }elseif($student_registration->division == '4'){
                    $division ='الجواله/الدليلات';
                }elseif($student_registration->division == '5'){
                    $division ='القادة/القائدات';
                }

               
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['group_name']  = @$student_registration->Admin->group_name;
                $row['first_name']  = $student_registration->first_name;
                $row['father_name']  = $student_registration->father_name;
                $row['grandfather_name']  = $student_registration->grandfather_name;
                $row['family_name']  = $student_registration->family_name;
                $row['birth_date']  = $student_registration->birth_date;
                $row['birth_place']  = $student_registration->birth_place;
                $row['mobile_number']  = $student_registration->mobile_number;
                $row['home_number']  = $student_registration->home_number;
                $row['nationality']  = $nationality;  // Here is the nationality in Arabic
                $row['national_id']  = $student_registration->national_id;
                $row['parents_status']  = $parentsStatus;  // Parents status in Arabic
                $row['education_level']  = $educationLevel;  // Education level in Arabic
                $row['blood_type']  = $bloodType;  // Blood type in Arabic
                $row['sex'] = @$sex;
                $row['hobbies']  = $student_registration->hobbies;
                $row['health_condition_type']  = $student_registration->health_condition_type;
                $row['city']  = $city;
                $row['area']  = $area;
                $row['street']  = $student_registration->street;
                $row['nearest_teacher']  = $student_registration->nearest_teacher;
                $row['building_number']  = $student_registration->building_number;
                $row['division'] = @$division;
                $row['guardian_name']  = $student_registration->guardian_name;
                $row['guardian_phone']  = $student_registration->guardian_phone;
                $row['guardian_phone_2']  = $student_registration->guardian_phone_2;
                $row['guardian_job']  = $student_registration->guardian_job;
                $row['relative_relation']  = $student_registration->relative_relation;
                $row['guardian_place_work']  = $student_registration->guardian_place_work;
                $row['guardian_email']  = $student_registration->guardian_email;
                $row['identifier_name']  = $student_registration->identifier_name;
                $row['identifier_phone']  = $student_registration->identifier_phone;
                $row['text_note']  = $student_registration->text_note;
                $row['type']  = $type;
           
                // Write the row data to the CSV file
                fputcsv($file, array(
                    $row['group_name'],
                    $row['first_name'],
                    $row['father_name'],
                    $row['grandfather_name'],
                    $row['family_name'],
                    $row['birth_date'],
                    $row['birth_place'],
                    $row['mobile_number'],  // إضافة رقم الهاتف المحمول
                    $row['home_number'],    // إضافة رقم الهاتف المنزلي
                    $row['nationality'],    // إضافة الجنسية
                    $row['national_id'],    // إضافة الرقم الوطني
                    $row['parents_status'], // إضافة الحالة بين الأبوين
                    $row['education_level'],// إضافة المؤهل العلمي
                    $row['blood_type'],     // إضافة نوع الدم
                    $row['sex'],            // إضافة الجنس
                    $row['hobbies'],        // إضافة الهوايات
                    $row['health_condition_type'], // إضافة الأمراض المزمنة أو الظروف الصحية
                    $row['city'],           // إضافة المدينة
                    $row['area'],           // إضافة المنطقة
                    $row['street'],         // إضافة الشارع
                    $row['nearest_teacher'],// إضافة أقرب معلم
                    $row['building_number'],// إضافة رقم البناء
                    $row['division'],       // إضافة الفرقة
                    $row['guardian_name'],  // إضافة اسم ولي الأمر
                    $row['guardian_phone'], // إضافة رقم ولي الأمر 1
                    $row['guardian_phone_2'], // إضافة رقم ولي الأمر 2
                    $row['guardian_job'],   // إضافة مهنة ولي الأمر
                    $row['relative_relation'], // إضافة صلة القرابة
                    $row['guardian_place_work'], // إضافة مكان عمل ولي الأمر
                    $row['guardian_email'], // إضافة البريد الإلكتروني لولي الأمر
                    $row['identifier_name'],// إضافة اسم المعرف
                    $row['identifier_phone'], // إضافة رقم المعرف
                    $row['text_note'],      // إضافة الملاحظات
                    $row['type'],           // إضافة النوع
                ));
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

    public function encodeSecureId($id, $secretKey = 'mySuperSecretKey') {
            // Convert ID to string
            $idStr = (string) $id;

            // Calculate an HMAC signature
            $signature = hash_hmac('sha256', $idStr, $secretKey);

            // Combine "id:signature" into one string
            $combined = $idStr . ':' . $signature;

            // Base64-encode to get the final string
            // (Optionally, make it URL-safe by replacing +, /, and =)
            $encoded = base64_encode($combined);
            $urlSafe = str_replace(['+', '/', '='], ['-', '_', ''], $encoded);

            return $urlSafe;
        }




 public function ExportRegistrations(Request $request)
    {
        $userId = Auth::id();
        
        $objAdmin = Admin::find($userId);
      
        $fileName = 'student_registrations.csv';
       
        // if($objAdmin->is_super == 0){
        //     $student_registrations = StudentRegistration::where('admin_id',$objAdmin->id)->orderBy('id')->get();
        // }else{
        //     $student_registrations = StudentRegistration::orderBy('id')->get();
        // }

        $student_registrations = StudentRegistration::orderBy('id')->get();


        $student_registrations = $student_registrations->where('admin_id',$request->leader_id);
        
        
            
         


        

        // Set the response headers with the correct character encoding
        $headers = array(
            "Content-type"        => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        // If you need to display Arabic column header, make sure to encode it as well
        $columns = array(__('messages.scout_group'),__('messages.first_name'),__('messages.father_name'),__('messages.grandfather_name'),__('messages.family_name'),__('messages.birth_date'),__('messages.birth_place'),
        'رقم الهاتف','رقم المنزل','الجنسية','الرقم الوطني','الحالة بين الأبوين','المؤهل العلمي','نوع الدم','الجنس','الهوايات','ما هي الأمراض مزمنة أو الظروف الصحية','المدينة','المنطقة','اسم الشارع','أقرب معلم',
        'رقم البناء','الفرقة','اسم ولي الأمر','رقم ولي الأمر 1','رقم ولي الأمر 2','مهنة ولي الأمر','صلة القرابة','مكان عمل ولي الأمر','البريد الإلكتروني لولي الأمر','اسم المعرف','رقم المعرف','الملاحظات','الحاله'
       );

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($student_registrations, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            $sex = '';
            $division = '';
            $nationalityNames = [
                'jordanian' => 'أردني',
                'emirati' => 'إماراتي',
                'bahraini' => 'بحريني',
                'tunisian' => 'تونسي',
                'algerian' => 'جزائري',
                'comorian' => 'جزر القمر',
                'djiboutian' => 'جيبوتي',
                'saudi' => 'سعودي',
                'sudanian' => 'سوداني',
                'syrian' => 'سوري',
                'somali' => 'صومالي',
                'iraqi' => 'عراقي',
                'omanian' => 'عماني',
                'palestinian' => 'فلسطيني',
                'qatari' => 'قطري',
                'kuwaitian' => 'كويتي',
                'lebanese' => 'لبناني',
                'libyan' => 'ليبي',
                'egyptian' => 'مصري',
                'moroccan' => 'مغربي',
                'mauritanian' => 'موريتاني',
                'yemeni' => 'يمني',
                'american' => 'أمريكي',
                'british' => 'بريطاني',
                'french' => 'فرنسي',
                'german' => 'ألماني',
                'canadian' => 'كندي',
                'australian' => 'أسترالي',
                'chinese' => 'صيني',
                'indian' => 'هندي',
                'japanese' => 'ياباني',
                'south_african' => 'جنوب أفريقي',
                'brazilian' => 'برازيلي',
                'russian' => 'روسي',
                'italian' => 'إيطالي',
                'spanish' => 'إسباني',
                'portuguese' => 'برتغالي',
                'swedish' => 'سويدي',
                'norwegian' => 'نرويجي',
                'dutch' => 'هولندي',
                'greek' => 'يوناني',
                'turkish' => 'تركي',
                'pakistani' => 'باكستاني',
                'afghan' => 'أفغاني',
                'iranian' => 'إيراني',
                'malaysian' => 'ماليزي',
                'singaporean' => 'سنغافوري',
                'vietnamese' => 'فيتنامي',
                'thai' => 'تايلاندي',
                'indonesian' => 'إندونيسي',
                'mexican' => 'مكسيكي',
                'colombian' => 'كولومبي',
                'chilean' => 'تشيلي',
                'argentinian' => 'أرجنتيني',
                'peruvian' => 'بيروفي',
            ];

            $parentsStatusNames = [
                'married' => 'متزوج',
                'divorced' => 'مطلق',
                'separated' => 'منفصل',
                'widowed' => 'أرمل/أرملة',
            ];

            $educationLevelNames = [
                'primary_school' => 'ابتدائي',
                'middle_school' => 'إعدادي',
                'high_school' => 'ثانوية عامة',
                'diploma' => 'دبلوم',
                'bachelor' => 'بكالوريوس',
                'master' => 'ماجستير',
                'phd' => 'دكتوراه',
            ];


            $bloodTypeNames = [
                'A+' => 'A+',
                'A-' => 'A-',
                'B+' => 'B+',
                'B-' => 'B-',
                'AB+' => 'AB+',
                'AB-' => 'AB-',
                'O+' => 'O+',
                'O-' => 'O-',
            ];


            $healthConditionNames = [
                'yes' => 'نعم',
                'no'  => 'لا',
            ];


            $cityNames = [
                '1' => 'عمان',
                '2' => 'إربد',
                '3' => 'الزرقاء',
                '4' => 'العقبة',
                '5' => 'مأدبا',
                '6' => 'الكرك',
                '7' => 'جرش',
                '8' => 'عجلون',
                '9' => 'المفرق',
                '10' => 'الطفيلة',
                '11' => 'معان',
                '12' => 'البلقاء',
            ];

            $AreaNames = [
                'أبو نصير',
                'شفا بدران',
                'الجبيهة',
                'طارق',
                'ماركا',
                'بسمان',
                'العبدلي',
                'تلاع العلي وأم السماق وخلدا',
                'صويلح',
                'المدينة',
                'النصر',
                'اليرموك',
                'زهران',
                'وادي السير',
                'بدر الجديدة',
                'مرج الحمام',
                'بدر',
                'راس العين',
                'القويسمة وأبو علندا والجويدة و الرقيم',
                'أم قصير والمقابلين والبنيات',
                'خريبة السوق وجاوا واليادودة',
                'احد'
            ];

            // Write the data rows
            foreach ($student_registrations as $student_registration) {

                // Map nationality to the Arabic name (previous code)
                $nationality = isset($nationalityNames[$student_registration->nationality]) ? $nationalityNames[$student_registration->nationality] : '';

                // Map parents_status to the Arabic name
                $parentsStatus = isset($parentsStatusNames[$student_registration->parents_status]) ? $parentsStatusNames[$student_registration->parents_status] : '';
                
                // Map education_level to the Arabic name
                $educationLevel = isset($educationLevelNames[$student_registration->education_level]) ? $educationLevelNames[$student_registration->education_level] : '';
                
                // Map blood_type to the Arabic name
                $bloodType = isset($bloodTypeNames[$student_registration->blood_type]) ? $bloodTypeNames[$student_registration->blood_type] : '';

                // Map health_condition to the Arabic name
                $healthCondition = isset($healthConditionNames[$student_registration->health_condition]) ? $healthConditionNames[$student_registration->health_condition] : '';

                // Map city to the Arabic name
                $city = isset($cityNames[$student_registration->city]) ? $cityNames[$student_registration->city] : '';

                // Map area to the Arabic name
                $area = isset($AreaNames[$student_registration->area]) ? $AreaNames[$student_registration->area] : '';


                $type = "معلقه";
                if($student_registration->type=='approved'){
                    $type = "مقبول";
                }

                if($student_registration->sex == 'male'){
                $sex = __('messages.male');
                }elseif($student_registration->sex == 'female'){
                    $sex =__('messages.female');
                }


                if($student_registration->division == '1'){
                    $division = 'الاشبال/الزهرات';
                }elseif($student_registration->division == '2'){
                    $division ='الكشاف/المرشدات';
                }elseif($student_registration->division == '3'){
                    $division ='المتقدم/المتقدمات';
                }elseif($student_registration->division == '4'){
                    $division ='الجواله/الدليلات';
                }elseif($student_registration->division == '5'){
                    $division ='القادة/القائدات';
                }

               
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['group_name']  = @$student_registration->Admin->group_name;
                $row['first_name']  = $student_registration->first_name;
                $row['father_name']  = $student_registration->father_name;
                $row['grandfather_name']  = $student_registration->grandfather_name;
                $row['family_name']  = $student_registration->family_name;
                $row['birth_date']  = $student_registration->birth_date;
                $row['birth_place']  = $student_registration->birth_place;
                $row['mobile_number']  = $student_registration->mobile_number;
                $row['home_number']  = $student_registration->home_number;
                $row['nationality']  = $nationality;  // Here is the nationality in Arabic
                $row['national_id']  = $student_registration->national_id;
                $row['parents_status']  = $parentsStatus;  // Parents status in Arabic
                $row['education_level']  = $educationLevel;  // Education level in Arabic
                $row['blood_type']  = $bloodType;  // Blood type in Arabic
                $row['sex'] = @$sex;
                $row['hobbies']  = $student_registration->hobbies;
                $row['health_condition_type']  = $student_registration->health_condition_type;
                $row['city']  = $city;
                $row['area']  = $area;
                $row['street']  = $student_registration->street;
                $row['nearest_teacher']  = $student_registration->nearest_teacher;
                $row['building_number']  = $student_registration->building_number;
                $row['division'] = @$division;
                $row['guardian_name']  = $student_registration->guardian_name;
                $row['guardian_phone']  = $student_registration->guardian_phone;
                $row['guardian_phone_2']  = $student_registration->guardian_phone_2;
                $row['guardian_job']  = $student_registration->guardian_job;
                $row['relative_relation']  = $student_registration->relative_relation;
                $row['guardian_place_work']  = $student_registration->guardian_place_work;
                $row['guardian_email']  = $student_registration->guardian_email;
                $row['identifier_name']  = $student_registration->identifier_name;
                $row['identifier_phone']  = $student_registration->identifier_phone;
                $row['text_note']  = $student_registration->text_note;
                $row['type']  = $type;
             
                // Write the row data to the CSV file
                fputcsv($file, array(
                    $row['group_name'],
                    $row['first_name'],
                    $row['father_name'],
                    $row['grandfather_name'],
                    $row['family_name'],
                    $row['birth_date'],
                    $row['birth_place'],
                    $row['mobile_number'],  // إضافة رقم الهاتف المحمول
                    $row['home_number'],    // إضافة رقم الهاتف المنزلي
                    $row['nationality'],    // إضافة الجنسية
                    $row['national_id'],    // إضافة الرقم الوطني
                    $row['parents_status'], // إضافة الحالة بين الأبوين
                    $row['education_level'],// إضافة المؤهل العلمي
                    $row['blood_type'],     // إضافة نوع الدم
                    $row['sex'],            // إضافة الجنس
                    $row['hobbies'],        // إضافة الهوايات
                    $row['health_condition_type'], // إضافة الأمراض المزمنة أو الظروف الصحية
                    $row['city'],           // إضافة المدينة
                    $row['area'],           // إضافة المنطقة
                    $row['street'],         // إضافة الشارع
                    $row['nearest_teacher'],// إضافة أقرب معلم
                    $row['building_number'],// إضافة رقم البناء
                    $row['division'],       // إضافة الفرقة
                    $row['guardian_name'],  // إضافة اسم ولي الأمر
                    $row['guardian_phone'], // إضافة رقم ولي الأمر 1
                    $row['guardian_phone_2'], // إضافة رقم ولي الأمر 2
                    $row['guardian_job'],   // إضافة مهنة ولي الأمر
                    $row['relative_relation'], // إضافة صلة القرابة
                    $row['guardian_place_work'], // إضافة مكان عمل ولي الأمر
                    $row['guardian_email'], // إضافة البريد الإلكتروني لولي الأمر
                    $row['identifier_name'],// إضافة اسم المعرف
                    $row['identifier_phone'], // إضافة رقم المعرف
                    $row['text_note'],      // إضافة الملاحظات
                    $row['type'],           // إضافة النوع
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



}