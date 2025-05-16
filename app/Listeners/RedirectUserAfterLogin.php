<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectUserAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        if ($user->role === 'admin_sistem' || $user->role === 'admin_kua') {
            Session::put('url.intended', route('admin.index'));
        } else {
            Session::put('url.intended', url('/'));
        }
    }
}
