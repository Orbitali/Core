<?php

namespace Orbitali\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;

class Plugin
{

    public function postAutoloadDump(Composer $composer, IOInterface $io)
    {
        var_dump("start composer plugin");
        $this->generator = new AutoloadGenerator($composer->getEventDispatcher(), $io);
        $this->composer = $composer;
        var_dump($this->generator,$this->composer);

        $extraConfig = $this->composer->getPackage()->getExtra();
        if (!array_key_exists('include_files', $extraConfig) || !is_array($extraConfig['include_files'])) {
            return;
        }
        $this->generator->dumpFiles($this->composer, $extraConfig['include_files']);
    }
}
