<?php

namespace Orbitali\Http\Listeners;

class AuthEventSubscriber
{
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
            'Illuminate\Auth\Events\Login',
            self::class . '@onUserLogin'
        );
    }

}
