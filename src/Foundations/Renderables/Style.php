<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\A;

class Style extends BaseRenderable
{
    protected $tag = "style";
    public function __construct(&$config)
    {
        parent::__construct();
        $this->attributes->setAttribute("type", "text/css");
        $children = $this->parseChildren([$config[":content"]], null);
        $this->children = $this->children->merge($children);
    }
}
