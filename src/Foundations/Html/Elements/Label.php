<?php

namespace Orbitali\Foundations\Html\Elements;

use Orbitali\Foundations\Html\BaseElement;

class Label extends BaseElement
{
    protected $tag = "label";

    /**
     * @param string|null $for
     *
     * @return static
     */
    public function for($for)
    {
        return $this->attribute("for", $for);
    }
}
