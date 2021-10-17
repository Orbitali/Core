<?php
namespace Orbitali\Foundations\DBDumper;

use Illuminate\Support\Facades\DB;

class DumperShellCommand extends Dumper
{
    function dump($export_file_location, $table_prefix = "")
    {
        $config = DB::connection()->getConfig();

        $command =
            "mysqldump -h " .
            escapeshellarg($config["host"]) .
            " -u " .
            escapeshellarg($config["username"]) .
            " --password=" .
            escapeshellarg($config["password"]) .
            " " .
            escapeshellarg($config["database"]);

        $include_all_tables =
            empty($table_prefix) &&
            empty($this->include_tables) &&
            empty($this->exclude_tables);

        if (!$include_all_tables) {
            $tables = $this->get_tables($table_prefix);
            $command .=
                " " . implode(" ", array_map("escapeshellarg", $tables));
        }

        $error_file = tempnam(sys_get_temp_dir(), "err");

        $command .= " 2> " . escapeshellarg($error_file);

        if (DumpFile::is_gzip($export_file_location)) {
            $command .= " | gzip";
        }

        $command .= " > " . escapeshellarg($export_file_location);
        exec($command, $output, $return_val);

        if ($return_val !== 0) {
            $error_text = file_get_contents($error_file);
            unlink($error_file);
            throw new DumperException(
                'Couldn\'t export database: ' . $error_text
            );
        }

        unlink($error_file);
    }
}
