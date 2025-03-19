<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permit;
use App\Models\TypeActivity;
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
        $add_title = __('messages.permit');

        $leaders = Admin::where('is_super',0)->whereNotNull('group_classification')->whereNull('deleted_at')->get();


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

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
            $can_update = 0;
            $can_delete = 0;
            $can_print = 0;
            $can_accept = 0;
            $can_reject = 0;
        }

      

        $registration_number = $objAdmin->registration_number;
        
        $Permit_count = Permit::withTrashed()->count();
        //print_r($Permit_count) ; die;
        $Permit_count = $Permit_count+1000;

        $fourDigitCount = str_pad($Permit_count, 4, '0', STR_PAD_LEFT);

        $permit_number = "م ق أ /$registration_number/ $fourDigitCount";

        $arrTypeActivity = TypeActivity::orderBy('id')->get();
        

        ///// update read 


        if($objAdmin->is_super == 0){
        Permit::where('admin_id', $objAdmin->id)
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        Permit::withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
         
        }
         

        return view('auth.admin.permits.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders, 'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print, 'can_accept'=>$can_accept, 'can_reject'=>$can_reject, 'permit_number'=>$permit_number,'arrTypeActivity'=>$arrTypeActivity]);
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
            'activity_name' => ['required', 'string', 'max:255'],
            'nature_activity' => ['required'],
            'place_activity' => ['required', 'string', 'max:255'],
            'activity_history' => ['required'],
            'number_days' => ['required'],
            'alwahda' => ['required'],
            'activity_leader' => ['required', 'string', 'max:255'],
            'number_leader' => ['required'],
            'leaders_names' => ['required'],
            'number_participants' => ['required'],
            'number_order' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        

        $Permit = Permit::create([
            'permit_number' =>  $request->permit_number,
            'activity_name' =>  $request->activity_name,
            'nature_activity' =>  $request->nature_activity,
            'activity_description' =>  $request->activity_description,
            'place_activity' =>  $request->place_activity,
            'activity_history' =>  $request->activity_history,
            'number_days' =>  $request->number_days,
            'alwahda' => implode(',', $request->alwahda),
            'alwahda_description' =>  $request->alwahda_description,
            'activity_leader' =>  $request->activity_leader,
            'number_leader' =>  $request->number_leader,
            'number_participants' =>  $request->number_participants,
            'number_order' =>  $request->number_order,
            'leaders_names' =>  $request->leaders_names,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            
        ]);


        $this->logAction(auth()->id(), 'user', 'add_permit', 'create', 'permits', $Permit->id);


        $recipient = 'admin@tawasol.com';
        //$recipient = 'mahmoud.ali.29992@gmail.com';
        $subject = 'طلب تصريح';

        $data = ['group_name' => $objAdmin->group_name]; // Data to pass to the view

        $fromEmail = 'admin@tawasol.privatescouts.org'; 
        // The "from" email address

        Mail::send('emails.permits_request', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
            $mail->to($recipient)
                ->from($fromEmail) // Set the "from" email address
                ->subject($subject);
        });

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
        @$Permit->Admin;

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
       // print_r($request->all());die;
            $validator = Validator::make($request->all(),[
               'activity_name' => ['required', 'string', 'max:255'],
                'nature_activity' => ['required'],
                'place_activity' => ['required', 'string', 'max:255'],
                'activity_history' => ['required'],
                'number_days' => ['required'],
                'alwahda' => ['required'],
                'activity_leader' => ['required', 'string', 'max:255'],
                'number_leader' => ['required'],
                'leaders_names' => ['required'],
                'number_participants' => ['required'],
                'number_order' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $secondary_registration = '';
        $userId = Auth::id();

 

        $objPermit = Permit::find($id);
        $objPermit->admin_id = $request->leader_id ? $request->leader_id : $userId;
        $objPermit->activity_name =  $request->activity_name;
        $objPermit->nature_activity =  $request->nature_activity;
        $objPermit->activity_description =  $request->activity_description;
        $objPermit->place_activity =  $request->place_activity;
        $objPermit->activity_history =  $request->activity_history;
        $objPermit->number_days =  $request->number_days;
        $objPermit->alwahda =  implode(',', $request->alwahda);
        $objPermit->alwahda_description =  $request->alwahda_description;
        $objPermit->activity_leader =  $request->activity_leader;
        $objPermit->number_leader =  $request->number_leader;
        $objPermit->number_participants =  $request->number_participants;
        $objPermit->number_order =  $request->number_order;
        $objPermit->leaders_names =  $request->leaders_names;
       
        $objPermit->save();


        $this->logAction(auth()->id(), 'user', 'update_permit', 'update', 'permits', $objPermit->id);
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
        $this->logAction(auth()->id(), 'user', 'delete_permit', 'delete', 'permits', $id);
        return response()->json(['Permit'=>$Permit]);
    }

     public function deletepermits(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        $Permit = Permit::whereIn('id',$request->ids)->delete();
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_permit', 'delete', 'permits', $id);
        }

        return response()->json(['Permit'=>$Permit]);
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
            'activity_name'=> true,
            'nature_activity'=>true,
            // 'activity_description'=>true,
            'place_activity' =>true,
            'activity_history' =>true,
            'number_days'=>true,
            'alwahda'=>true,
            // 'alwahda_description'=>true,
            'activity_leader'=>true,
            'number_participants'=>true,
            'number_leader'=>true,
            'permit_status'=>true,
            'reject_notes'=> true,
            'permit_number'=>true,
            
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

           $alldata = Permit::with('TypeActivity')->whereBetween('activity_history',[$first_day_year,$last_day_year])->get();
        
            if($active=='All'){
                $alldata = Permit::withTrashed()->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            }
            elseif($active=='Active'){
                $alldata = Permit::get();
            }
            elseif($active=='DeActive'){
                $alldata = Permit::onlyTrashed()->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            }
        }else{

            $alldata = Permit::where('admin_id',$userId)->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            if($active=='All'){
                $alldata = Permit::withTrashed()->where('admin_id',$userId)->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            }
            elseif($active=='Active'){
                $alldata = Permit::where('admin_id',$userId)->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            }
            elseif($active=='DeActive'){
                $alldata = Permit::onlyTrashed()->where('admin_id',$userId)->whereBetween('activity_history',[$first_day_year,$last_day_year])->with('TypeActivity')->get();
            }



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
                "number_participants"=>$objdata->number_participants,
                "number_leader"=>$objdata->number_leader,
                "permit_status"=>$status,
                'reject_notes'=> $objdata->reject_notes,
                "permit_number"=>$objdata->permit_number,
                
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
        // Escape special characters in the filter string for safe use in the regular expression
        $escaped_filter = preg_quote( $filter, '/' );

        if ( ! empty( $field ) ) {
            if ( strpos( strtolower( $field ), 'date' ) !== false ) {
                // Filter by date range
                $data = filterByDateRange( $data, $escaped_filter, $field );
            } else {
                // Filter by column
                $data = array_filter( $data, function ( $a ) use ( $field, $escaped_filter ) {
                    return (boolean) preg_match( "/$escaped_filter/i", $a[ $field ] );
                } );
            }

        } else {
            // General filter
            $data = array_filter( $data, function ( $a ) use ( $escaped_filter ) {
                return (boolean) preg_grep( "/$escaped_filter/i", (array) $a );
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
        $objPermit->reject_notes = ""; 
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

            $fromEmail = 'admin@tawasol.privatescouts.org'; 
            // The "from" email address

            Mail::send('emails.permits_accept', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                $mail->to($recipient)
                    ->from($fromEmail) // Set the "from" email address
                    ->subject($subject);
            });
        }


        return redirect('/admin/permits');

    }

    public function reject_permit(Request $request)
    {
         
        $permit_id = $request->permit_id;
        $reject_notes = $request->reject_notes;
        $objPermit = Permit::find($permit_id);
        $objPermit->status = "rejected";    
        $objPermit->reject_notes = $reject_notes;   
        $objPermit->save();
        $this->logAction(auth()->id(), 'user', 'reject_permit', 'rejected', 'permits', $objPermit->id);

        if(!empty($objPermit->admin->email)){
            $recipient = $objPermit->admin->email;
            //$recipient = 'mahmoud.ali.29992@gmail.com';
            $subject = "الرد على طلب: $objPermit->number_order ";

            $data = ['number_order' => $objPermit->number_order,'group_name' => $objPermit->admin->group_name]; // Data to pass to the view

            $fromEmail = 'admin@tawasol.privatescouts.org'; 
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
        $objPermit->TypeActivity;
        return view('auth.admin.permits.download_approve_form',['title' => $title,'objPermit'=>$objPermit]);
    }



    public function total_permits()
    {
        $title = __('messages.Total_activity_permit_fees');
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);


        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
        
        if($objAdmin->position_id == 1 || $objAdmin->position_id == 3 || $objAdmin->position_id == 4 || $objAdmin->position_id == 6){
            $sum = Permit::where('status','!=','rejected')->join('type_activity', 'permits.nature_activity', '=', 'type_activity.id')
            ->sum('type_activity.price');
       }else{
            $sum = Permit::where('status','!=','rejected')->where('admin_id', $objAdmin->id)
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
            'count'=>true,
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
        $first_day_year = date('Y-m-d', strtotime('first day of january this year'));
        $last_day_year = date('Y') . '-12-31';
        if($objAdmin->position_id == 1 || $objAdmin->position_id == 3 || $objAdmin->position_id == 4 || $objAdmin->position_id == 6){

           // $alldata = DB::table('permits')
           //  ->select('permits.admin_id','admins.group_name', DB::raw('SUM(type_activity.price) as price'))
           //  ->join('admins', 'admins.id', '=', 'permits.admin_id')
           //  ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
           //  ->groupBy('permits.admin_id','admins.group_name')
           //  ->get();

            $alldata = DB::table('permits')
            ->select(
                'permits.admin_id',
                'admins.group_name',
                DB::raw('SUM(type_activity.price) as price'),
                DB::raw('COUNT(permits.id) as permit_count')  // This counts the number of permits
            )
            // ->whereBetween('activity_history',[$first_day_year,$last_day_year])
            ->where('permits.status','!=','rejected')
            ->join('admins', 'admins.id', '=', 'permits.admin_id')
            ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
            ->groupBy('permits.admin_id', 'admins.group_name')
            ->get();

        
        }else{

            // $alldata = DB::table('permits')
            // ->where('admin_id',$userId)
            // ->select('permits.admin_id','admins.group_name', DB::raw('SUM(type_activity.price) as price'))
            // ->join('admins', 'admins.id', '=', 'permits.admin_id')
            // ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
            // ->groupBy('permits.admin_id','admins.group_name')
            // ->get();

             $alldata = DB::table('permits')
             ->where('admin_id',$userId)
            ->select(
                'permits.admin_id',
                'admins.group_name',
                DB::raw('SUM(type_activity.price) as price'),
                DB::raw('COUNT(permits.id) as permit_count')  // This counts the number of permits
            )
            // ->whereBetween('activity_history',[$first_day_year,$last_day_year])
            ->where('permits.status','!=','rejected')
            ->join('admins', 'admins.id', '=', 'permits.admin_id')
            ->join('type_activity', 'type_activity.id', '=', 'permits.nature_activity')
            ->groupBy('permits.admin_id', 'admins.group_name')
            ->get();
           
        }

       



        $alldataResult=array();

        foreach($alldata as $key=> $objdata){

            $alldataResult[] = array(
                
                "order" => $key+1,
               
                "leader" => @$objdata->group_name,
                "count"=> @$objdata->permit_count,
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
            'number_participants'=>true,
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

        // Fetch all advertisements where the activity_history date is between the first and last day of the provided year
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super){
            $alldata = Permit::with('TypeActivity')->whereBetween('activity_history',[$first_day_year,$last_day_year])->get();
        }else{
            $alldata = Permit::with('TypeActivity')->whereBetween('activity_history',[$first_day_year,$last_day_year])->where('admin_id',$objAdmin->id)->get();
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
                "number_participants"=>$objdata->number_participants,
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
            'number_participants'=>true,
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


        $alldata = Permit::with('TypeActivity')->whereBetween('activity_history',[$first_day_year,$last_day_year])->get();
       
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

                // if($objAdmin->is_super == 0){
 
                //     $status = "<a target='_blank' href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";
                // }

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
                'number_participants'=>$objdata->number_participants,
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
      
       // Set the first day of the provided year at midnight (00:00:00)
        $first_day_year = date('Y-m-d 00:00:00', strtotime("first day of january $request->year"));

        // Set the last day of the provided year at 23:59:59
        $last_day_year = $request->year . '-12-31 23:59:59';
        $fileName = 'permits.csv';
        $permits = Permit::with('TypeActivity')->whereBetween('activity_history',[$first_day_year,$last_day_year])->get();
        
            
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
        $columns = array(__('messages.scout_group'),__('messages.activity_name'),__('messages.nature_activity'),__('messages.place_activity'),__('messages.activity_history'),__('messages.number_days'),__('messages.alwahda'),__('messages.activity_leader'),__('messages.number_participants'),__('messages.number_leader'),__('messages.permit_status'),__('messages.permit_number'),__('messages.created_at'));
 
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

                $row['nature_activity']  = @$objdata->TypeActivity->name_ar;
                  
                $row['place_activity']  = $objdata->place_activity;
                $row['activity_history']  = $objdata->activity_history;
                $row['number_days']  = $objdata->number_days;
                $row['alwahda']  = $alwahda;

                $row['activity_leader']  = $objdata->activity_leader;
                $row['number_participants']  = $objdata->number_participants;
                $row['number_leader']  = $objdata->number_leader;
                $row['permit_status']  = $status;
                $row['permit_number']  = $objdata->permit_number;
                $row['created_at']  = Date('Y-m-d',strtotime($objdata->created_at));

                // Write the row data to the CSV file
                fputcsv($file, array($row['scout_group'],$row['activity_name'],$row['nature_activity'],$row['place_activity'],$row['activity_history'],$row['number_days'],$row['alwahda'],$row['activity_leader'],$row['number_participants'],$row['number_leader'],$row['permit_status'],$row['permit_number'],$row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



    
}
