<?php

namespace App\Events;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AlterPlanSubscription
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Subscription
     */
    public $subscription;
    /**
     * @var Plan
     */
    public $plan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription, $plan)
    {
        $this->subscription = $subscription;
        $this->plan = $plan;
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
