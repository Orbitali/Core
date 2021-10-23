<?php

namespace Orbitali\Components;

use Illuminate\View\Component;

class DemoComponent extends Component
{
    public $name = "default";

    public function __construct($parent = null)
    {
        $parent->attachChild($this);
    }
    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return '{{$name}}';
        };
    }
}
