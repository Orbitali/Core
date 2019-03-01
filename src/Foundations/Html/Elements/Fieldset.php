<?php

namespace Orbitali\Foundations\Html\Elements;

use Orbitali\Foundations\Html\BaseElement;

class Fieldset extends BaseElement
{
    protected $tag = 'fieldset';

    /**
     * @param \Orbitali\Foundations\Html\HtmlElement|string $text
     *
     * @return static
     */
    public function legend($contents)
    {
        return $this->prependChild(
            Legend::create()->text($contents)
        );
    }
}
