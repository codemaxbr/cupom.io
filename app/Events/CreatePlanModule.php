<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreatePlanModule
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $plan;
    public $module;
    public $server;
    public $params;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($plan, $module, $server, $params)
    {
        $this->plan = $plan;
        $this->module = $module;
        $this->server = $server;
        $this->params = $params;
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
