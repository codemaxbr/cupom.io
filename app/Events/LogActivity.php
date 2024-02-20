<?php

namespace App\Events;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $model;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Customer
     */
    public $customer;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param $model
     * @param $message
     * @param null $customer
     * @param null $user
     */
    public function __construct($model, $action, $customer = null, $user = null)
    {
        $this->model = $model;
        $this->action = $action;
        $this->customer = $customer;
        $this->user = $user;
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
