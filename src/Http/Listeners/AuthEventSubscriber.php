<?php

namespace Orbitali\Http\Listeners;

use Silber\Bouncer\BouncerFacade;

class AuthEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $event->user->last_login_ip = request()->ip();
        if ($event->user->id === 1) {
            BouncerFacade::assign("super_admin")->to($event->user);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            "Illuminate\Auth\Events\Login",
            self::class . "@onUserLogin"
        );
    }
}
