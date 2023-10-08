<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HistoricalEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $affectModel;
    public $affectId;
    /**
     * @var string
     */
    public $action;
    /**
     * @var string
     */
    public $byModel;
    /**
     * @var int
     */
    public $byId;
    /**
     * @var string
     */
    public $log;
    /**
     * @var array
     */
    public $extraInfo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $name, string $affectModel,int $affectId, string $action, string $byModel, int $byId, string $log, array $extraInfo)
    {
        //
        $this->name = $name;
        $this->affectModel = $affectModel;
        $this->affectId = $affectId;
        $this->action = $action;
        $this->byModel = $byModel;
        $this->byId = $byId;
        $this->log = $log;
        $this->extraInfo = $extraInfo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
