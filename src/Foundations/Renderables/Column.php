<?php

namespace Orbitali\Foundations\Renderables;

use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Facades\View;

class Column extends BaseRenderable
{
    protected $tag = "column";
    public function __construct(&$config)
    {
        parent::__construct();
    }

    public function render()
    {
        return "";
    }

    public function getValidations()
    {
        return null;
    }
}
