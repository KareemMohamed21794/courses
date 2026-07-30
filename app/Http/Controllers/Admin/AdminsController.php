<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ExportsReports;
use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Support\Reports\Report;
use App\Support\Reports\ReportColumn;
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
    use ExportsReports;
    use HandlesAdminDataTable;

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
        $leaders = Admin::where('position_id',2)->whereNull('deleted_at')->get();

        $segment = $request->segment(2);

        $encodeId = "";

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
        elseif($segment=='users'){

            $title =   __('messages.users') ;
            $add_title = __('messages.user');
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

        $can_add = 0;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        if($objAdmin->is_super ){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }

        if($objAdmin->position_id == 3 ){
            $can_print = 1;
        }
        

        return view('auth.admin.admins.index',['title' => $title, 'departments' => $departments, 'positions' => $positions, 'segment' => $segment , 'add_title' => $add_title, 'department_id' => $department_id, 'position_id' => $position_id, 'is_super' => $is_super, 'leaders' => $leaders,'Governorates'=>$Governorates,'objAdmin'=>$objAdmin,'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print]);
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
                
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name' => ['string', 'max:255'],
                'username' => 'required|max:255|unique:admins,username,'.$Admin->id.',id',
                'email' => 'required|email|max:255',
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
      


        if(!empty($request->password)){
            $objAdmin->password = Hash::make($request->password);
        }

        $objAdmin->save();


        return response()->json(['objAdmin'=>$objAdmin]);

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
        $objAdmin = Admin::where('id',$id)->first();
       
        $Admin = Admin::where('id',$id)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function deleteAdmins(Request $request)
    {
        
        $Admin = Admin::whereIn('id',$request->ids)->delete();
        return response()->json(['Admin'=>$Admin]);
    }

    public function get(Request $request)
    {

        ini_set('memory_limit', '-1');
        $segment = $request->segment(2);
       
            $columnsDefault = [
            'order'   => true,
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

       

        elseif($segment=='users'){
            $position_id = 2;
        }


        

        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        $active = $request->active;

        if($objAdmin->is_super == 1){
            $alldata = Admin::where('position_id',$position_id)->whereNull('deleted_at')->get();

            if($active=='All'){
                $alldata = Admin::withTrashed()->where('position_id',$position_id)->get();
            }
            elseif($active=='Active'){
                $alldata = Admin::where('position_id',$position_id)->whereNull('deleted_at')->get();
            }
            elseif($active=='DeActive'){
                $alldata = Admin::onlyTrashed()->where('position_id',$position_id)->get();
            }

        }else{


            $alldata = Admin::where('position_id',$position_id)->where('id',$objAdmin->id)->whereNull('deleted_at')->get();

            if($active=='All'){
                $alldata = Admin::withTrashed()->where('position_id',$position_id)->where('id',$objAdmin->id)->get();
            }
            elseif($active=='Active'){
                $alldata = Admin::where('position_id',$position_id)->where('id',$objAdmin->id)->whereNull('deleted_at')->get();
            }
            elseif($active=='DeActive'){
                $alldata = Admin::onlyTrashed()->where('position_id',$position_id)->where('id',$objAdmin->id)->get();
            }

        }

    


        $alldataResult=array();

        foreach($alldata as $key=> $objdata){

            $is_super = "Super Admin";
            if(!$objdata->is_super)  $is_super = "Normal Admin";
            if($segment=='admins' || $segment=='secretariats' || $segment=='monitors'||$segment=='training_commissioners'||$segment=='treasurers'){

                $alldataResult[] = array(
                    "order" => $key+1,
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
                    "order" => $key+1,
                    "#" => $objdata->id,
                    "id" => $objdata->id,
                    "username"=> $objdata->username,
                    "group_name"=> $objdata->group_name,
                    "name" => $objdata->name,
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

    public function export(Request $request)
    {
        return $this->exportReport($this->accountsReport($request), $request);
    }

    protected function accountsReport(Request $request): Report
    {
        $segment = $request->segment(2);
        $isUsers = $segment === 'users';
        $accounts = $this->filteredAdminsQuery($request, $segment)->latest()->get();

        $columns = [
            ReportColumn::text('id', '#')->width(6)->align('center'),
            ReportColumn::text('username', 'اسم المستخدم')->width(16),
            ReportColumn::text('name', 'الاسم الكامل')->width(20),
            ReportColumn::text('email', 'البريد الإلكتروني')->width(22)->ltr(),
            ReportColumn::text('phone', 'رقم الهاتف')->width(13)->ltr()->align('center'),
        ];

        if ($isUsers) {
            $columns[] = ReportColumn::text('group_name', 'المجموعة')->width(13);
        }

        $columns[] = ReportColumn::status('deleted_at', 'الحالة', [
            'active' => ['نشط', 'success'],
            'disabled' => ['معطّل', 'danger'],
        ])->width(9)->using(function (Admin $account) {
            return $account->deleted_at ? 'disabled' : 'active';
        });

        $columns[] = ReportColumn::datetime('created_at', 'تاريخ الإنشاء')->width(14);

        return Report::make($isUsers ? 'تقرير المستخدمين' : 'تقرير المدراء')
            ->subtitle($isUsers ? 'حسابات المستخدمين المسجلين في النظام' : 'حسابات المدراء وصلاحيات الدخول')
            ->filters([
                'كلمة البحث' => $this->searchValue($request),
                'حالة الحساب' => $this->filterLabel($request->input('active', 'Active'), [
                    'Active' => 'الحسابات النشطة',
                    'DeActive' => 'الحسابات المعطّلة',
                    'All' => 'كل الحسابات',
                ]),
            ])
            ->summary([
                'إجمالي الحسابات' => number_format($accounts->count()),
                'حسابات نشطة' => number_format($accounts->whereNull('deleted_at')->count()),
                'حسابات معطّلة' => number_format($accounts->whereNotNull('deleted_at')->count()),
            ])
            ->columns($columns)
            ->rows($accounts)
            ->landscape()
            ->fileName($isUsers ? 'users' : 'admins')
            ->sheetName($isUsers ? 'المستخدمون' : 'المدراء');
    }

    private function filteredAdminsQuery(Request $request, string $segment)
    {
        $positionId = $segment === 'users' ? 2 : 1;
        $objAdmin = Admin::find(Auth::id());
        $active = $request->input('active', 'Active');
        $softDeletes = in_array(
            \Illuminate\Database\Eloquent\SoftDeletes::class,
            class_uses_recursive(Admin::class),
            true
        );

        $query = Admin::query()->where('position_id', $positionId);

        if (!($objAdmin && $objAdmin->is_super == 1)) {
            $query->where('id', optional($objAdmin)->id);
        }

        if ($softDeletes) {
            if ($active === 'All') {
                $query->withTrashed();
            } elseif ($active === 'DeActive') {
                $query->onlyTrashed();
            } else {
                $query->whereNull('deleted_at');
            }
        } elseif ($active === 'DeActive') {
            // Soft deletes are disabled on Admin, so there are no disabled rows.
            $query->whereRaw('1 = 0');
        }

        $search = $this->searchValue($request);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('group_name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        return $query;
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
}
