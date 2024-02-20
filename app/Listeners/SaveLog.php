<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveLog
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $model      = $event->model;
        $action    = $event->action;
        $user       = $event->user;
        $customer   = $event->customer;

        if($user != null){
            $account = $user->account_id;
        }

        if($customer != null){
            $account = $customer->account_id;
        }

        if($customer == null && $user == null){
            $account = AccountId();
        }

        $model->logs()->create([
            'action' => $action,
            'account_id' => $account,
            'user_id' => ($user != null) ? $user->id : null,
            'customer_id' => ($customer != null) ? $customer->id : null
        ]);

    }
}
