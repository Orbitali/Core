<?php
namespace Orbitali\Foundations\DBDumper;

/**
 * Abstract dump file: provides common interface for writing
 * data to dump files.
 */
abstract class DumpFile
{
    /**
     * File Handle
     */
    protected $fh;

    /**
     * Location of the dump file on the disk
     */
    protected $file_location;

    abstract function write($string);
    abstract function end();

    static function create($filename)
    {
        if (self::is_gzip($filename)) {
            return new DumpFileGzip($filename);
        }
        return new DumpFilePlaintext($filename);
    }
    function __construct($file)
    {
        @mkdir(dirname($file), 0755, true);
        $this->file_location = $file;
        $this->fh = $this->open();

        if (!$this->fh) {
            throw new DumperException("Couldn't create gz file");
        }
    }

    public static function is_gzip($filename)
    {
        return preg_match('~gz$~i', $filename);
    }
}
