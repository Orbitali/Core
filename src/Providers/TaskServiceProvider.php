<?php

namespace Orbitali\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Orbitali\Http\Models\Task;
use Illuminate\Support\Facades\Request;
use Orbitali\Events\Task\Executing;
use Orbitali\Events\Task\Executed;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Support\Stringable;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register any services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }
        $args = Request::server("argv", null);
        if (count($args) > 1 && $args[1] == "schedule:run") {
            $this->app->resolving(Schedule::class, function ($schedule) {
                $this->schedule($schedule);
            });
        }
    }

    /**
     * Prepare schedule from tasks.
     *
     * @param Schedule $schedule
     */
    public function schedule(Schedule $schedule)
    {
        $tasks = Task::status()->get();

        $tasks->each(function ($task) use ($schedule) {
            $event = $schedule->command(
                $task->command,
                $task->parameters ?? []
            );

            $event
                ->cron($task->expression)
                ->before(function () use ($task) {
                    Executing::dispatch($task);
                })
                ->after(function () use ($task) {
                    Executed::dispatch($task);
                });

            if ($task->dont_overlap) {
                $event->withoutOverlapping();
            }

            if ($task->run_in_maintenance) {
                $event->evenInMaintenanceMode();
            }

            if (
                $task->run_on_one_server &&
                in_array(config("cache.default"), [
                    "memcached",
                    "redis",
                    "database",
                    "dynamodb",
                ])
            ) {
                $event->onOneServer();
            }

            if ($task->run_in_background) {
                $event->runInBackground();
            }
        });
    }
}
