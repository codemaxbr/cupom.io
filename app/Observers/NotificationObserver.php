<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationObserver
{
    /**
     * Handle the notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        event(new LogActivity($notification, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the notification "updated" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function updated(Notification $notification)
    {
        event(new LogActivity($notification, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the notification "deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function deleted(Notification $notification)
    {
        event(new LogActivity($notification, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the notification "restored" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function restored(Notification $notification)
    {
        event(new LogActivity($notification, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the notification "force deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function forceDeleted(Notification $notification)
    {
        event(new LogActivity($notification, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
