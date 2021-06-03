<?php

namespace Orbitali\Components;

class TabPanel extends ContainerComponent
{
    public $title;
    public $that;
    public $errorCount = 0;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $id, $parent = null)
    {
        $this->that = $this;
        $this->title = $title;
    }

    public function renderChild($child)
    {
        $child->update();
        $data = $child->data();
        return $child->render()->with($data);
    }

    public function notifyError()
    {
        $this->errorCount++;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.tab-panel");
    }
}
