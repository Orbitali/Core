<?php

namespace Orbitali\Http\Listeners;

use Silber\Bouncer\BouncerFacade;
use Illuminate\Console\Events\CommandStarting;
use Clockwork\Helpers\StackTrace;
use Orbitali\Foundations\CapturingFormatter;

class ConsoleCommandListener
{
    /**
     * Handle user register events.
     */
    public function onCommandStarting($event)
    {
        $event->output->setFormatter(new CapturingFormatter($event->output->getFormatter()));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        app()->booted(function () use($events) {
            $events->listen(CommandStarting::class,[self::class, "onCommandStarting"]);
		});
    }
}
