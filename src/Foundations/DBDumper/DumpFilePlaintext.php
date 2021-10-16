<?php
namespace Orbitali\Foundations\DBDumper;

/**
 * Plain text implementation. Uses standard file functions in PHP.
 */
class DumpFilePlaintext extends DumpFile
{
    function open()
    {
        return fopen($this->file_location, "w");
    }
    function write($string)
    {
        return fwrite($this->fh, $string);
    }
    function end()
    {
        return fclose($this->fh);
    }
}
