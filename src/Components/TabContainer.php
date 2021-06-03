<?php

namespace Orbitali\Components;

class TabContainer extends ContainerComponent
{
    public $that;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $parent = null)
    {
        $this->that = $this;
    }

    public function renderChild($child)
    {
        $child->update();
        return $child->render()->with($child->data());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.tab-container");
    }
}
