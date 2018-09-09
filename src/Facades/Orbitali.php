<?php

namespace Orbitali\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orbitali\Foundations\Orbitali
 */
class Orbitali extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \Orbitali\Foundations\Orbitali::class;
    }
}
