<?php

namespace Orbitali\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Orbitali\Foundations\Orbitali instance() *
 * @property static Illuminate\Support\Facades\Request $request
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
