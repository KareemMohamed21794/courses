<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Problem;
use App\Models\ProblemProcedure;
class send_deadline_emails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_deadline_emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to send email to Lawyer Email if the deadline is complete and he not make any action on it  ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        # check for email
        $notifications = [];

         
        $problemNotifications = Problem::where('type', 'procedure')
        ->where('status', '!=', 'complete')
        ->where('id',90)
        ->whereDate('deadline', '<', today())
        ->get();

       
        foreach ($problemNotifications as $problem) {
            
            # get last problemprocedure 
            $objLastProblemProcedure = ProblemProcedure::where('problem_id',$problem->id)->Latest()->first();

 
             

            // if(empty($objLastProblemProcedure)){
                
                $lawyer_name = $problem->staff->name;
                $subject = $problem->subject;
                $client_name = $problem->client->name_ar;
                 
                $problem_number = $problem->problem_number;
                $reviewer = $problem->reviewer;
                $deadline = $problem->deadline;
                

                 
                 
                # send email 
                $recipient = $problem->staff->email;;
                $subject = $subject;

                $data= [
                        'source' => 'Problem',
                        'id' => $problem->id,
                        'title' => "تذكير",
                        'lawyer_name' => $lawyer_name,
                        'subject' => $subject,
                        'client_name' => $client_name,
                        'problem_number' => $problem_number,
                        'reviewer' => $reviewer,
                        'deadline' => $deadline,
                        'objLastProblemProcedure' => $objLastProblemProcedure,
                        
                ];

                $fromEmail = 'info@lawjo.net'; 
                //The "from" email address

                Mail::send('emails.send_deadline_emails', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                    $mail->to($recipient)
                        ->from($fromEmail,"تطبيق قلم") // Set the "from" email address
                        ->subject($subject)
                        ->cc("e_amawi@lawjo.net")
                        ;
                });
                
            // } 
 
             
        }    

        // print_r($problemNotifications) ; die;

        $this->info("send emails from here");
    }
}
