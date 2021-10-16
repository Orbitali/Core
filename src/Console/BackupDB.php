<?php

namespace Orbitali\Console;

use Illuminate\Console\Command;
use Orbitali\Foundations\DBDumper\Dumper;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "orbitali:backup-db";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This artisan backup the database.";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = storage_path("app/backup/" . date("Y-m-d H.i.s") . ".sql");
        Dumper::create()->dump($filePath);
    }
}
