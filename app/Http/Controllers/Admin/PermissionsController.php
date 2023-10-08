<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\HistoricalEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\HistoricalEvents\HistoricalEvents as HES;
use App\Models\BasePermission;
use App\Models\Department;
class PermissionsController extends Controller
{
    private const MODEL ='Permission';
    public function index()
    {
        $this->authorize(self::MODEL.'-viewAny');
        $title = __('messages.permissions');
        $permissions = Permission::all();
        $models = BasePermission::MODELS;
        $departments = Department::all();
        return view('auth.admin.permissions.index', ['permissions' => $permissions,'models' => $models,'departments' => $departments,'title' => $title]);
    }

    public function store(Request $request)
    {
        $this->authorize(self::MODEL.'-store');
        $validator = Validator::make($request->all(), [
            'department_id' => ['required','integer'],
            'position_id' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $userId = \Auth::id();

        $models = BasePermission::MODELS;

        foreach ($models as $model) {
            if(!empty($_POST['model_'.$model])){
                $permissions = $_POST['model_'.$model];

                foreach ($permissions as $permission) {

                    # check if exist
                    $exist = Permission::where('position_id',$request->position_id)->where('permission_name',$model.'-'.$permission)->first();
                    if(!$exist){

                        $objPermission = new Permission();
                        $objPermission->position_id = $request->position_id;
                        $objPermission->permission_name = $model.'-'.$permission;
                        $objPermission->save();
                    }


                }
            }
        }
         

        return response()->json(['objPermission' => $objPermission]);
    }

    public function edit($id)
    {
        $this->authorize(self::MODEL.'-update');
        $permissions = permission::find($id);
        return response()->json($permissions);
    }

    public function update(Request $request, permission $permission)
    {
        $this->authorize(self::MODEL.'-update');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:permissions,name'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $objProduct = $permission;
        $objProduct->name = $request->name;
        $objProduct->save();


        HistoricalEvents::dispatch(
            Permission::EVENTS[1],
            Permission::class,
            $objProduct->id,
            HES::ACTIONS['UPDATE'],
            CLIENT::class,
            $request->user()->id,
            "permission record updated",
            []
        );

        return response()->json(['objProduct' => $objProduct]);
    }

    public function destroy($id)
    {
        $this->authorize(self::MODEL.'-delete');
        $permission = Permission::where('id', $id)->delete();

        HistoricalEvents::dispatch(
            Permission::EVENTS[2],
            Permission::class,
            $id,
            HES::ACTIONS['DELETE'],
            CLIENT::class,
            request()->user()->id,
            "permission record deleted",
            []
        );

        return response()->json(['permission' => $permission]);
    }


    public function get(Request $request)
    {
        $this->authorize(self::MODEL.'-viewAny');
        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#' => true,
            'id' => true,
            'position_name' => true,
            'permission_name' => true,
            'created_at' => true,
        ];

        if (isset($request->columnsDef) && is_array($request->columnsDef)) {
            $columnsDefault = [];
            foreach ($request->columnsDef as $field) {
                $columnsDefault[$field] = true;
            }
        }

        $active = $request->active;

        $userId = Auth::id();
        $alldata = Permission::all();

        if ($active == 'All') {
            $alldata = Permission::withTrashed()->get();
        } elseif ($active == 'Active') {
            $alldata = Permission::get();
        } elseif ($active == 'DeActive') {
            $alldata = Permission::onlyTrashed()->get();
        }


        $alldataResult = array();

        foreach ($alldata as $objdata) {

            $active = "active";
            if (!$objdata->active) $active = "Not Active";
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "position_name" => $objdata->position->display_name,
                "permission_name" => $objdata->permission_name,
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
            if (!empty($field)) {
                if (strpos(strtolower($field), 'date') !== false) {
                    // filter by date range
                    $data = filterByDateRange($data, $filter, $field);
                } else {
                    // filter by column
                    $data = array_filter($data, function ($a) use ($field, $filter) {
                        return (bool)preg_match("/$filter/i", $a[$field]);
                    });
                }
            } else {
                // general filter
                $data = array_filter($data, function ($a) use ($filter) {
                    return (bool)preg_grep("/$filter/i", (array)$a);
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

    function loadProductByCode($id)
    {
        $this->authorize(self::MODEL.'-viewAny');
        $Code = Code::find($id);
        return response()->json($Code);
    }

}
