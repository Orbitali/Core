<?php

namespace Orbitali\Foundations\Html\Elements;

use Orbitali\Foundations\Html\BaseElement;

class Optgroup extends BaseElement
{
    protected $tag = 'optgroup';

    /**
     * @param string|null $href
     *
     * @return static
     */
    public function label($label)
    {
        return $this->attribute('label', $label);
    }
}
