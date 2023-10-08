<?php

namespace App\Listeners;

use App\Services\HistoricalEvents\HistoricalEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HistoricalEventsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(\App\Events\HistoricalEvents $event)
    {
        HistoricalEvents::logEvent(
            $event->name,
            $event->affectModel,
            $event->affectId,
            $event->action,
            $event->byModel,
            $event->byId,
            $event->log,
            $event->extraInfo
        );
    }
}
