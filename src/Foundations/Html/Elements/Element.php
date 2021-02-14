<?php

namespace Orbitali\Foundations\Html\Elements;

use ReflectionClass;
use Orbitali\Foundations\Html\Attributes;
use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Collection;

class Element extends BaseElement
{
    public function __construct($tag)
    {
        $this->tag = $tag;
        parent::__construct();
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public static function withTag($tag)
    {
        return new Element($tag);
    }
}
