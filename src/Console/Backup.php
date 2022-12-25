<?php

namespace Orbitali\Console;

use Illuminate\Console\Command;
use Orbitali\Foundations\DBDumper\Dumper;
use ZipArchive;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "orbitali:backup";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This artisan backup of the system.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publicStorage = storage_path('app/public');
        $baseFolder = storage_path("app/backup/" . date("Y-m-d H.i.s"));
        $filePath = $baseFolder . "/data.sql";
        $zipFilePath = $baseFolder . ".zip";

        Dumper::create()->dump($filePath);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            static::folderToZip($baseFolder, $zip, strlen("$baseFolder/"));
            static::folderToZip($publicStorage, $zip, strlen("$publicStorage/"));
            $zip->close();
        }

        $attachments = clock()->userData("attachments")->title("Attachments");
        $attachments->table("files", [
            ["File" => $filePath, "Size" => filesize($filePath)],
            ["File" => $zipFilePath, "Size" => filesize($zipFilePath)]
        ])->title("Files")->showAs("file");
    }

    private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
        $handle = opendir($folder);
        while (false !== $f = readdir($handle)) {
        if ($f != '.' && $f != '..') {
            $filePath = "$folder/$f";
            // Remove prefix from file path before add to zip.
            $localPath = substr($filePath, $exclusiveLength);
            if (is_file($filePath)) {
            $zipFile->addFile($filePath, $localPath);
            } elseif (is_dir($filePath)) {
            // Add sub-directory.
            $zipFile->addEmptyDir($localPath);
            self::folderToZip($filePath, $zipFile, $exclusiveLength);
            }
        }
        }
        closedir($handle);
    }
}
