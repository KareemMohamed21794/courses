<?php

namespace App\Http\Controllers\Admin;

use App\Events\HistoricalEvents;
use App\Http\Controllers\Controller;
use App\Services\HistoricalEvents\HistoricalEvents as HES;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientPermission;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InvoiceHeader;
use App\Models\ClientFile;
use App\Models\Admin;
use Redirect;
use App\Models\Problem;
use App\Models\ProblemProcedure;
use App\Models\ProblemsProcedureFile;


use Illuminate\Support\Facades\Storage;


//use Response;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Lang;

class ClientsController extends Controller
{
    const MODEL = 'Client';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $str = random_bytes(8);
        $str = base64_encode($str);
        $str = str_replace(["+", "/", "="], "", $str);
        $random_password = substr($str, 0, 8);
        $random_password = strtolower($random_password);
       
        $this->authorize(self::MODEL.'-viewAny');
        $title = __('messages.clients');
        $code = @Client::latest('id')->first('id')->id + 1;
        $Clients = Client::all();

        $Countries = ["الاردن","فلسطين","سوريا","العراق","مصر","ليبيا","اليمن","اللبنان","الكويت","السعودية","الإمارات","قطر","عُمان","البحرين","المغرب","السودان","جنوب السودان","الجزائر","موريتانيا","تونس","الصومال","جيبوتي","جزر القمر","أثيوبيا","أذربيجان","أرمينيا","أستراليا","أفغانستان","ألبانيا","ألمانيا","أندورا","أنغولا","أوزبكستان","أوغندا","أوكرانيا","أيسلندا","إريتريا","إسبانيا","إستونيا","إمارة موناكو","إندونيسيا","إيران","إيرلندا","إيطاليا","الأرجنتين","الاكوادور","البرازيل","البرتغال","البوسنة والهرسك","الجابون","الجبل الأسود","الدنمارك","الدومينيكان","السلفادور","السنغال","السويد","الصين","الفاتيكان","الكاميرون","المكسيك","المملكة المتحدة","النرويج","النمسا","النيجر","الهند","الهولندي","الولايات المتحدة الأمريكية","اليابان","اليونان","اورجواى","بابوا غينيا الجديدة","باراغواي","باكستان","بالو","بربادوس","بروناي","بلجيكا","بلغاريا","بنغلاديش","بنما","بوتان","بوتسوانا","بوركينا فاسو","بوروندي","بولندا","بوليفيا","بيرو","بيلا روسيا","تايلاند","تايوان","تركمانستان","تركيا","ترينداد وتوباغو","تشاد","تشيلي","تنزانيا","تونغا","تيمور الشرقية","جامايكا","جزر البهاما","جزر الكناري","جزر تركس وكايكوس","جزر سليمان","جزر سيشل","جزر فارو","جزر فيجي","جزر كايمان","جزر مارشال","جزر ميكرونيزيا","جزيرة مالطة","جمهورية افريقيا الوسطى","جمهورية التشيك","جمهورية الكونغو","جمهورية الكونغو الديمقراطية","جمهورية مقدونيا الشمالية","جنوب أفريقيا","جورجيا","دومينيكا","رأس أخضر","رواندا","روسيا","رومانيا","زامبيا","زيمبابوي","ساحل العاج","ساموا","سان لوسيا","سان مارينو","سانت فنسنت وجزر غرينادين","سانت كيتس ونيفيس","سانت هيلانة","سلوفاكيا","سلوفينيا","سنغافورة","سوازيلاند","سوتومي وبرنسيب","سورينام","سويسرا","سيرا ليون","سيريلانكا","صربيا","طاجيكستان","غامبيا","غانا","غرينادا","غواتيمالا","غوادلوب","غيانا","غيانا الفرنسية","غينيا","غينيا الإستوائية","غينيا بيساو","فرنسا","فنزويلا","فنلندا","فيتنام","فيلبيني","قبرص","قيرغيزستان","كازاخستان","كرواتيا","كمبوديا","كندا","كوبا","كوريا الجنوبية","كوريا الشمالية","كوستا ريكا","كولومبيا","كيريباتي","كينيا","لاتفيا","لاوس","لوكسمبورغ","ليبيريا","ليتوانيا","ليختنشتاين","ليسوتو","ماليا","ماليزيا","مدغشقر","مقدونيا","ملاوي","منغوليا","موريشيوس","موزمبيق","مولدوفا","ميانمار","ميانمار (بورما)","ناميبيا","ناورو","نيبال","نيجيريا","نيكاراغوا","نيوزيلندا","هايتي","هندوراس","هنغاريا","ويلز",
        ];

        $can_add = 1;
        $can_update = 0;
        $can_delete = 0;
        $can_print = 0;

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);

        if($objAdmin->is_super && $objAdmin->position_id==1){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 1;
            $can_print = 1;
        }

        if($objAdmin->position_id==2){
            $can_add = 0;
            $can_update = 0;
            $can_delete = 0;
            $can_print = 0;
        }

        if($objAdmin->position_id==3){
            $can_add = 1;
            $can_update = 1;
            $can_delete = 0;
            $can_print = 1;
        }



        return view('auth.admin.clients.index', ['title' => $title,'code' => $code ,'Countries'=> $Countries,'random_password'=>$random_password , 'Clients'=>$Clients, 'can_add'=>$can_add, 'can_update'=>$can_update, 'can_delete'=>$can_delete, 'can_print'=>$can_print]);
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
        $this->authorize(self::MODEL.'-store');
        // print_r('here'); die;
        $validator = Validator::make($request->all(), [
            'name_ar' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:clients'],
            'username' => ['nullable', 'unique:clients'],
        ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        if(str_contains($request->username, '@')){
            $explode_request_username = explode("@", $request->username);
            $username = $explode_request_username[0];
        }else{
            $username =$request->username;
        }


        $client = Client::create(
            [
                'code' => $request->code,
                'id_secondary' => $request->id_secondary,
                'type' => $request->type,
                'name_ar' => $request->name_ar,
                'username' => $username,
                'phone' => $request->phone,
                'street_name' => $request->street_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'commercial_registration_no' => $request->commercial_registration_no,
                'country' => $request->country,
                'client_customer_type' => $request->client_customer_type,
                'active' => 1,
            ]
        );

        //ADD CLIENT PERMISSIONS
        if($request->clients_id){

            foreach ($request->clients_id as $key => $client_id) {

              $ClientPermission =  ClientPermission::create(
                [
                    'main_client_id' => $client->id,
                    'sub_client_id' => $client_id,
                ]
                );
            }
        }

        if($request->file){
           foreach ($this->upload() as $file) {
            $clientFile = new ClientFile();
            $clientFile->client_id = $client->id;
            $clientFile->file = $file;
            $clientFile->save();
            } 
        }

        


        // HistoricalEvents::dispatch(
        //     Client::EVENTS[0],
        //     Client::class,
        //     $client->id,
        //     HES::ACTIONS['CREATE'],
        //     CLIENT::class,
        //     $request->user()->id,
        //     "new client record created",
        //     []
        // );

        return response()->json(['client' => $client]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize(self::MODEL.'-viewAny');
        $Client = Client::find($id);
        return response()->json($Client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize(self::MODEL.'-update');
        $Client = Client::find($id);
        $Client->permissions;
        return response()->json($Client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $Client)
    {

        $this->authorize(self::MODEL.'-update');
        if (empty($request->password)) {
            $validator = Validator::make($request->all(), [
                'name_ar' => ['required', 'string', 'max:255'],
                // // 'name_en' => ['required', 'string', 'max:255'],
                // 'code' => ['string', 'max:255'],
                // 'phone' => ['required', 'string', 'max:255'],
                // 'fax' => ['string', 'max:255'],
                // 'start_date' => ['required', 'string', 'max:255'],
                /*'commercial_registration_no' => ['required', 'string', 'max:255'],
                 'tax_registration_no' => ['required', 'string', 'max:255'],
                 'tax_file_no' => ['required', 'string', 'max:255'],
                 'tax_office' => ['required', 'string', 'max:255'],
                 'type' => ['required', 'string', 'max:255'],
                 'country' => ['required', 'string', 'max:255'],
                 'governorate' => ['required', 'string', 'max:255'],
                 'city' => ['required', 'string', 'max:255'],
                 'district' => ['required', 'string', 'max:255'],
                 'post_number' => ['required', 'string', 'max:255'],
                 'building_number' => ['required', 'string', 'max:255'],
                 'street_name' => ['required', 'string', 'max:255'],*/
                //'email' => 'email|max:255|unique:clients,email,' . $Client->id . ',id',
            ]
            );
        } else {
            $validator = Validator::make($request->all(), [
                // 'name_ar' => ['required', 'string', 'max:255'],
                // // 'name_en' => ['required', 'string', 'max:255'],
                // 'code' => ['string', 'max:255'],
                // 'phone' => ['required', 'string', 'max:255'],
                // 'fax' => ['string', 'max:255'],
                // 'start_date' => ['required', 'string', 'max:255'],
                /*'commercial_registration_no' => ['required', 'string', 'max:255'],
                 'tax_registration_no' => ['required', 'string', 'max:255'],
                 'tax_file_no' => ['required', 'string', 'max:255'],
                 'tax_office' => ['required', 'string', 'max:255'],
                 'type' => ['required', 'string', 'max:255'],
                 'country' => ['required', 'string', 'max:255'],
                 'governorate' => ['required', 'string', 'max:255'],
                 'city' => ['required', 'string', 'max:255'],
                 'district' => ['required', 'string', 'max:255'],
                 'post_number' => ['required', 'string', 'max:255'],
                 'building_number' => ['required', 'string', 'max:255'],
                 'street_name' => ['required', 'string', 'max:255'],*/
                //'email' => 'email|max:255|unique:clients,email,' . $Client->id . ',id',
                // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]
            );
        }


        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        if(str_contains($request->username, '@')){
            $explode_request_username = explode("@", $request->username);
            $username = $explode_request_username[0];
        }else{
            $username =$request->username;
        }

        

        $objClient = Client::find($Client->id);

        $objClient->type = $request->type;
        $objClient->id_secondary = $request->id_secondary;
        
        $objClient->name_ar = $request->name_ar;
        $objClient->username = $username;
        $objClient->phone = $request->phone;
        $objClient->street_name = $request->street_name;
        $objClient->commercial_registration_no = $request->commercial_registration_no;
        $objClient->country = $request->country;
        $objClient->client_customer_type = $request->client_customer_type;
        
        $objClient->email = $request->email;
        $objClient->active = 1;

        if (!empty($request->password)) {
            $objClient->password = Hash::make($request->password);
        }

        $objClient->save();
        //DELETE CLIENT PERMISSIONS 
        ClientPermission::where('main_client_id',$Client->id)->delete();


        //ADD CLIENT PERMISSIONS
        if($request->clients_id){
            foreach ($request->clients_id as $key => $client_id) {
               ClientPermission::create(
                [
                    'main_client_id' => $Client->id,
                    'sub_client_id' => $client_id,
                ]
                );
            }
        }

        if($request->file){
            foreach ($this->upload() as $file) {
            $clientFile = new ClientFile();
            $clientFile->client_id = $Client->id;
            $clientFile->file = $file;
            $clientFile->save();
            }
        }
        
        

         

        // HistoricalEvents::dispatch(
        //     Client::EVENTS[1],
        //     Client::class,
        //     $objClient->id,
        //     HES::ACTIONS['UPDATE'],
        //     CLIENT::class,
        //     request()->user()->id,
        //     "client record updated",
        //     []
        // );

        return response()->json(['objClient' => $objClient]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(self::MODEL.'-delete');
        $Client = Client::where('id', $id)->delete();

        // HistoricalEvents::dispatch(
        //     Client::EVENTS[2],
        //     Client::class,
        //     $id,
        //     HES::ACTIONS['DELETE'],
        //     CLIENT::class,
        //     request()->user()->id,
        //     "client record deleted",
        //     []
        // );

        return response()->json(['Client' => $Client]);
    }

    public function deleteClients(Request $request)
    {
        $this->authorize(self::MODEL.'-delete');
        $Client = Client::whereIn('id', $request->ids)->delete();
        // foreach ($request->ids as $id) {
        //     HistoricalEvents::dispatch(
        //         Client::EVENTS[2],
        //         Client::class,
        //         $id,
        //         HES::ACTIONS['DELETE'],
        //         CLIENT::class,
        //         request()->user()->id,
        //         "client record deleted",
        //         []
        //     );
        // }
        return response()->json(['Client' => $Client]);
    }

    public function get(Request $request)
    {
        //$this->authorize('can_view', Product::class);
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#' => true,
            'id' => true,
            'type' => true,
            'name_ar' => true,
            'claims_and_procedures' => true,
            'cases' => true,
            'phone' => true,
            'street_name' => true,
            'email' => true,
            'commercial_registration_no' => true,
            'country' => true,
            'client_customer_type' => true,
            'created_at' => true,
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }

        $active = $request->active;

        $alldata = Client::get();

        if ($active == 'All') {
            $alldata = Client::withTrashed()->get();
        } elseif ($active == 'Active') {
            $alldata = Client::get();
        } elseif ($active == 'DeActive') {
            $alldata = Client::onlyTrashed()->get();
        }


        $alldataResult = array();

        foreach ($alldata as $objdata) {

            $active = "active";
            if (!$objdata->active)
                $active = "Not Active";

            $client_customer_type = "";

            if($objdata->type=='personal_relationships') $type = "علاقات شخصية ";
            elseif ($objdata->type=='international_organizations') $type = "منظمات دولية  ";
            elseif ($objdata->type=='social_media') $type = "وسائل تواصل اجتماعي   ";
            elseif ($objdata->type=='friends') $type = "اصدقاء";
            elseif ($objdata->type=='other') $type = "اخرى";


            if($objdata->client_customer_type=='male') $client_customer_type = "ذكر";
            elseif ($objdata->client_customer_type=='female') $client_customer_type = "انثى";
            elseif ($objdata->client_customer_type=='gov') $client_customer_type = "وجهة حكومية  ";
            elseif ($objdata->client_customer_type=='company') $client_customer_type = "شركة";
            elseif ($objdata->client_customer_type=='other') $client_customer_type = "اخرى";


            $claims_and_procedures = count($objdata->procedures);

            $cases = count($objdata->cases);

            $claims_and_procedures = '<a href="' . url('admin/problems/procedure?client_id=' . $objdata->id) . '">' . count($objdata->procedures) . '</a>';
            $cases = '<a href="' . url('admin/problems/case?client_id=' . $objdata->id) . '">' . count($objdata->cases) . '</a>';

            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "type" => $type,
                "name_ar" => $objdata->name_ar,
                "claims_and_procedures" => $claims_and_procedures,
                "cases" => $cases,
                "phone" => $objdata->phone,
                "street_name" => $objdata->street_name,
                "email" => $objdata->email,
                "commercial_registration_no" => $objdata->commercial_registration_no,
                "country" => $objdata->country,
                "client_customer_type" => $client_customer_type,
                "created_at" => Date('Y-m-d h:i:s', strtotime($objdata->created_at)),
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

    function filterArray($array, $allowed = [])
    {
        return array_filter(
            $array,
            function ($val, $key) use ($allowed) { // N.b. $val, $key not $key, $val
                return isset($allowed[$key]) && ($allowed[$key] === true || $allowed[$key] === $val);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    function filterKeyword($data, $search, $field = '')
    {
        $filter = '';
        if (isset($search['value'])) {
            $filter = $search['value'];
        }
        if (!empty($filter)) {
            // Define the Arabic normalization function
            $normalizeArabic = function ($text) {
                $text = preg_replace('/[أإآ]/u', 'ا', $text);
                $text = preg_replace('/[هة]/u', 'ه', $text);
                return $text;
            };

            if (!empty($field)) {
                if (strpos(strtolower($field), 'date') !== false) {
                    // filter by date range
                    $data = filterByDateRange($data, $filter, $field);
                } else {
                    // filter by column
                    $data = array_filter($data, function ($a) use ($field, $filter) {
                        return (boolean) preg_match("/$filter/i", $a[$field]);
                    });
                }
            } else {
                $data = array_filter($data, function ($item) use ($filter, $normalizeArabic) {
                    $normalizedFilter = $normalizeArabic($filter);

                    $recursiveSearch = function ($array) use ($normalizedFilter, &$recursiveSearch, $normalizeArabic) {
                        foreach ($array as $value) {
                            if (is_array($value)) {
                                if ($recursiveSearch($value)) {
                                    return true;
                                }
                            } else {
                                $normalizedValue = $normalizeArabic($value);
                                if (mb_stripos($normalizedValue, $normalizedFilter) !== false) {
                                    return true;
                                }
                            }
                        }
                        return false;
                    };

                    return $recursiveSearch($item);
                });
            }
        }

        return $data;
    }

    function filterByDateRange($data, $filter, $field)
    {
        // filter by range
        if (!empty($range = array_filter(explode('|', $filter)))) {
            $filter = $range;
        }

        if (is_array($filter)) {
            foreach ($filter as &$date) {
                // hardcoded date format
                $date = date_create_from_format('m/d/Y', stripcslashes($date));
            }
            // filter by date range
            $data = array_filter($data, function ($a) use ($field, $filter) {
                // hardcoded date format
                $current = date_create_from_format('m/d/Y', $a[$field]);
                $from = $filter[0];
                $to = $filter[1];
                if ($from <= $current && $to >= $current) {
                    return true;
                }

                return false;
            });
        }

        return $data;
    }

    public function profile(Request $request)
    {
        if (request()->segment(1) == 'client') {
            $title = __('messages.Account Settings');
            $userId = Auth::id();
            $client = Client::find($userId);
            $products = Product::where('client_id', $userId)->count();
            $customers = Customer::where('client_id', $userId)->count();
            $invoices = InvoiceHeader::where('client_id', $userId)->count();

            $profile_complete = 0;
            $profile_complete_percentage = 0;

            if ($client->email)
                $profile_complete++;
            if ($client->name_ar)
                $profile_complete++;
            if ($client->name_en)
                $profile_complete++;
            if ($client->code)
                $profile_complete++;
            if ($client->phone)
                $profile_complete++;
            if ($client->fax)
                $profile_complete++;
            // if($client->start_date)  $profile_complete++;
            if ($client->commercial_registration_no)
                $profile_complete++;
            if ($client->tax_registration_no)
                $profile_complete++;
            if ($client->tax_file_no)
                $profile_complete++;
            if ($client->tax_office)
                $profile_complete++;
            // if($client->type)  $profile_complete++;
            if ($client->country)
                $profile_complete++;
            if ($client->city)
                $profile_complete++;
            if ($client->district)
                $profile_complete++;
            if ($client->post_number)
                $profile_complete++;
            if ($client->building_number)
                $profile_complete++;
            if ($client->street_name)
                $profile_complete++;
            if ($client->image)
                $profile_complete++;
            if ($client->client_id)
                $profile_complete++;
            if ($client->client_secret)
                $profile_complete++;


            $profile_complete_percentag = ($profile_complete / 21) * 100;
            $profile_complete_percentag = ceil($profile_complete_percentag);


            return view('auth.admin.clients.profile', ['title' => $title, 'client' => $client, 'products' => $products, 'customers' => $customers, 'invoices' => $invoices, 'profile_complete_percentag' => $profile_complete_percentag]);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $this->authorize(self::MODEL.'-update');
        $client = Client::find($id);

        $client->name_ar = $request->name_ar;
        $client->name_en = $request->name_en;
        $client->code = $request->code;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        /*  $client->commercial_registration_no = $request->commercial_registration_no;
         $client->tax_registration_no = $request->tax_registration_no;
         $client->tax_file_no = $request->tax_file_no;
         $client->tax_office = $request->tax_office;
         $client->country = $request->country;
         $client->governorate = $request->governorate;
         $client->city = $request->city;
         $client->district = $request->district;
         $client->post_number = $request->post_number;
         $client->building_number = $request->building_number;
         $client->street_name = $request->street_name;*/

        if ($avatar = $this->upload()) {
            $client->image = $avatar;
        }

        if ($request->boolean('avatar_remove')) {
            Storage::delete("public/" . $client->image);
            $client->image = null;
        }

        $client->save();
        return response()->json(['client' => $client]);
    }

    public function updateClientTax(Request $request, $id)
    {
        $this->authorize(self::MODEL.'-update');
        $client = Client::find($id);

        $client->client_id = $request->client_id;
        $client->client_secret = $request->client_secret;
        $client->save();
        return response()->json(['client' => $client]);
    }

    /**
     * Function for upload avatar image
     *
     * @param  string  $folder
     * @param  string  $key
     * @param  string  $validation
     *
     * @return false|string|null
     */
    public function upload($folder = 'images/clients', $key = 'file', $validation = 'mimes:jpeg,png,jpg,gif,bmp,pdf,docx,doc,csv,xlsx,xls,ppt,odt,ods,odp,svg|max:2048|sometimes')
    {
        $files = request()->validate([$key . '.*' => $validation]);

        $uploadedFiles = [];

        foreach (request()->file($key) as $index => $file) {
            if ($file->isValid()) {
                $uploadedFiles[] = Storage::disk('public')->putFile($folder, $file, 'public');
            }
        }

        return $uploadedFiles;
    }

    public function clientFiles($client_id)
    {
        $title = __('messages.client_files');
        $Client = Client::find($client_id);
        
        $procedures_ids = Problem::where('client_id', $client_id)
        ->where('type','procedure')
        ->pluck('id')->toArray();

        $ProblemProcedure_ids = ProblemProcedure::whereIn('problem_id', $procedures_ids)->pluck('id')->toArray();

        $ProblemProcedureFiles = ProblemsProcedureFile::whereIn('problems_procedure_id', $ProblemProcedure_ids)->get();

        //===============================================//

        $cases_ids = Problem::where('client_id', $client_id)
        ->where('type','case')
        ->pluck('id')->toArray();



        $ProblemCase_ids = ProblemProcedure::whereIn('problem_id', $cases_ids)->pluck('id')->toArray();



        $ProblemcaseFiles = ProblemsProcedureFile::whereIn('problems_procedure_id', $ProblemCase_ids)->get();


        $page_title = __('messages.client_files') . " / " . $Client->display_name ; 

        return view('auth.admin.clients.client_files',['title' => $title, 'client_id' => $client_id, 'Client' => $Client, 'ProblemProcedureFiles' => $ProblemProcedureFiles, 'ProblemcaseFiles' => $ProblemcaseFiles, 'page_title' => $page_title]);
    }

    public function getClientFiles(Request $request , $client_id)
    {


        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#'   => true,
            'id'   => true,
            'clients'   => true,
            'file_name'   => true,
            // 'file'   => true,
            'download'   => true,
            'created_at'   => true,
        ];
        
        if ( isset( $request->columnsDef ) && is_array( $request->columnsDef ) ) {
            $columnsDefault = [];
            foreach ( $request->columnsDef as $field ) {
                $columnsDefault[ $field ] = true;
            }
        }
        
        $active = $request->active;

        $alldata = ClientFile::where('client_id',$client_id)->get();

        if($active=='All'){
            $alldata = ClientFile::withTrashed()->where('client_id',$client_id)->get();
        }
        elseif($active=='Active'){
            $alldata = ClientFile::where('client_id',$client_id)->get();
        }
        elseif($active=='DeActive'){
            $alldata = ClientFile::onlyTrashed()->where('client_id',$client_id)->get();
        }
        
 
        $alldataResult=array();

        foreach($alldata as $objdata){

            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "clients" => $objdata->client->display_name,
                "file_name" => $objdata->file_name,
                // "file" => '<img style=" width: 50px;height: 50px;" src="' . asset('storage/' . $objdata->file) . '" alt="Client Image">',
                "download" => '<a target="_blank" href="' . asset('storage/app/public/' . $objdata->file) . '">download<a>',
                "created_at" => Date('Y-m-d h:i:s',strtotime($objdata->created_at)),
            );
        }
 
         
       // dd($alldataResult);
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

    public function SaveClientFiles(Request $request , $client_id)
    {
        // if(!Auth::guard('admin')->check()){
        //     return abort('403');
        // }

        $rules = [
            'file_name' => ['required'],
            'file' => ['required'],
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {    
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        if($request->file){
            foreach ($this->upload() as $file) {
            $clientFile = new ClientFile();
            $clientFile->client_id = $client_id;
            $clientFile->file_name = $request->file_name;
            $clientFile->file = $file;
            $clientFile->save();
            }
        }
        

        $arrClientFiles = clientFile::where('client_id',$client_id)->orderBy('id')->get();

        return response()->json(['arrClientFiles'=>$arrClientFiles]);
    }

    public function deleteClientFiles($id)
    {
        $ClientFile = ClientFile::where('id',$id)->delete();
        return response()->json(['ClientFile'=>$ClientFile]);
    }

    public function deleteSelectedClientFiles(Request $request)
    {
        
        $ClientFile = ClientFile::whereIn('id',$request->ids)->delete();
        return response()->json(['ClientFile'=>$ClientFile]);
    }


    public function GetClientFile($id)
    {
        $ClientFile  = ClientFile::find($id);
        return response()->json($ClientFile);
    }


     public function UpdateClientFiles(Request $request , $ClientFile_id)
    {

        $this->authorize(self::MODEL.'-update');

        $ClientFile = ClientFile::where('id', $ClientFile_id)
       ->update([
           'file_name' => $request->file_name
        ]);

        return response()->json(['ClientFile'=>$ClientFile]);
    }


    public function print($id)
    {
        $Client = Client::find($id);

        $ProcedureStock = $Client->getProcedureStock();

        $CaseStock = $Client->getCaseStock();
        


        if($ProcedureStock>0){
            $ProcedureStock = "له  $ProcedureStock" ;
        }
        elseif($ProcedureStock==0){
            $ProcedureStock = $ProcedureStock ;
        }
        else{
            $ProcedureStock = $ProcedureStock*-1;
            $ProcedureStock = "عليه $ProcedureStock" ;
        }




        if($CaseStock>0){
            $CaseStock = "له  $CaseStock" ;
        }
        elseif($CaseStock==0){
            $CaseStock = $CaseStock ;
        }
        else{
            $CaseStock = $CaseStock*-1;
            $CaseStock = "عليه $CaseStock" ;
        }


        $title = __('messages.print');

        $page_title = "طباعه ملف الموكل :  $Client->display_name";
        return view('auth.admin.clients.print', ['Client' => $Client,'title' => $title,'page_title' => $page_title,'ProcedureStock' => $ProcedureStock,'CaseStock' => $CaseStock]);
    }

    public function client_permissions($main_client_id)
    {
        
        $userId = \Auth::id();
        $objAdmin = Admin::find($userId);
        $title = __('messages.client_permissions');
        $clients = Client::where('id','!=',$main_client_id)->get();
        $Client = Client::find($main_client_id);
        
        # get client permission
        $arrClientPermission = ClientPermission::where('main_client_id', $main_client_id)->pluck('sub_client_id')->toArray();

        $page_title = __('messages.client_permissions') . " / " . $Client->display_name ; 

        return view('auth.admin.clients.client_permissions', [
            'title' => $title,
            'clients' => $clients,
            'arrClientPermission' => $arrClientPermission,
            'main_client_id' => $main_client_id,
            'page_title' => $page_title,
            
        ]);
    }

    public function client_permissions_save(Request $request)
    {
        //DELETE CLIENT PERMISSIONS 
        ClientPermission::where('main_client_id',$request->main_client_id)->delete();


        //ADD CLIENT PERMISSIONS
        if($request->sub_client_id){
            foreach ($request->sub_client_id as $key => $client_id) {
               ClientPermission::create(
                [
                    'main_client_id' => $request->main_client_id,
                    'sub_client_id' => $client_id,
                ]
                );
            }
        }

        return Redirect::back();

    }
}
