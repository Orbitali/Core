<?php
namespace Orbitali\Foundations\DBDumper;

use Illuminate\Support\Facades\DB;
/**
 * Main facade
 */
abstract class Dumper
{
    /**
     * Maximum length of single insert statement
     */
    const INSERT_THRESHOLD = 838860;

    /**
     * @var DumpFile
     */
    public $dump_file;

    public $dbName;

    /**
     * End of line style used in the dump
     */
    public $eol = "\r\n";

    /**
     * Specificed tables to include
     */
    public $include_tables;

    /**
     * Specified tables to exclude
     */
    public $exclude_tables = [];

    /**
     * Factory method for dumper on current hosts's configuration.
     */
    static function create($db_options = [])
    {
        if (
            has_shell_access() &&
            self::is_shell_command_available("mysqldump") &&
            self::is_shell_command_available("gzip")
        ) {
            $dumper = new DumperShellCommand();
        } else {
            $dumper = new DumperNative();
        }

        if (isset($db_options["include_tables"])) {
            $dumper->include_tables = $db_options["include_tables"];
        }
        if (isset($db_options["exclude_tables"])) {
            $dumper->exclude_tables = $db_options["exclude_tables"];
            $dumper->exclude_tables[] = config("clockwork.storage_sql_table");
        } else {
            $dumper->exclude_tables = [config("clockwork.storage_sql_table")];
        }
        $dumper->dbName = DB::connection()->getDatabaseName();
        return $dumper;
    }

    public static function is_shell_command_available($command)
    {
        if (preg_match("~win~i", PHP_OS)) {
            /*
			On Windows, the `where` command checks for availabilty in PATH. According
			to the manual(`where /?`), there is quiet mode: 
			....
			    /Q       Returns only the exit code, without displaying the list
			             of matched files. (Quiet mode)
			....
			*/
            $output = [];
            exec("where /Q " . $command, $output, $return_val);

            if (intval($return_val) === 1) {
                return false;
            } else {
                return true;
            }
        } else {
            $last_line = exec("which " . $command);
            $last_line = trim($last_line);

            // Whenever there is at least one line in the output,
            // it should be the path to the executable
            if (empty($last_line)) {
                return false;
            } else {
                return true;
            }
        }
    }

    protected static function escape_like($search)
    {
        return str_replace(["_", "%"], ["\_", "\%"], $search);
    }

    protected function escape($value)
    {
        if (is_null($value)) {
            return "NULL";
        }
        return DB::getPDO()->quote($value);
    }

    /**
     * Create an export file from the tables with that prefix.
     * @param string $export_file_location the file to put the dump to.
     *		Note that whenever the file has .gz extension the dump will be comporessed with gzip
     * @param string $table_prefix Allow to export only tables with particular prefix
     * @return void
     */
    abstract public function dump($export_file_location, $table_prefix = "");

    protected function get_tables($table_prefix)
    {
        if (!empty($this->include_tables)) {
            return $this->include_tables;
        }

        // $tables will only include the tables and not views.
        // TODO - Handle views also, edits to be made in function 'get_create_table_sql' line 336
        $columnDb = "Tables_in_" . $this->dbName;
        $tables = DB::select(
            'SHOW FULL TABLES WHERE Table_Type = "BASE TABLE" AND ' .
                $columnDb .
                ' LIKE "' .
                self::escape_like($table_prefix) .
                '%"'
        );

        $tables_list = [];
        foreach ($tables as $table_row) {
            $table_row = (array) $table_row;
            $table_name = $table_row[$columnDb];
            if (!in_array($table_name, $this->exclude_tables)) {
                $tables_list[] = $table_name;
            }
        }
        return $tables_list;
    }
}
