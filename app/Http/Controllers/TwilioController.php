<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function sendWhatsAppMessage(Request $request)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');



        $client = new Client($sid, $token);

        // print_r($client); die;

        $recipientNumber = "+201096615770";
        $message = "here we are";

        $message = $client->messages
            ->create("whatsapp:{$recipientNumber}", // To number in WhatsApp format
                array(
                    'from' => "whatsapp:{$twilioPhoneNumber}", // Twilio phone number in WhatsApp format
                    'body' => $message
                )
            );

        return response()->json(['message_sid' => $message->sid]);
    }
}
