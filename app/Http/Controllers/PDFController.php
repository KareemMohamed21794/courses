<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
use TCPDF;
use App\Models\Client;
use App\Models\Problem;
use Illuminate\Support\Facades\Mail;
use App\Models\ProblemProcedure;
use Carbon\Carbon;
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $title = "Hello";
		$date = date('Y-m-d');
		$clientName = "John Doe";
		$lawyerName = "Jane Smith";
		$transactions = [
		    "Transaction 1",
		    "Transaction 2",
		    "Transaction 3"
		];

		$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->setPrintHeader(false); // Disable header
		$pdf->SetFont('dejavusans', '', 12, '', false);
		$pdf->AddPage();

		$viewData = compact('title', 'date', 'clientName', 'lawyerName', 'transactions');
		$html = view('myPDF', $viewData)->render();

		$pdf->writeHTML($html);

		$pdf->Output('filename.pdf', 'D');
    }

    public function ExportClients(Request $request)
{
    $fileName = 'clients.csv';
    $clients = Client::all();

    // Set the response headers with the correct character encoding
    $headers = array(
        "Content-type"        => "text/csv; charset=utf-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    // If you need to display Arabic column header, make sure to encode it as well
    $columns = array(__('messages.client_code'),__('messages.id_secondary'),__('messages.lawer_type'),__('messages.client_name'),__('messages.email'),__('messages.username'),__('messages.phone'),__('messages.address'),__('messages.commercial_registration_no'),'الجنسية','النوع القانوني الاجتماعي  ');

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($clients, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($clients as $client) {
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['code']  = $client->code;
            $row['id_secondary']  = $client->id_secondary;
            if($client->type == 'personal_relationships'){
                $row['type']  = 'علاقات شخصية ';
            }elseif($client->type == 'international_organizations'){
                $row['type']  = 'منظمات دولية ';
            }elseif($client->type == 'social_media'){
                $row['type']  = ' وسائل تواصل اجتماعي  ';
            }elseif($client->type == 'friends'){
                $row['type']  = 'اصدقاء';
            }elseif($client->type == 'other'){
                $row['type']  = 'اخرى';
            }else{
                $row['type']  = '';
            }

            $row['name_ar']  = $client->name_ar;
            $row['email']  = $client->email;
            $row['username']  = $client->username;
            $row['phone']  = $client->phone;
            $row['street_name']  = $client->street_name;
            $row['commercial_registration_no']  = $client->commercial_registration_no;
            $row['country']  = $client->country;

            if($client->client_customer_type == 'male'){
                $row['client_customer_type']  = 'ذكر';
            }elseif($client->client_customer_type == 'female'){
                $row['client_customer_type']  = 'انثى';
            }elseif($client->client_customer_type == 'gov'){
                $row['client_customer_type']  = 'جهة حكومية';
            }elseif($client->client_customer_type == 'company'){
                $row['client_customer_type']  = 'شركة';
            }elseif($client->client_customer_type == 'other'){
                $row['client_customer_type']  = 'اخرى';
            }else{
                $row['client_customer_type']  = '';
            }
            
           

            // Write the row data to the CSV file
            fputcsv($file, array($row['code'],$row['id_secondary'],$row['type'],$row['name_ar'],$row['email'],$row['username'],$row['phone'],$row['street_name'],$row['commercial_registration_no'],$row['country'],$row['client_customer_type']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}



    public function ExportProcedures(Request $request)
{
    $fileName = 'procedures.csv';
    $Problems = Problem::where('type','procedure')->with('staff')->with('client')->orderBy('id')->get();
    
    // Set the response headers with the correct character encoding
    $headers = array(
        "Content-type"        => "text/csv; charset=utf-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    // If you need to display Arabic column header, make sure to encode it as well
    $columns = array(__('messages.procudure_code'),__('messages.id_secondary'),__('messages.Staff'),__('messages.clients'),__('messages.client_type'),__('messages.problem_number'),__('messages.file_open_date'),__('messages.reviewer'),__('messages.deadline'),__('messages.status'),__('messages.notes'),__('messages.Total_Cost'),__('messages.Total_Duration'),__('messages.progress'));

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($Problems, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($Problems as $Problem) {
            
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['code']  = $Problem->id;
            $row['id_secondary']  = $Problem->id_secondary;
            $row['staff']  = @$Problem->staff->name;
            $row['client']  = @$Problem->client->name_ar;

            if($Problem->client_type == 'plaintiff'){
                $row['client_type']  = __('messages.plaintiff');
            }elseif($Problem->client_type == 'defendant'){
                $row['client_type']  = __('messages.defendant');
            }elseif($Problem->client_type == 'claimant'){
                $row['client_type']  = __('messages.claimant');
            }elseif($Problem->client_type == 'respondent'){
                $row['client_type']  = __('messages.respondent');
            }elseif($Problem->client_type == 'other'){
                $row['client_type']  = __('messages.other');
            }else{
                $row['client_type']  = '';
            }
            $row['problem_number']  = $Problem->problem_number;
            $row['file_open_date']  = $Problem->file_open_date;
            $row['reviewer']  = $Problem->reviewer;
            $row['deadline']  = $Problem->deadline;
            if($Problem->status == 'pending'){
                $row['status']  = __('messages.pending');
            }elseif($Problem->status == 'stopped'){
                $row['status']  =  __('messages.stopped');
            }elseif($Problem->status == 'completed'){
                $row['status']  = __('messages.completed');
            }elseif($Problem->status == 'running'){
                $row['status']  = __('messages.running');
            }else{
                $row['status']  = '';
            }

            $row['notes']  = $Problem->notes;

            $total_cost = ProblemProcedure::where('problem_id',$Problem->id)->sum('total_cost');
                $allProblemProcedure = ProblemProcedure::where('problem_id',$Problem->id)->select('from','to')->get();
                $totalDuration = 0;
                foreach ($allProblemProcedure as $key => $ProblemProcedure) {
                    $startTime = Carbon::parse($ProblemProcedure->from);
                    $finishTime = Carbon::parse($ProblemProcedure->to);
                    $totalDuration = $finishTime->diffInSeconds($startTime) / 3600;
                    $totalDuration+= $totalDuration;
                    
            }


            $row['Total_Cost']  = $total_cost;
            $row['Total_Duration']  = $totalDuration;
            $row['progress']  = $Problem->calculateProgressPercentage();
            
            
            
           

            // Write the row data to the CSV file
            fputcsv($file, array($row['code'],$row['id_secondary'],$row['staff'],$row['client'],$row['client_type'],$row['problem_number'],$row['file_open_date'],$row['reviewer'],$row['deadline'],$row['status'],$row['notes'],$row['Total_Cost'],$row['Total_Duration'],$row['progress']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}



    public function ExportCases(Request $request)
{
    $fileName = 'cases.csv';
    $Problems = Problem::where('type','case')->with('staff')->with('client')->orderBy('id')->get();
    
    // Set the response headers with the correct character encoding
    $headers = array(
        "Content-type"        => "text/csv; charset=utf-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    // If you need to display Arabic column header, make sure to encode it as well
    $columns = array(__('messages.Staff'),__('messages.clients'),__('messages.client_type'),__('messages.case_number'),__('messages.file_open_date'),__('messages.court'),__('messages.judge'),__('messages.cost'),__('messages.status'),__('messages.notes'),__('messages.Total_Cost'),__('messages.Total_Duration'));

    // Use the 'bom' parameter to ensure proper display of Arabic characters in Excel
    $callback = function() use ($Problems, $columns) {
        $file = fopen('php://output', 'w');

        // Write the UTF-8 BOM (Byte Order Mark) to the file to ensure Excel displays Arabic text correctly
        fputs($file, "\xEF\xBB\xBF");

        // Write the column headers
        fputcsv($file, $columns);

        // Write the data rows
        foreach ($Problems as $Problem) {
            
            // Make sure to retrieve the Arabic name correctly from your database column
            $row['staff']  = @$Problem->staff->name;
            $row['client']  = @$Problem->client->name_ar;

            if($Problem->client_type == 'plaintiff'){
                $row['client_type']  = __('messages.plaintiff');
            }elseif($Problem->client_type == 'defendant'){
                $row['client_type']  = __('messages.defendant');
            }elseif($Problem->client_type == 'claimant'){
                $row['client_type']  = __('messages.claimant');
            }elseif($Problem->client_type == 'respondent'){
                $row['client_type']  = __('messages.respondent');
            }elseif($Problem->client_type == 'other'){
                $row['client_type']  = __('messages.other');
            }else{
                $row['client_type']  = '';
            }
            $row['case_number']  = $Problem->problem_number .'__'.$Problem->problem_date;
            $row['file_open_date']  = $Problem->file_open_date;
            $row['court']  = $Problem->court;
            $row['judge']  = $Problem->judge;
            $row['cost']  = $Problem->cost;
            if($Problem->status == 'pending'){
                $row['status']  = __('messages.pending');
            }elseif($Problem->status == 'stopped'){
                $row['status']  =  __('messages.stopped');
            }elseif($Problem->status == 'completed'){
                $row['status']  = __('messages.completed');
            }elseif($Problem->status == 'running'){
                $row['status']  = __('messages.running');
            }else{
                $row['status']  = '';
            }

            $row['notes']  = $Problem->notes;




            $total_cost = ProblemProcedure::where('problem_id',$Problem->id)->sum('total_cost');
                $allProblemProcedure = ProblemProcedure::where('problem_id',$Problem->id)->select('from','to')->get();
                $totalDuration = 0;
                foreach ($allProblemProcedure as $key => $ProblemProcedure) {
                    $startTime = Carbon::parse($ProblemProcedure->from);
                    $finishTime = Carbon::parse($ProblemProcedure->to);
                    $totalDuration = $finishTime->diffInSeconds($startTime) / 3600;
                    $totalDuration+= $totalDuration;
                    
            }


            $row['Total_Cost']  = $total_cost;
            $row['Total_Duration']  = $totalDuration;
         
            
            
           

            // Write the row data to the CSV file
            fputcsv($file, array($row['staff'],$row['client'],$row['client_type'],$row['case_number'],$row['file_open_date'],$row['court'],$row['judge'],$row['cost'],$row['status'],$row['notes'],$row['Total_Cost'],$row['Total_Duration']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function send_email()
{
    $recipient = 'mahmoud.ali.29992@gmail.com';
    $subject = 'Subject of the Emailss';

    $data = ['content' => 'This is the email content.']; // Data to pass to the view

    $fromEmail = '_mainaccount@qalam.lawjo.net'; 
    // The "from" email address

    Mail::send('emails.lawyer_notification', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
        $mail->to($recipient)
            ->from($fromEmail) // Set the "from" email address
            ->subject($subject);
    });

    return "Email sent successfully!";
}



}