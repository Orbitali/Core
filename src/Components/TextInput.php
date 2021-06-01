<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class TextInput extends InputComponent
{
    /**
     * The name of input.
     *
     * @var string
     */
    public $name;

    /**
     * The title of input.
     *
     * @var string
     */
    public $title;

    public $dottedName;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @return void
     */
    public function __construct($name, $title, $id, $parent = null)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.text-input");
    }

    public function update()
    {
        $this->dottedName = $this->dotNotation($this->name);
        $this->notifyError();
    }
}
