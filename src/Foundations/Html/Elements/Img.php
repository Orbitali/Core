<?php

namespace Orbitali\Foundations\Html\Elements;

use Orbitali\Foundations\Html\BaseElement;

class Img extends BaseElement
{
    protected $tag = 'img';

    /**
     * @param string|null $alt
     *
     * @return static
     */
    public function alt($alt)
    {
        return $this->attribute('alt', $alt);
    }

    /**
     * @param string|null $src
     *
     * @return static
     */
    public function src($src)
    {
        return $this->attribute('src', $src);
    }
}
