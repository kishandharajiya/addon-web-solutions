<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail
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
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = User::where('email', $event->user->email)->first();
        $user->notify(new WelcomeNotification());
    }
}
