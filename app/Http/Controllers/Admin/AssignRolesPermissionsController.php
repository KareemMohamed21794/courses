<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Client;
use App\Models\Product;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\HistoricalEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\HistoricalEvents\HistoricalEvents as HES;

class AssignRolesPermissionsController extends Controller
{
    public function index()
    {
        $title = __('messages.assign-permissions');
        $roles = Role::all();
        $permissions = Permission::all();
        return view('auth.admin.assign_permissions.index', ['roles' => $roles, 'permissions' => $permissions]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50', 'unique:permissions,name'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $userId = \Auth::id();

        $product = Permission::create([
            'name' => $request->name,
            'active' => $request->select_active,
        ]);

        HistoricalEvents::dispatch(
            Permission::EVENTS[0],
            Product::class,
            $product->id,
            HES::ACTIONS['CREATE'],
            CLIENT::class,
            $request->user()->id,
            "new permissions record created",
            []
        );

        return response()->json(['Product' => $product]);
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return response()->json($client);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'roles' => ['array'],
            'roles.*' => ['required', 'integer', 'exists:roles,id'],
            'permissions' => ['array'],
            'permissions.*' => ['required', 'integer', 'exists:permissions,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $client = Client::query()->where('id', '=', $id)->first();
        // $roles = Role::query()->whereIn('id', $request->roles)->get()->pluck('name');
        // $client->assignRole($roles);
        $client->syncRoles($request->roles);
        $client->syncPermissions($request->permissions);


        $objProduct = $client;

        /* HistoricalEvents::dispatch(
            Permission::EVENTS[1],
            Permission::class,
            $objProduct->id,
            HES::ACTIONS['UPDATE'],
            CLIENT::class,
            $request->user()->id,
            "permission record updated",
            []
        ); */

        return response()->json(['objProduct' => $objProduct]);
    }

    public function destroy($id)
    {
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

        ini_set('memory_limit', '-1');
        $columnsDefault = [
            '#' => true,
            'id' => true,
            'name' => true,
            'email' => true,
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
        $alldata = Client::all();

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
            if (!$objdata->active) $active = "Not Active";
            $alldataResult[] = array(
                "#" => $objdata->id,
                "id" => $objdata->id,
                "name" => $objdata->display_name,
                "email" => $objdata->email,
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
        $Code = Code::find($id);
        return response()->json($Code);
    }
}
