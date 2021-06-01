<?php

namespace Orbitali\Components;

abstract class ContainerComponent extends BaseComponent
{
    public $children = [];

    public function addChild($child)
    {
        $this->children[] = $child;
    }
}
