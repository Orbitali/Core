<?php

namespace Orbitali\Components;

abstract class ContainerComponent extends BaseComponent
{
    public $children = [];

    public function addChild($child)
    {
        $this->children[] = $child;
    }

    public function update()
    {
        foreach ($this->children as $child) {
            $child->update();
            $child->preRender = false;
        }
    }
}
