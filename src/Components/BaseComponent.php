<?php

namespace Orbitali\Components;

use Illuminate\View\Component;

abstract class BaseComponent extends Component
{
    /**
     * The id of input.
     *
     * @var string
     */
    public $id;

    /**
     * The parent component.
     *
     * @var Component|null
     */
    public $parent;

    /**
     *
     * @var bool
     */
    public $preRender = true;

    abstract public function update();

    public function baseComponentBoot($app, $parameters)
    {
        $this->except[] = "parent";
        $this->except[] = "baseComponentBoot";
        $this->except[] = "update";
        $this->except[] = "preRender";

        if (isset($parameters["id"])) {
            $this->id = $parameters["id"];
        }

        if (isset($parameters["parent"])) {
            $this->parent = $parameters["parent"];
            if (method_exists($this->parent, "addChild")) {
                $this->parent->addChild($this);
            }
        } else {
            $this->preRender = false;
        }
    }
}
