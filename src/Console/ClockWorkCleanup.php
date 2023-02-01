<?php

namespace Orbitali\Console;

use Illuminate\Console\Command;

class ClockWorkCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "orbitali:clock-work-cleanup";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This artisan remove previous clockwork logs.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $storage = new \Orbitali\Foundations\Clockwork\ClockWorkSqlStorage();
        $storage->cleanup(true);
    }
}
