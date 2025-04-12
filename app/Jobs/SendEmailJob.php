<?php

namespace App\Jobs;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function handle()
    {
        if (!empty($this->admin->email) && filter_var($this->admin->email, FILTER_VALIDATE_EMAIL)) {
            $recipient = $this->admin->email;
            Log::info("Sending email to: " . $recipient);

            $subject = "لديك وارد من مدير نظام تواصل";
            $data = ['group_name' => $this->admin->group_name];
            $fromEmail = 'admin@tawasol.privatescouts.org';

            try {
                Mail::send('emails.advertisements', $data, function ($mail) use ($recipient, $subject, $fromEmail) {
                    $mail->to($recipient)
                         ->from($fromEmail)
                         ->subject($subject);
                });
                Log::info("Email sent to: " . $recipient);
            } catch (\Exception $e) {
                Log::error("Email error: " . $e->getMessage());
            }
        } else {
            Log::error("Invalid email: " . ($this->admin->email ?? 'NULL'));
        }
    }
}
