<?php

namespace Orbitali\Http\Listeners;

use Silber\Bouncer\BouncerFacade;

class AuthEventSubscriber
{
    /**
     * Handle user register events.
     */
    public function onUserRegistered($event)
    {
        if ($event->user->id === 1) {
            BouncerFacade::assign("super_admin")->to($event->user);
        }
    }

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $event->user->last_login_ip = request()->ip();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            "Illuminate\Auth\Events\Registered",
            self::class . "@onUserRegistered"
        );
        $events->listen(
            "Illuminate\Auth\Events\Login",
            self::class . "@onUserLogin"
        );
    }
}
