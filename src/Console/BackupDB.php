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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = storage_path("app/backup/" . date("Y-m-d H.i.s") . "/data.sql");
        Dumper::create()->dump($filePath);
        $attachments = clock()->userData("attachments")->title("Attachments");
        $attachments->table("files", [
            ["File" => $filePath, "Size" => filesize($filePath)],
        ])->title("Files");
    }
}
