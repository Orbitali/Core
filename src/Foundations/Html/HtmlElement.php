<?php

namespace Orbitali\Foundations\Html;

interface HtmlElement
{
    /**
     * @return \Illuminate\Contracts\Support\Htmlable
     */
    public function render();
}
