<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\BasePermission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * System Permissions
         */
        $models = BasePermission::MODELS;
        
       
        $adminIds = [1]; // Admin Ids
        foreach($models as $model){
            // Index - Show - get
            Gate::define($model.'-viewAny', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-viewAny')->count();
                if($countPermission) return true;
            });

            // Create - Store
            Gate::define($model.'-store', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-store')->count();
                if($countPermission) return true;
            });

            // Edit - update
            Gate::define($model.'-update', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-update')->count();
                if($countPermission) return true;
            });

            // Delete - Destroy
            Gate::define($model.'-delete', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-delete')->count();
                if($countPermission) return true;
            });

            // money - money
            Gate::define($model.'-money', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-money')->count();
                if($countPermission) return true;
            });

            // show_all_approved - show_all_approved
            Gate::define($model.'-show_all_approved', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-show_all_approved')->count();
                if($countPermission) return true;
            });


            // show_all_not_approved - show_all_not_approved
            Gate::define($model.'-show_all_not_approved', function (Admin $admin) use ($adminIds,$model) {
                if(!$admin->position_id) return false;
                # check if user_have permission 
                $countPermission = Permission::where('position_id',$admin->position_id)
                ->where('permission_name',$model.'-show_all_not_approved')->count();
                if($countPermission) return true;
            });
        }
    }
}
