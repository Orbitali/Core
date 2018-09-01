<?php

namespace Orbitali\Foundations;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Http\Request;

class Orbitali
{
    use Macroable;
    /**
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Get Instance of Orbitali
     * @return Orbitali
     */
    public function instance(): Orbitali
    {
        return $this;
    }

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {
        $this->request = Request::instance();
    }
}
