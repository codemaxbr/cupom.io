<?php

namespace App\Observers;

use App\Events\CustomerRegistered;
use App\Events\LogActivity;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerObserver
{
    /**
     * Handle the customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        event(new LogActivity($customer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
        event(new CustomerRegistered($customer));
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        event(new LogActivity($customer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        event(new LogActivity($customer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the customer "restored" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function restored(Customer $customer)
    {
        event(new LogActivity($customer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the customer "force deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function forceDeleted(Customer $customer)
    {
        event(new LogActivity($customer, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
