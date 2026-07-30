<?php

namespace App\Console\Commands;

use App\Services\SubscriptionService;
use Illuminate\Console\Command;

class ProcessSubscriptionExpirations extends Command
{
    protected $signature = 'subscriptions:process-expirations {--days=3 : Days before expiry to send reminder}';

    protected $description = 'Expire due subscriptions and send SMS reminders';

    public function handle(SubscriptionService $subscriptions)
    {
        $reminded = $subscriptions->sendExpiryReminders((int) $this->option('days'));
        $expired = $subscriptions->expireDueSubscriptions();

        $this->info("Reminders sent: {$reminded}");
        $this->info("Subscriptions expired: {$expired}");

        return 0;
    }
}
