<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class AttachmentObserver
{
    /**
     * Handle the attachment "created" event.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return void
     */
    public function created(Attachment $attachment)
    {
        event(new LogActivity($attachment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the attachment "updated" event.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return void
     */
    public function updated(Attachment $attachment)
    {
        event(new LogActivity($attachment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the attachment "deleted" event.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return void
     */
    public function deleted(Attachment $attachment)
    {
        event(new LogActivity($attachment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the attachment "restored" event.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return void
     */
    public function restored(Attachment $attachment)
    {
        event(new LogActivity($attachment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the attachment "force deleted" event.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return void
     */
    public function forceDeleted(Attachment $attachment)
    {
        event(new LogActivity($attachment, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
