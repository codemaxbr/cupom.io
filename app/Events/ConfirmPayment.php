<?php

namespace App\Events;

use App\Http\Requests\Request;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class ConfirmPayment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Invoice
     */
    public $invoice;
    /**
     * @var Request
     */
    public $request;
    /**
     * @var Auth
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, $request)
    {
        $this->invoice = $invoice;
        $this->request = $request;
        $this->user = Auth::user();
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
