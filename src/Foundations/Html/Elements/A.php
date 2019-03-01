<?php

namespace Orbitali\Foundations\Html\Elements;

use Orbitali\Foundations\Html\BaseElement;

class A extends BaseElement
{
    protected $tag = 'a';

    /**
     * @param string|null $href
     *
     * @return static
     */
    public function href($href)
    {
        return $this->attribute('href', $href);
    }
}
