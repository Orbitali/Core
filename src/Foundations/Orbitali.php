<?php

namespace Orbitali\Foundations;

class Orbitali
{
    public $request = null;

    public function instance(): Orbitali
    {
        return $this;
    }

    public function __construct()
    {
        $this->request = \Illuminate\Support\Facades\Request::instance();
    }
}
