<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Admin;
use App\Models\File;
use App\Models\Permit;
use App\Models\QualificationLeader;


use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        # check for email
        $notifications = [];

        # check if a super_admin
        $userId = Auth::id();
        $objAdmin = Admin::find($userId);
        if($objAdmin->is_super == 0){
             return redirect('admin/leaders');
        }
        $problemNotifications = array();

        
        $userId = \Auth::id();
        if(request()->segment(1)=='admin'){
            $title = "الاداره: ".__('messages.Dashboard');
        }else{
            $title = "الموكل :".__('messages.Dashboard');
        }

        $count_admins = Admin::where('position_id',1)->count();
        $count_lawyers = Admin::where('position_id',2)->count();
        $count_leaders = Admin::where('is_super',0)->count();
        
        $count_secondary_registrations = File::where('type','secondary_registration')->where('year',date('Y'))->count();

        $count_administrative_financial_reports = File::where('type','administrative_financial')->where('year',date('Y'))->count();

        $count_board_director_meetings = File::where('type','board_director_meetings')->where('year',date('Y'))->count();

        $count_permits = Permit::count();
        $count_qualificationLeaders = QualificationLeader::count();
        $count_qualificationLeaders_ghayr_muahal = QualificationLeader::where('current_qualification','ghayr_muahal')->count();
        $count_qualificationLeaders_musaeid_qayid_wahdah = QualificationLeader::where('current_qualification','musaeid_qayid_wahdah')->count();
        $count_qualificationLeaders_qayid_wahda = QualificationLeader::where('current_qualification','qayid_wahda')->count();
        $count_qualificationLeaders_musaeid_qayid_tadrib = QualificationLeader::where('current_qualification','musaeid_qayid_tadrib')->count();
        $count_qualificationLeaders_qayid_tadrib = QualificationLeader::where('current_qualification','qayid_tadrib')->count();


        $leaders_number = Admin::sum('leaders_number');
        $persons_number = Admin::sum('persons_number');
        $groups = Admin::sum('groups');

        return view('auth.admin.dashboard',['title' => $title,'count_admins' => $count_admins,'count_lawyers' => $count_lawyers,'count_leaders' => $count_leaders,'count_secondary_registrations' => $count_secondary_registrations,'count_administrative_financial_reports' => $count_administrative_financial_reports,'count_board_director_meetings' => $count_board_director_meetings,'count_permits' => $count_permits,'count_qualificationLeaders' => $count_qualificationLeaders,'count_qualificationLeaders_ghayr_muahal' => $count_qualificationLeaders_ghayr_muahal,'count_qualificationLeaders_musaeid_qayid_wahdah' => $count_qualificationLeaders_musaeid_qayid_wahdah,'count_qualificationLeaders_qayid_wahda' => $count_qualificationLeaders_qayid_wahda,'count_qualificationLeaders_musaeid_qayid_tadrib' => $count_qualificationLeaders_musaeid_qayid_tadrib,'count_qualificationLeaders_qayid_tadrib' => $count_qualificationLeaders_qayid_tadrib,'leaders_number' => $leaders_number,'persons_number' => $persons_number,'groups' => $groups]);
    }

     

    public function upload_csv()
    {
        $title = "Upload CSV";
        return view('auth.admin.upload_csv', [
            'title' => $title,
        ]);
    }

    public function upload_csv_save(Request $request)
    {
        //DB::table('test_upload')->truncate();

        ini_set('max_execution_time', '0');
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        

        $files = request()->file('file');
        foreach ($files as $file){
            Excel::import(new DataImport, $file);
        }

        // $arrData = DB::table('test_upload')->get();

        // return response()->view('auth.admin.test_upload', [
        //     'arrData' => $arrData
        // ])->header('Content-Type', 'text/vwl');

        
    }


    public function send_email()
    {

        $recipient = 'mahmoud.ali.29992@gmail.com';
        $subject = 'Subject of the Emailss';

        $data = ['content' => 'This is the email content.']; // Data to pass to the view

        $fromEmail = 'info@privatescouts.org'; 
        // The "from" email address

        Mail::send('emails.accept', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
            $mail->to($recipient)
                ->from($fromEmail) // Set the "from" email address
                ->subject($subject);
        });

        return "Email sent successfully!";
    }
}
