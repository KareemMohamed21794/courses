<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Auth;
use App\Models\Admin;
use App\Services\Sms\SmsProviderFactory;
use App\Services\Sms\SmsProviderInterface;

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

        $this->app->singleton(SmsProviderInterface::class, function () {
            return SmsProviderFactory::make();
        });
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

            $encode_id = "";
            $encodeId = "";
         

            # check if a super_admin
            $userId = Auth::id();
            $objAdmin = Admin::find($userId);
            
           

            // // Add more similar blocks for other notification sources

            $view->with('notifications', $notifications);
            $view->with('objAdmin', $objAdmin);
           
        });
    }


}
