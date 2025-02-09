<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Advertisement;
use App\Models\AdvertisementParent;
use App\Models\Information;
use App\Models\QualificationLeader;
use App\Models\Permit;
use App\Models\File;
use App\Models\Setup;
use App\Models\CommanderMedal;
use App\Models\AchievementStudyRequirement;
use App\Models\OrganizingStudy;
use App\Models\BoardDirector;
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

            $encode_id = "";
            $encodeId = "";
         

            # check if a super_admin
            $userId = Auth::id();
            $objAdmin = Admin::find($userId);
            
            //leaders
            if(@$objAdmin->position_id==2){
            $encode_id = $objAdmin->id;
            $encodeId = $this->encodeSecureId($encode_id);
            
           }

          
            $Advertisements = Advertisement::where('read',0)
            ->where('admin_id',@$objAdmin->id)
            ->get();

            $objSetup = Setup::first();
            
            
            foreach ($Advertisements as $Advertisement) {
                $notifications[] = [
                    'source' => 'Advertisement',
                    'id' => $Advertisement->id,
                    'title' => "وارد",
                    'body' => "لديك وارد من مدير نظام تواصل، يرجى التأكد منه، للمشاهدة ",
                ];
            }


            if(@$objAdmin->is_super == 0){
           
            $permit_counter = Permit::where('admin_id',@$objAdmin->id)->where('read',0)->count();
            $advirtesment_counter = Advertisement::where('admin_id',@$objAdmin->id)->where('read',0)->count();
            $secondary_registration_counter = File::where('admin_id',@$objAdmin->id)->where('type','secondary_registration')->where('read',0)->count();
            $administrative_counter = File::where('admin_id',@$objAdmin->id)->where('type','administrative')->where('read',0)->count();
            $financial_counter = File::where('admin_id',@$objAdmin->id)->where('type','financial')->where('read',0)->count();
            $board_director_meetings_counter = File::where('admin_id',@$objAdmin->id)->where('type','board_director_meetings')->where('read',0)->count();

            $commander_medal_counter = CommanderMedal::where('admin_id',@$objAdmin->id)->where('read',0)->count();

            $qualification_leader_counter = QualificationLeader::where('admin_id',@$objAdmin->id)->where('read',0)->count();
            $achivement_study_counter = AchievementStudyRequirement::where('admin_id',@$objAdmin->id)->where('read',0)->count();

            $organizing_study_counter = OrganizingStudy::where('admin_id',@$objAdmin->id)->where('read',0)->count();


            $total_leader_counter = ($qualification_leader_counter + $achivement_study_counter + $organizing_study_counter);


            $information_counter = Information::where('admin_id',@$objAdmin->id)->where('read',0)->count();

            $BoardDirector_counter = BoardDirector::where('admin_id',@$objAdmin->id)->where('read',0)->count();

            }else{
            
             $permit_counter = Permit::where('read',0)->count();
             $advirtesment_counter = AdvertisementParent::where('read',0)->count();
             $secondary_registration_counter = File::where('type','secondary_registration')->where('read',0)->count();
             $administrative_counter = File::where('type','administrative')->where('read',0)->count();
             $financial_counter = File::where('type','financial')->where('read',0)->count();
             $board_director_meetings_counter = File::where('type','board_director_meetings')->where('read',0)->count();

             $commander_medal_counter = CommanderMedal::where('read',0)->count();

             $qualification_leader_counter = QualificationLeader::where('read',0)->count();
             $achivement_study_counter = AchievementStudyRequirement::where('read',0)->count();

             $organizing_study_counter = OrganizingStudy::where('read',0)->count();

             $total_leader_counter = ($qualification_leader_counter + $achivement_study_counter + $organizing_study_counter);


             $information_counter = Information::where('read',0)->count();
             $BoardDirector_counter = BoardDirector::where('read',0)->count();
            }
             

            // // Add more similar blocks for other notification sources

            $view->with('notifications', $notifications);
            $view->with('objAdmin', $objAdmin);
            $view->with('permit_counter', $permit_counter);
            $view->with('advirtesment_counter', $advirtesment_counter);
            $view->with('secondary_registration_counter', $secondary_registration_counter);
            $view->with('administrative_counter', $administrative_counter);
            $view->with('financial_counter', $financial_counter);
            $view->with('board_director_meetings_counter', $board_director_meetings_counter);
            $view->with('commander_medal_counter', $commander_medal_counter);
            $view->with('qualification_leader_counter', $qualification_leader_counter);
            $view->with('achivement_study_counter', $achivement_study_counter);
            $view->with('organizing_study_counter', $organizing_study_counter);
            $view->with('total_leader_counter', $total_leader_counter);
            $view->with('information_counter', $information_counter);
            $view->with('BoardDirector_counter', $BoardDirector_counter);
            $view->with('objSetup', $objSetup);
            $view->with('encodeId', $encodeId);
        });
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
