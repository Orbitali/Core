<?php
namespace Orbitali\Foundations\DBDumper;

/**
 * MySQL insert statement builder.
 */
class InsertStatement
{
    private $rows = [];
    private $length = 0;
    private $table;

    function __construct($table)
    {
        $this->table = $table;
    }

    function reset()
    {
        $this->rows = [];
        $this->length = 0;
    }

    function add_row($row)
    {
        $row = "(" . implode(",", $row) . ")";
        $this->rows[] = $row;
        $this->length += strlen($row);
    }

    function get_sql()
    {
        if (empty($this->rows)) {
            return false;
        }

        return "INSERT INTO `" .
            $this->table .
            "` VALUES " .
            implode(",\n", $this->rows) .
            "; ";
    }

    function get_length()
    {
        return $this->length;
    }
}
