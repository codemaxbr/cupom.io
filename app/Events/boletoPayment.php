<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class boletoPayment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $module;
    public $request;
    public $customer;
    public $invoice;
    public $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($module, $request, Customer $customer)
    {
        $this->module = $module;
        $this->request = $request;
        $this->customer = $customer;
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
