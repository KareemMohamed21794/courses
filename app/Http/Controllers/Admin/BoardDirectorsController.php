<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoardDirector;
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

class BoardDirectorsController extends Controller
{
    private const MODEL ='BoardDirector';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('messages.board_director');
        $add_title = __('messages.board_director');

        $ids = BoardDirector::select('admin_id')->groupBy('admin_id')->pluck('admin_id')->toArray();


        $leaders = Admin::where('is_super',0)->get();


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $added = "";

        if($objAdmin->position_id == 1  || $objAdmin->position_id == 3){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
            $can_accept = 1;
            $can_reject = 1;
        }


        if($objAdmin->position_id == 4){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
            $can_accept = 0;
            $can_reject = 0;
        }


        if($objAdmin->position_id ==2){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 0;
            $can_accept = 0;
            $can_reject = 0;

            $added = BoardDirector::where('admin_id',$objAdmin->id)->first();
        }



        if($objAdmin->is_super == 0){
        BoardDirector::where('admin_id', $objAdmin->id)
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        BoardDirector::withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
         
        }
         

        return view('auth.admin.board_directors.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders, 'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print, 'can_accept'=>$can_accept, 'can_reject'=>$can_reject,'added'=>$added]);
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
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
         
        
        //$this->authorize(self::MODEL.'-store');
         // print_r('here'); die;
        $validator = Validator::make($request->all(),[
            'leader_id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'family_name' => ['required', 'string', 'max:255'],
            'job' => ['required', 'string', 'max:255'],
            'mission' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required'],
            'mobile_number' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        // Check if the admin already exists
        $exsist_admin =  BoardDirector::where('admin_id', $request->leader_id)->first();

        if ($exsist_admin) {
            return response()->json(['error' => 'This user already exists as a Board Director.'], Response::HTTP_BAD_REQUEST);
        }


        $BoardDirector = BoardDirector::create([
            'first_name' =>  $request->first_name,
            'father_name' =>  $request->father_name,
            'family_name' =>  $request->family_name,
            'job' =>  $request->job,
            'mission' =>  $request->mission,
            'birth_place' =>  $request->birth_place,
            'birth_date' =>  $request->birth_date,
            'mobile_number' =>  $request->mobile_number,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            
        ]);


        $this->logAction(auth()->id(), 'user', 'add_BoardDirector', 'create', 'board_directors', $BoardDirector->id);


       
        return response()->json(['BoardDirector'=>$BoardDirector]);
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
        $BoardDirector  = BoardDirector::find($id);
        @$BoardDirector->Admin;

        return response()->json($BoardDirector);
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
       // print_r($request->all());die;
            $validator = Validator::make($request->all(),[
               'first_name' => ['required', 'string', 'max:255'],
                'father_name' => ['required', 'string', 'max:255'],
                'family_name' => ['required', 'string', 'max:255'],
                'job' => ['required', 'string', 'max:255'],
                'mission' => ['required', 'string', 'max:255'],
                'birth_place' => ['required', 'string', 'max:255'],
                'birth_date' => ['required'],
                'mobile_number' => ['required', 'string', 'max:255'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        // Check if the admin already exists
        $exsist_admin =  BoardDirector::where('admin_id', $request->leader_id)->where('id','!=',$id)->first();
        if ($exsist_admin) {
            return response()->json(['error' => 'This user already exists as a Board Director.'], Response::HTTP_BAD_REQUEST);
        }

       
        $userId = Auth::id();
        $objBoardDirector = BoardDirector::find($id);
        $objBoardDirector->admin_id = $request->leader_id ? $request->leader_id : $userId;
        $objBoardDirector->first_name =  $request->first_name;
        $objBoardDirector->father_name =  $request->father_name;
        $objBoardDirector->family_name =  $request->family_name;
        $objBoardDirector->job =  $request->job;
        $objBoardDirector->mission =  $request->mission;
        $objBoardDirector->birth_place =  $request->birth_place;
        $objBoardDirector->birth_date =  $request->birth_date;
        $objBoardDirector->mobile_number =  $request->mobile_number;
       
        $objBoardDirector->save();


        $this->logAction(auth()->id(), 'user', 'update_BoardDirector', 'update', 'board_directors', $objBoardDirector->id);
        return response()->json(['objBoardDirector'=>$objBoardDirector]);
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
        $BoardDirector = BoardDirector::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_BoardDirector', 'delete', 'board_directors', $id);
        return response()->json(['BoardDirector'=>$BoardDirector]);
    }

     public function deleteBoardDirectors(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $BoardDirector = BoardDirector::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_BoardDirector', 'delete', 'board_directors', $id);
        }

        return response()->json(['BoardDirector'=>$BoardDirector]);
    }


    public function get(Request $request)
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
            'mission'=>true,
            'birth_place'=>true,
            'birth_date'=>true,
            'mobile_number'=>true,
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


        if($objAdmin->is_super == 1|| $objAdmin->position_id == 4|| $objAdmin->position_id == 3){

           $alldata = BoardDirector::whereBetween('created_at',[$first_day_year,$last_day_year])->get();
        
            if($active=='All'){
                $alldata = BoardDirector::withTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = BoardDirector::get();
            }
            elseif($active=='DeActive'){
                $alldata = BoardDirector::onlyTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
        }else{

            $alldata = BoardDirector::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            if($active=='All'){
                $alldata = BoardDirector::withTrashed()->where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = BoardDirector::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = BoardDirector::onlyTrashed()->where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }



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
                "family_name" =>$objdata->family_name,
                "job" =>$objdata->job,
                "mission"=>$objdata->mission,
                "birth_place"=>$objdata->birth_place,
                "birth_date"=>Date('Y-m-d',strtotime($objdata->birth_date)),
                "mobile_number"=>$objdata->mobile_number,
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

    public function accept_permit(Request $request, $id)
    {
         
    
        $objPermit = Permit::find($id);
        $objPermit->status = "approved";       
        $objPermit->save();

        $this->logAction(auth()->id(), 'user', 'accept_permit', 'accepted', 'permits', $objPermit->id);


        if(!empty($objPermit->admin->email)){

            # send email 
            //$recipient = $problem->staff->email;
            // $recipient = "mahmoud.ali.29992@gmail.com";
            // $subject = "الرد على طلب: $objPermit->number_order ";

            // $data = ['number_order' => $objPermit->number_order,'group_name' => $objPermit->admin->group_name]; // Data to pass to the view

            // // Generate the HTML body from the Blade view
            // $htmlBody = view('emails.permits_accept', $data)->render();

            // $payload = json_encode([
            //     "from" => ["address" => 'info@lawjo.net', "name" => "test"],
            //     "to" => [["email_address" => ["address" => $recipient, "name" => $objPermit->admin->group_name]]],
            //     "subject" => $subject,
            //     "htmlbody" => $htmlBody,
            // ]);

            // $curl = curl_init();
            // curl_setopt_array($curl, [
            //     CURLOPT_URL => "https://api.zeptomail.com/v1.1/email",
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => "",
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 30,
            //     CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => "POST",
            //     CURLOPT_POSTFIELDS => $payload,
            //     CURLOPT_HTTPHEADER => [
            //         "accept: application/json",
            //         "authorization: Zoho-enczapikey wSsVR60grBbzXf98nGf7dewxzw8EAlPzRE19i1So4iL9G63C9Mc4xUadBAKiHvFLEmJgRTQV9bt/nUxR12Bfh9wrzwkGACiF9mqRe1U4J3x17qnvhDzMXmxcmxuKKokIxwVqmGVgG8wg+g==",
            //         "cache-control: no-cache",
            //         "content-type: application/json",
            //     ],
            // ]);

            // $response = curl_exec($curl);
            // $err = curl_error($curl);

            // curl_close($curl);

            // if ($err) {
            //     echo "cURL Error #:" . $err;
            // } else {
            //     echo $response;
            // }




            $recipient = $objPermit->admin->email;
            //$recipient = 'mahmoud.ali.29992@gmail.com';
            $subject = "الرد على طلب: $objPermit->number_order ";

            $data = ['number_order' => $objPermit->number_order,'group_name' => $objPermit->admin->group_name]; // Data to pass to the view

            $fromEmail = 'noreply@privatescouts.org'; 
            // The "from" email address

            Mail::send('emails.permits_accept', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                $mail->to($recipient)
                    ->from($fromEmail) // Set the "from" email address
                    ->subject($subject);
            });
        }


        return redirect('/admin/permits');

    }

    public function reject_permit(Request $request, $id)
    {
         

        $objPermit = Permit::find($id);
        $objPermit->status = "rejected";       
        $objPermit->save();
        $this->logAction(auth()->id(), 'user', 'reject_permit', 'rejected', 'permits', $objPermit->id);

        if(!empty($objPermit->admin->email)){
            $recipient = $objPermit->admin->email;
            //$recipient = 'mahmoud.ali.29992@gmail.com';
            $subject = "الرد على طلب: $objPermit->number_order ";

            $data = ['number_order' => $objPermit->number_order,'group_name' => $objPermit->admin->group_name]; // Data to pass to the view

            $fromEmail = 'noreply@privatescouts.org'; 
            // The "from" email address

            Mail::send('emails.permits_reject', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                $mail->to($recipient)
                    ->from($fromEmail) // Set the "from" email address
                    ->subject($subject);
            });
        }
        


        


        return redirect('/admin/permits');

    }

 
    public function download_approvement($id)
    {
        $title = 'تصريح نشاط' ;
        $objPermit = Permit::find($id);
        return view('auth.admin.permits.download_approve_form',['title' => $title,'objPermit'=>$objPermit]);
    }



    public function total_permits()
    {
        $title = __('messages.Total_activity_permit_fees');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        
        if($objAdmin->position_id == 1 || $objAdmin->position_id == 3 || $objAdmin->position_id == 4 || $objAdmin->position_id == 6){
            $sum = Permit::join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
            ->sum('type_activity.price');
       }else{
            $sum = Permit::where('admin_id', $objAdmin->id)
            ->join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
            ->sum('type_activity.price');
        
       }

       

        
        return view('auth.admin.permits.total_permits',['title' => $title,'sum'=>$sum]);
    }


       public function get_totall_permits(Request $request)
    { 
        
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'activity_name'=> true,
            'nature_activity'=>true,
            'permit_number'=>true,
            'price'=>true,
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
        if($objAdmin->position_id == 1 || $objAdmin->position_id == 3 || $objAdmin->position_id == 4 || $objAdmin->position_id == 6){

           $alldata = DB::table('permits')
            ->select('permits.admin_id','admins.group_name', DB::raw('SUM(type_activity.price) as price'))
            ->join('admins', 'admins.id', '=', 'permits.admin_id')
            ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
            ->groupBy('permits.admin_id','admins.group_name')
            ->get();
        
        }else{

            $alldata = DB::table('permits')
            ->where('admin_id',$userId)
            ->select('permits.admin_id','admins.group_name', DB::raw('SUM(type_activity.price) as price'))
            ->join('admins', 'admins.id', '=', 'permits.admin_id')
            ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
            ->groupBy('permits.admin_id','admins.group_name')
            ->get();
           
        }

        $alldataResult=array();

        foreach($alldata as $key=> $objdata){

            $alldataResult[] = array(
                
                "order" => $key+1,
               
                "leader" => @$objdata->group_name,
               
                "price"=> @$objdata->price,
              
            );
        }

       $alldata =$alldataResult ;
        $data = [];
        // internal use; filter selected columns only from raw data
        foreach ( $alldata as $d ) {
            $data[] = $this->filterArrayTotal( $d, $columnsDefault );
        }

        // count data
        $totalRecords = $totalDisplay = count( $data );

        // filter by general search keyword
        if ( isset( $request->search ) ) {
            $data         =  $this->filterKeywordTotal( $data, $request->search );
            $totalDisplay = count( $data );
        }

        if ( isset( $request->columns ) && is_array( $request->columns ) ) {
            foreach ( $request->columns as $column ) {
                if ( isset( $column['search'] ) ) {
                    $data         =  $this->filterKeywordTotal( $data, $column['search'], $column['data'] );
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

    function filterArrayTotal( $array, $allowed = [] ) {
        return array_filter(
            $array,
            function ( $val, $key ) use ( $allowed ) { // N.b. $val, $key not $key, $val
                return isset( $allowed[ $key ] ) && ( $allowed[ $key ] === true || $allowed[ $key ] === $val );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    function filterKeywordTotal( $data, $search, $field = '' ) {
        $filter = '';
        if ( isset( $search['value'] ) ) {
            $filter = $search['value'];
        }
        if ( ! empty( $filter ) ) {
            if ( ! empty( $field ) ) {
                if ( strpos( strtolower( $field ), 'date' ) !== false ) {
                    // filter by date range
                    $data = filterByDateRangeTotal( $data, $filter, $field );
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

    function filterByDateRangeTotal( $data, $filter, $field ) {
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



     public function ReportArchivepermits()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.archive_permits') ;
        
        return view('auth.admin.permits.report_archive_permits', [
            'title' => $title,
        ]);
    }



    public function ReportArchivepermitsGet()
    {
        $year = @$_GET['year'];
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       
        $title = __('messages.archive_permits') . ' - ' . 'سنة ' .$year;

        return view('auth.admin.permits.report_archive_permits_get', ['title' => $title,'year' => $year]);
    }



    public function report_archive_permits_get_list(Request $request)
    {
       

        ini_set('memory_limit', '-1');

        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'activity_name'=> true,
            'nature_activity'=>true,
            // 'activity_description'=>true,
            'place_activity' =>true,
            'activity_history' =>true,
            'number_days'=>true,
            'alwahda'=>true,
            // 'alwahda_description'=>true,
            'activity_leader'=>true,
            'number_leader'=>true,
            'permit_status'=>true,
            'permit_number'=>true,
            
            'created_at'   => true,
        ];


        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }

        
        // Set the first day of the provided year at midnight (00:00:00)
        $first_day_year = date('Y-m-d 00:00:00', strtotime("first day of january $request->year"));

        // Set the last day of the provided year at 23:59:59
        $last_day_year = $request->year . '-12-31 23:59:59';

        $title = __('messages.archive_advertisements');

        // Fetch all advertisements where the created_at date is between the first and last day of the provided year
        $alldata = Permit::with('TypeActivity')->whereBetween('created_at',[$first_day_year,$last_day_year])->get();

       

        $alldataResult=array();

        foreach($alldata as $key=> $objdata){


            $nature_activity = '';
            if($objdata->nature_activity == "camp"){
                $nature_activity = 'مخيم';
            }elseif ($objdata->nature_activity == "trip") {
                $nature_activity = 'رحلة';
            }elseif ($objdata->nature_activity == "marching") {
                $nature_activity = 'مسير';
            }elseif ($objdata->nature_activity == "overnight") {
                $nature_activity = 'مبيت';
            }elseif ($objdata->nature_activity == "evening") {
                $nature_activity = 'امسيه';
            }elseif ($objdata->nature_activity == "other") {
                $nature_activity = 'اخرى';
            }



            $alwahda = '';
            if (is_array($objdata->alwahda)) {
                // If alwahda is an array, map each value to its corresponding Arabic value
                $alwahda = array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $objdata->alwahda);
                $alwahda = implode(', ', $alwahda); // Convert the array back to a comma-separated string
            } else {
                // If alwahda is a single comma-separated string, split it and map each value
                $alwahdaValues = explode(',', $objdata->alwahda);
                $alwahda = implode(', ', array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $alwahdaValues));
            }


            if($objdata->status=='pending'){
                $status = "معلقه";
            }elseif ($objdata->status=='approved') {
                $status = "<span style='color:green;font-weight:bold'>مقبول</span>" . "<br><a target='_blank' href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";

                if($objAdmin->is_super == 0){
 
                    $status = "<a target='_blank' href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";
                }

            }
            elseif ($objdata->status=='rejected') {
                $status = "<span style='color:red;font-weight:bold'>مرفوض</span>";
            }

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "activity_name"=> $objdata->activity_name,
                "nature_activity"=> @$objdata->TypeActivity->name_ar,
                // "activity_description"=> $objdata->activity_description,
                "place_activity" =>$objdata->place_activity,
                "activity_history" =>$objdata->activity_history,
                "number_days" =>$objdata->number_days,
                "alwahda" => $alwahda,
                // "alwahda_description"=>$objdata->alwahda_description,
                "activity_leader"=>$objdata->activity_leader,
                "number_leader"=>$objdata->number_leader,
                "permit_status"=>$status,
                "permit_number"=>$objdata->permit_number,
                
                "created_at" => Date('Y-m-d',strtotime($objdata->created_at)),
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




    public function ReportPermits()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_permits');
        $leaders = Admin::where('is_super','!=',1)->get();
        return view('auth.admin.permits.report_permits', [
            'title' => $title,
            'leaders' => $leaders,
        ]);
    }



    public function ReportPermitsGet()
    {
        

        
        $leader_id = @$_GET['leader_id'];
      
        $objAdmin_data = Admin::find($leader_id);
        $obj_admin_name = $objAdmin_data ? $objAdmin_data->group_name : 'الكل';
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.report_permits'). ' - ' .$obj_admin_name;

        return view('auth.admin.permits.report_permits_get', ['title' => $title,'leader_id' => $leader_id]);
    }



    public function ReportPermitsGetlist(Request $request)
    {
       

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'leader'   => true,
            'activity_name'=> true,
            'nature_activity'=>true,
            // 'activity_description'=>true,
            'place_activity' =>true,
            'activity_history' =>true,
            'number_days'=>true,
            'alwahda'=>true,
            // 'alwahda_description'=>true,
            'activity_leader'=>true,
            'number_leader'=>true,
            'permit_status'=>true,
            'permit_number'=>true,
            
            'created_at'   => true,
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }


        $alldata = Permit::with('TypeActivity')->get();
       
        $title = __('messages.report_permits');
        
        if($request->leader_id){
            $alldata = $alldata->where('admin_id',$request->leader_id);
        } 



        $alldataResult=array();

        foreach($alldata as $key=> $objdata){


            $nature_activity = '';
            if($objdata->nature_activity == "camp"){
                $nature_activity = 'مخيم';
            }elseif ($objdata->nature_activity == "trip") {
                $nature_activity = 'رحلة';
            }elseif ($objdata->nature_activity == "marching") {
                $nature_activity = 'مسير';
            }elseif ($objdata->nature_activity == "overnight") {
                $nature_activity = 'مبيت';
            }elseif ($objdata->nature_activity == "evening") {
                $nature_activity = 'امسيه';
            }elseif ($objdata->nature_activity == "other") {
                $nature_activity = 'اخرى';
            }



            $alwahda = '';
            if (is_array($objdata->alwahda)) {
                // If alwahda is an array, map each value to its corresponding Arabic value
                $alwahda = array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $objdata->alwahda);
                $alwahda = implode(', ', $alwahda); // Convert the array back to a comma-separated string
            } else {
                // If alwahda is a single comma-separated string, split it and map each value
                $alwahdaValues = explode(',', $objdata->alwahda);
                $alwahda = implode(', ', array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $alwahdaValues));
            }


            if($objdata->status=='pending'){
                $status = "معلقه";
            }elseif ($objdata->status=='approved') {
                $status = "<span style='color:green;font-weight:bold'>مقبول</span>" . "<br><a target='_blank' href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";

                if($objAdmin->is_super == 0){
 
                    $status = "<a target='_blank' href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";
                }

            }
            elseif ($objdata->status=='rejected') {
                $status = "<span style='color:red;font-weight:bold'>مرفوض</span>";
            }

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "activity_name"=> $objdata->activity_name,
                "nature_activity"=> @$objdata->TypeActivity->name_ar,
                // "activity_description"=> $objdata->activity_description,
                "place_activity" =>$objdata->place_activity,
                "activity_history" =>$objdata->activity_history,
                "number_days" =>$objdata->number_days,
                "alwahda" => $alwahda,
                // "alwahda_description"=>$objdata->alwahda_description,
                "activity_leader"=>$objdata->activity_leader,
                "number_leader"=>$objdata->number_leader,
                "permit_status"=>$status,
                "permit_number"=>$objdata->permit_number,
                
                "created_at" => Date('Y-m-d',strtotime($objdata->created_at)),
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



    public function ExportPermits(Request $request)
    {
      

        $fileName = 'permits.csv';
        $permits = Permit::with('TypeActivity')->get();
        
            
            if($request->leader_id){

                $permits = $permits->where('admin_id',$request->leader_id);
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
        $columns = array(__('messages.scout_group'),__('messages.activity_name'),__('messages.nature_activity'),__('messages.place_activity'),__('messages.activity_history'),__('messages.number_days'),__('messages.alwahda'),__('messages.activity_leader'),__('messages.number_leader'),__('messages.permit_status'),__('messages.permit_number'),__('messages.created_at'));

        // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
        $callback = function() use ($permits, $columns) {
            $file = fopen('php://output', 'w');

            // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
            fputs($file, "\xEF\xBB\xBF");

            // Write the column headers
            fputcsv($file, $columns);

            // Write the data rows
            foreach ($permits as $objdata) {


                $alwahda = '';
            if (is_array($objdata->alwahda)) {
                // If alwahda is an array, map each value to its corresponding Arabic value
                $alwahda = array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $objdata->alwahda);
                $alwahda = implode(', ', $alwahda); // Convert the array back to a comma-separated string
            } else {
                // If alwahda is a single comma-separated string, split it and map each value
                $alwahdaValues = explode(',', $objdata->alwahda);
                $alwahda = implode(', ', array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $alwahdaValues));
            }


            if($objdata->status=='pending'){
                $status = "معلقه";
            }elseif ($objdata->status=='approved') {
                $status = "مقبول";
            }
            elseif ($objdata->status=='rejected') {
                $status = "مرفوض ";
            }
               
                // Make sure to retrieve the Arabic name correctly from your database column
                $row['scout_group']  = @$objdata->Admin->group_name;
                $row['activity_name']  = $objdata->activity_name;
                $row['nature_activity']  = $objdata->TypeActivity->name_ar;
                $row['place_activity']  = $objdata->place_activity;
                $row['activity_history']  = $objdata->activity_history;
                $row['number_days']  = $objdata->number_days;
                $row['alwahda']  = $alwahda;
                $row['activity_leader']  = $objdata->activity_leader;
                $row['number_leader']  = $objdata->number_leader;
                $row['permit_status']  = $status;
                $row['permit_number']  = $objdata->permit_number;
                $row['created_at']  = Date('Y-m-d',strtotime($objdata->created_at));
                // Write the row data to the CSV file
                fputcsv($file, array($row['scout_group'],$row['activity_name'],$row['nature_activity'],$row['place_activity'],$row['activity_history'],$row['number_days'],$row['alwahda'],$row['activity_leader'],$row['number_leader'],$row['permit_status'],$row['permit_number'],$row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    
}
