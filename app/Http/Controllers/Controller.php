<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use  DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Log function that can be called from any controller
    protected function logAction($user_id, $user_type, $action, $action_type = null, $table_name, $table_id)
    {
        DB::table('logs')->insert([
            'user_id' => $user_id,
            'user_type' => $user_type,
            'action' => $action,
            'action_type' => $action_type,
            'table_name' => $table_name,
            'table_id' => $table_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
