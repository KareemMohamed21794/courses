<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Advertisement;
use Auth;
use App\Models\Admin;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //check that app is local
        if ($this->app->isLocal()) {

        } else {
            \URL::forceScheme('https');
        }

        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $notifications = [];

            # check if a super_admin
            $userId = Auth::id();
            $objAdmin = Admin::find($userId);

             
            $Advertisements = Advertisement::where('read',0)
            ->where('admin_id',@$objAdmin->id)
            ->get();
            
            
            foreach ($Advertisements as $Advertisement) {
                $notifications[] = [
                    'source' => 'Advertisement',
                    'id' => $Advertisement->id,
                    'title' => "وارد",
                    'body' => "لديك وارد من مدير نظام تواصل، يرجى التأكد منه، للمشاهدة ",
                ];
            }

             

            // // Add more similar blocks for other notification sources

            $view->with('notifications', $notifications);
            $view->with('objAdmin', $objAdmin);
        });
    }
}
