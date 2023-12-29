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
use TCPDF;
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

        $leaders = Admin::where('is_super',0)->get();


        $can_add = 1;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        if($objAdmin->is_super){
            $can_add = 1;
            $can_update = 0;
            $can_delete = 1;
            $can_print = 1;
            $can_accept = 1;
            $can_reject = 1;
        }else{
            $can_add = 1;
            $can_update = 1;
            $can_delete = 0;
            $can_print = 1;
            $can_accept = 0;
            $can_reject = 0;
        }

        $registration_number = $objAdmin->registration_number;
        
        $Permit_count = Permit::count();
        $Permit_count = $Permit_count+1000;

        $fourDigitCount = str_pad($Permit_count, 4, '0', STR_PAD_LEFT);

        $permit_number = "م ق أ /$registration_number/ $fourDigitCount";

         

        return view('auth.admin.permits.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders, 'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print, 'can_accept'=>$can_accept, 'can_reject'=>$can_reject, 'permit_number'=>$permit_number]);
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
            'alwahda' =>  $request->alwahda,
            'alwahda_description' =>  $request->alwahda_description,
            'activity_leader' =>  $request->activity_leader,
            'number_leader' =>  $request->number_leader,
            'number_participants' =>  $request->number_participants,
            'number_order' =>  $request->number_order,
            'leaders_names' =>  $request->leaders_names,
            'admin_id' =>  $request->leader_id ? $request->leader_id : $userId,
            
        ]);


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
        $objPermit->alwahda =  $request->alwahda;
        $objPermit->alwahda_description =  $request->alwahda_description;
        $objPermit->activity_leader =  $request->activity_leader;
        $objPermit->number_leader =  $request->number_leader;
        $objPermit->number_participants =  $request->number_participants;
        $objPermit->number_order =  $request->number_order;
        $objPermit->leaders_names =  $request->leaders_names;
       
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
            'leader'   => true,
            'activity_name'=> true,
            'nature_activity'=>true,
            'activity_description'=>true,
            'place_activity' =>true,
            'activity_history' =>true,
            'number_days'=>true,
            'alwahda'=>true,
            'alwahda_description'=>true,
            'activity_leader'=>true,
            'number_leader'=>true,
            'permit_status'=>true,
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
            if($objdata->alwahda == "ashbal"){
                $alwahda = 'اشبال /  زهرات';
            }elseif ($objdata->alwahda == "kashaf") {
                $alwahda = 'كشاف / مرشدات';
            }elseif ($objdata->alwahda == "mutaqadimu") {
                $alwahda = 'متقدم / متقدمات ';
            }elseif ($objdata->alwahda == "jawaluh") {
                $alwahda = 'جواله / دليلات';
            }elseif ($objdata->alwahda == "almajmueuh") {
                $alwahda = 'المجموعه';
            }elseif ($objdata->alwahda == "awlia_alamwr") {
                $alwahda = ' اولياء الامور';
            }elseif ($objdata->alwahda == "other") {
                $alwahda = 'اخرى';
            }

            if($objdata->status=='pending'){
                $status = "معلقه";
            }elseif ($objdata->status=='approved') {
                $status = "<span style='color:green;font-weight:bold'>مقبول</span>" . "<br><a href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";

                if($objAdmin->is_super == 0){
 
                    $status = "<a href = '".url('admin/download_approvement')."/".$objdata->id." '>تحميل الموافقة</>";
                }

            }
            elseif ($objdata->status=='rejected') {
                $status = "<span style='color:red;font-weight:bold'>مرفوض</span>";
            }

            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "leader" => @$objdata->Admin->group_name,
                "activity_name"=> $objdata->activity_name,
                "nature_activity"=> $nature_activity,
                "activity_description"=> $objdata->activity_description,
                "place_activity" =>$objdata->place_activity,
                "activity_history" =>$objdata->activity_history,
                "number_days" =>$objdata->number_days,
                "alwahda" =>$alwahda,
                "alwahda_description"=>$objdata->alwahda_description,
                "activity_leader"=>$objdata->activity_leader,
                "number_leader"=>$objdata->number_leader,
                "permit_status"=>$status,
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


        if(!empty($objPermit->admin->email)){
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

    public function reject_permit(Request $request, $id)
    {
         

        $objPermit = Permit::find($id);
        $objPermit->status = "rejected";       
        $objPermit->save();

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
        return view('auth.admin.permits.download_approve_form',['title' => $title,'objPermit'=>$objPermit]);
    }

    
}
