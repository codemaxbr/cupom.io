<?php

namespace App\Observers;

use App\Events\LogActivity;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;

class PasswordResetObserver
{
    /**
     * Handle the password reset "created" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function created(PasswordReset $passwordReset)
    {
        event(new LogActivity($passwordReset, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the password reset "updated" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function updated(PasswordReset $passwordReset)
    {
        event(new LogActivity($passwordReset, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the password reset "deleted" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function deleted(PasswordReset $passwordReset)
    {
        event(new LogActivity($passwordReset, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the password reset "restored" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function restored(PasswordReset $passwordReset)
    {
        event(new LogActivity($passwordReset, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }

    /**
     * Handle the password reset "force deleted" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function forceDeleted(PasswordReset $passwordReset)
    {
        event(new LogActivity($passwordReset, __FUNCTION__, Auth::guard('front')->user(), Auth::user()));
    }
}
