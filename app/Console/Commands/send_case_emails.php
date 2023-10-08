<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Problem;
use App\Models\ProblemProcedure;
class send_case_emails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_case_emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to send email to Lawyer before  1 day from case';

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

        $tomorrow = Carbon::now()->addDay(); // Get tomorrow's date

     
        $problemNotifications = Problem::join('problems_procedure', 'problems.id', '=', 'problems_procedure.problem_id')
        ->where('problems.type', 'case')
        ->where('problems.status', '!=', 'complete')
        ->where('problems_procedure.next_session_date', $tomorrow->toDateString()) // Compare the date part only
        ->select('problems.id','problems.problem_number','problems.problem_date','problems.reviewer','problems.deadline','problems.court','problems_procedure.judge','problems_procedure.date','problems.admin_id','problems.client_id','problems_procedure.next_session_date')
        ->get();

        


        foreach ($problemNotifications as $problem) {
            
            # get last problemprocedure 
            $objLastProblemProcedure = ProblemProcedure::where('problem_id',$problem->id)->Latest()->first(); 

            $ProblemOtherpersonOtherlawer = $problem->ProblemOtherpersonOtherlawer;

            $resultString = "";
            foreach ($ProblemOtherpersonOtherlawer as $index => $item) {
                
                // Add the Arabic index and the item to the result string
                $resultString .=  $item->other_person."، ";
            }

            // Remove the last comma and space (، ) from the result string
            $resultString = rtrim($resultString, '، ');

            $check_other_person = "";

            $check_other_person = "والخصم هو:";
            if(count($ProblemOtherpersonOtherlawer)>1){
                $check_other_person = "والاخصام هم:";
            }else{
                $check_other_person = "والخصم هو:";
            }

             
            // print_r($objLastProblemProcedure); die;   


            $lawyer_name = $problem->staff->name;
            $subject = $problem->subject;
            $client_name = $problem->client->name_ar;
             
            $problem_number = $problem->problem_number;
            $problem_date = $problem->problem_date;
            $reviewer = $problem->reviewer;
            $deadline = $problem->deadline;
            $court = $problem->court;
            $judge = $problem->judge;
            $next_session_date = $problem->next_session_date;
            $date = $problem->date;
            $notes = $objLastProblemProcedure->notes;
            

             
             
            # send email 
            $recipient = $problem->staff->email;;
            $subject = " تذكير موعد جلسة - ( $problem_number / $problem_date )،  ( $court  -  $client_name )";

            $data= [
                    'source' => 'Problem',
                    'id' => $problem->id,
                    'title' => "تذكير",
                    'lawyer_name' => $lawyer_name,
                    'subject' => $subject,
                    'client_name' => $client_name,
                    'problem_number' => $problem_number,
                    'problem_date' => $problem_date,
                    'reviewer' => $reviewer,
                    'deadline' => $deadline,
                    'court' => $court,
                    'judge' => $judge,
                    'next_session_date' => $next_session_date,
                    'date' => $date,
                    'notes' => $notes,
                    'resultString' => $resultString,
                    'check_other_person' => $check_other_person,
                    
                    
     
            ];

            $fromEmail = 'info@lawjo.net'; 
            //The "from" email address

            // print_r('ssss'); die;
            Mail::send('emails.send_case_emails', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                $mail->to($recipient)
                    ->from($fromEmail,"تطبيق قلم") // Set the "from" email address
                    ->subject($subject)
                    ->cc("e_amawi@lawjo.net")
                    ;
            });

             
        }    

        // print_r($problemNotifications) ; die;

        $this->info("send emails from here");
    }
}
