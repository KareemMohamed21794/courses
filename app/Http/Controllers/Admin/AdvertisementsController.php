<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\AdvertisementParent;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;
use DB;
use Illuminate\Support\Facades\Mail;

class AdvertisementsController extends Controller
{
    private const MODEL ='Advertisement';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super == 1){
            $title = __('messages.issued');
            $add_title = __('messages.issued');
        }else{
            $title = __('messages.incoming');
            $add_title = __('messages.incoming');
        }


        $leaders = Admin::where('is_super',0)->get();


         ///// update read 


        if($objAdmin->is_super == 0){
        Advertisement::where('admin_id', $objAdmin->id)
        ->withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
        
        }else{
        AdvertisementParent::withTrashed() // Include both active and soft-deleted records
        ->update(['read' => 1]);
         
        }


        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->position_id == 1  || $objAdmin->position_id == 3){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }


        if($objAdmin->position_id == 4){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }


        if($objAdmin->position_id ==2){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 1;
        }

      

        return view('auth.admin.advertisements.index',['title' => $title, 'add_title' => $add_title,'leaders'=>$leaders,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print,'objAdmin'=>$objAdmin]);

        //Advertisement::where('admin_id', $objAdmin->id)->update(['read' => 1]);
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

        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '20000M');
        set_time_limit(0);


        DB::beginTransaction(); // Start a database transaction
        $validator = Validator::make($request->all(),[
           // 'description' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'group_type' => ['required'],
            'file' => ['required'],
            'categories' => ['required'],
        ]);

        $validator->sometimes('admin_id', 'required', function ($input) {
            return $input->group_type == 'group_name';
        });

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        $userId = Auth::id();

        $arrGroups = array();

        if($request->group_type == 'kashfih'){

           $arrGroups =  Admin::where('group_classification','kashfih')->whereNull('deleted_at')->where('is_super',0)->pluck('id')->toArray();

        }elseif($request->group_type == 'irshad'){

            $arrGroups =  Admin::where('group_classification','irshad')->whereNull('deleted_at')->where('is_super',0)->pluck('id')->toArray();

        }elseif($request->group_type == 'all'){

            $arrGroups =  Admin::whereNull('deleted_at')->where('is_super',0)->pluck('id')->toArray();
            
        }elseif($request->group_type == 'group_name'){

            $arrGroups =  $request->admin_id ? $request->admin_id : array();
            
        }




         $document = '';

         if(!empty($request->file('file'))){
            $file = $request->file('file');
            $destinationPath = "public/images/advertisements";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
        }


        $Advertisement = array();

        $AdvertisementParent = new AdvertisementParent();
        $AdvertisementParent->admin_id = NULL;
        $AdvertisementParent->group_type = $request->group_type;
        $AdvertisementParent->file = $document;
        $AdvertisementParent->file_name = $request->file_name;
        $AdvertisementParent->description = $request->description;
        $AdvertisementParent->categories = $request->categories;

        $AdvertisementParent->save();

        
        foreach ($arrGroups as $key => $objGroup) {


            $objAdmin = Admin::find($objGroup);

            $Advertisement = Advertisement::create([
            'parent_id' =>  $AdvertisementParent->id,
            'admin_id' =>  $objGroup,
            'group_type' =>  $request->group_type,
            'file' =>  $document,
            'file_name' =>  $request->file_name,
            'description' =>  $request->description,
            'categories' => $request->categories,
            ]);
 

        }



        $this->logAction(auth()->id(), 'user', 'send_Advertisement', 'create', 'advertisements', $Advertisement->id);
        

        foreach ($arrGroups as $key => $objGroup) {


            $objAdmin = Admin::find($objGroup);

             
            if(!empty($objAdmin->email)){
                $recipient = $objAdmin->email;

                 
                //$recipient = 'mahmoud.ali.29992@gmail.com';
                $subject = "لديك وارد من مدير نظام تواصل";

                $data = ['group_name' => $objAdmin->group_name]; // Data to pass to the view

                $fromEmail = 'admin@tawasol.privatescouts.org'; 
                // The "from" email address

                Mail::send('emails.advertisements', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                    $mail->to($recipient)
                        ->from($fromEmail) // Set the "from" email address
                        ->subject($subject);
                });
            }

            # send email

            // sleep(60);

        }
        

        DB::commit(); // Commit the transaction
        return response()->json(['Advertisement'=>$Advertisement]);
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
        $Advertisement  = Advertisement::find($id);
        @$Advertisement->Admin;

        return response()->json($Advertisement);
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
               //'description' => ['required', 'string', 'max:255'],
                'file_name' => ['required', 'string', 'max:255'],
                'file' => ['required'],
                'categories' => ['required'],
            ]);
   

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $document = '';
        $userId = Auth::id();


        $objAdvertisement = Advertisement::find($id);
        $objAdvertisement->description = $request->description;
        $objAdvertisement->file_name = $request->file_name;
        $objAdvertisement->categories = $request->categories;
        if(!empty($request->file('file'))){
            $oldImage = $objAdvertisement->file;
            $file = $request->file('file');
            $destinationPath = "public/images/advertisements";
            $document = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $document);
            $objAdvertisement->file = $document;
            if($objAdvertisement->save()){
               @unlink("public/images/advertisements/".$oldImage);
            }
        }

        $objAdvertisement->save();

        $this->logAction(auth()->id(), 'user', 'update_Advertisement', 'update', 'advertisements', $objAdvertisement->id);
        return response()->json(['objAdvertisement'=>$objAdvertisement]);
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
        $Advertisement = Advertisement::where('id',$id)->delete();
        $this->logAction(auth()->id(), 'user', 'delete_Advertisement', 'delete', 'advertisements', $id);
        return response()->json(['Advertisement'=>$Advertisement]);
    }

     public function deleteadvertisements(Request $request)
    {
        //$this->authorize(self::MODEL.'-delete');
        foreach ($request->ids as $key => $id) {
            $this->logAction(auth()->id(), 'user', 'delete_Advertisement', 'delete', 'advertisements', $id);
        }
        $Advertisement = Advertisement::whereIn('id',$request->ids)->delete();

        return response()->json(['Advertisement'=>$Advertisement]);
    }


    public function get(Request $request)
    { 
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        //$this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');

         if($objAdmin->is_super == 1){
        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'admin_id'   => true,
            'categories'=>true,
            'file_name'=>true,
            'file'=> true,
            
            'description'=>true,
            'created_at'   => true,
        ];

        }else{

            $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'categories'=>true,
             'file_name'=>true,
            'file'=> true,
           
            'description'=>true,
            'created_at'   => true,
        ];

        }



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

           $alldata = AdvertisementParent::whereBetween('created_at',[$first_day_year,$last_day_year])->get();
        
            if($active=='All'){
                $alldata = AdvertisementParent::withTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = AdvertisementParent::whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = AdvertisementParent::onlyTrashed()->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
        }else{

            $alldata = Advertisement::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            if($active=='All'){
                $alldata = Advertisement::withTrashed()->where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='Active'){
                $alldata = Advertisement::where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }
            elseif($active=='DeActive'){
                $alldata = Advertisement::onlyTrashed()->where('admin_id',$userId)->whereBetween('created_at',[$first_day_year,$last_day_year])->get();
            }



        }

        $alldataResult=array();
 
        foreach($alldata as $key=> $objdata){

            $categories = "";


            if($objdata->categories=='talab_mukhatabat'){
                $categories = "طلب مخاطبات لجهات محلية";
            }elseif ($objdata->categories=='⁠anshitat_mahaliya') {
                $categories = "أنشطة محلية";
            }elseif ($objdata->categories=='anshita_earabiat_waealamia') {
                $categories = " ⁠أنشطة عربية وعالمية";
            }elseif ($objdata->categories=='aldirasat_altaahilia') {
                $categories = "الدراسات التأهيلية";
            }elseif ($objdata->categories=='aistifsarat_malia') {
                $categories = "استفسارات مالية";
            }elseif ($objdata->categories=='aijtimaeat') {
                $categories = "اجتماعات ";
            }elseif ($objdata->categories=='⁠aistifsarat_eama') {
                $categories = "استفسارات عامة";
            }

        
            if($objAdmin->is_super == 1){
            
            $groups = "";
            


            if($objdata->group_type=='all'){
                $groups = "الكل";
            }elseif ($objdata->group_type=='kashfih') {
                $groups = "كشفية";
            }
            elseif ($objdata->group_type=='irshad') {
                $groups = "ارشادية";
            }
            elseif ($objdata->group_type=='group_name') {
                 
                foreach ($objdata->Advertisements as $key2=> $Advertisement) {
                    if(count($objdata->Advertisements)==($key2+1)){
                        $groups.=@$Advertisement->Admin->group_name;
                    }else{
                        $groups.=@$Advertisement->Admin->group_name." - ";
                        
                    }
                    
                }
                
            }
                

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "admin_id" => @$groups,
                "categories"=> @$categories,
                "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/advertisements/' . $objdata->file) . '">تحميل الملف<a>',
                
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
            );
            }else{

               $alldataResult[] = array(
                "order" => $key+1,
                "#" => $objdata->id,
                "id" => $objdata->id,
                "categories"=> @$categories,
               "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/advertisements/' . $objdata->file) . '">تحميل الملف<a>',
               
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
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




    public function ExportAdvertisements(Request $request)
{
    $fileName = 'export_advertisements.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    
    if ($objAdmin->is_super == 1) {
        $Advertisements = Advertisement::get();
        $columns = array(__('messages.scout_group'), 'الملف', 'اسم الملف', 'الشرح');
    } else {
        $Advertisements = Advertisement::where('admin_id', $userId)->get();
        $columns = array('الملف', 'اسم الملف', 'الشرح');
    }

    // Set the response headers with the correct character encoding
    $headers = array(
        "Content-type"        => "text/csv; charset=utf-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function () use ($Advertisements, $columns, $objAdmin) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($Advertisements as $Advertisement) {
            $row = array();

            if ($objAdmin->is_super == 1) {
                // Show group_name only for super admin
                $row['admin_id'] = $Advertisement->Admin->group_name;
            }

            $row['file'] = asset('public/images/advertisements/' . $Advertisement->file);
            $row['file_name'] = $Advertisement->file_name;
            $row['description'] = $Advertisement->description;

            // Write the row data to the CSV file
            if ($objAdmin->is_super == 1) {
                fputcsv($file, array($row['admin_id'], $row['file'], $row['file_name'], $row['description']));
            } else {
                fputcsv($file, array($row['file'], $row['file_name'], $row['description']));
            }
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


public function ReportArchiveAdvertisements()
    {
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.archive_advertisements') ;
        
        return view('auth.admin.advertisements.report_archive_advertisements', [
            'title' => $title,
        ]);
    }



    public function ReportArchiveAdvertisementsGet()
    {
        $year = @$_GET['year'];
        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

       
        $title = __('messages.archive_advertisements') . ' - ' . 'سنة ' .$year;

        return view('auth.admin.advertisements.report_archive_advertisements_get', ['title' => $title,'year' => $year]);
    }



    public function report_archive_advertisements_get_list(Request $request)
    {
       

        ini_set('memory_limit', '-1');

        $columnsDefault = [
            '#'   => true,
            'order'   => true,
            'id'   => true,
            'admin_id'   => true,
            'categories'=>true,
            'file_name'=>true,
            'file'=> true,
            
            'description'=>true,
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
        $alldata = Advertisement::whereBetween('created_at', [$first_day_year, $last_day_year])->get();

       

        $alldataResult = array();

        foreach ($alldata as $key=> $objdata) {


            $categories = "";


            if($objdata->categories=='talab_mukhatabat'){
                $categories = "طلب مخاطبات لجهات محلية";
            }elseif ($objdata->categories=='⁠anshitat_mahaliya') {
                $categories = "أنشطة محلية";
            }elseif ($objdata->categories=='anshita_earabiat_waealamia') {
                $categories = " ⁠أنشطة عربية وعالمية";
            }elseif ($objdata->categories=='aldirasat_altaahilia') {
                $categories = "الدراسات التأهيلية";
            }elseif ($objdata->categories=='aistifsarat_malia') {
                $categories = "استفسارات مالية";
            }elseif ($objdata->categories=='aijtimaeat') {
                $categories = "اجتماعات ";
            }elseif ($objdata->categories=='⁠aistifsarat_eama') {
                $categories = "استفسارات عامة";
            }

        
            // $groups = "";
        
            // if($objdata->group_type=='all'){
            //     $groups = "الكل";
            // }elseif ($objdata->group_type=='kashfih') {
            //     $groups = "كشفية";
            // }
            // elseif ($objdata->group_type=='irshad') {
            //     $groups = "ارشادية";
            // }
            // elseif ($objdata->group_type=='group_name') {
                 
            //     foreach ($objdata->Advertisements as $key2=> $Advertisement) {
            //         if(count($objdata->Advertisements)==($key2+1)){
            //             $groups.=@$Advertisement->Admin->group_name;
            //         }else{
            //             $groups.=@$Advertisement->Admin->group_name." - ";
                        
            //         }
                    
            //     }
                
            // }
                

            $alldataResult[] = array(
                "#" => $objdata->id,
                "order" => $key+1,
                "id" => $objdata->id,
                "admin_id" => @$objdata->Admin->group_name,
                "categories"=> @$categories,
                "file_name"=> $objdata->file_name,
                "file"=> '<a target="_blank" href="' . asset('public/images/advertisements/' . $objdata->file) . '">تحميل الملف<a>',
                
                "description"=> $objdata->description,
                "created_at" => Date('Y-m-d H:i:s',strtotime($objdata->created_at)),
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


    public function export_archive_advertisements(Request $request)
{


    $fileName = 'export_secondary_registrations.csv';
    
    $userId = \Auth::id();
    $objAdmin = Admin::find($userId);
    if($objAdmin->is_super == 1){

       $Files = File::where('type','secondary_registration')->get();
    
    }else{

        $Files = File::where('admin_id',$userId)->where('type','secondary_registration')->get();

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
    $columns = array(__('messages.scout_group'),'نموذج التسجيل','السنة');

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($Files, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($Files as $File) {
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['leader_name']  = $File->Admin->name;
            
            $row['secondary_registration']  =asset('public/images/files/' . $File->secondary_registration);

            $row['year']  = $File->year;
         

            // Write the row data to the CSV file
            fputcsv($file, array($row['leader_name'],$row['secondary_registration'],$row['year']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
