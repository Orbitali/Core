<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class TextareaInput extends InputComponent
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

    /**
     * The auto height of input.
     *
     * @var bool
     */
    public $autoHeight;

    /**
     * The rows of input.
     *
     * @var int
     */
    public $rows;

    /**
     * The cols of input.
     *
     * @var int
     */
    public $cols;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @return void
     */
    public function __construct(
        $id,
        $name,
        $title,
        $rows = null,
        $cols = null,
        $autoHeight = false,
        $parent = null
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->rows = $rows;
        $this->cols = $cols;
        $this->autoHeight = $autoHeight;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.textarea-input");
    }

    public function update()
    {
        $this->dottedName = $this->dotNotation($this->name);
        $this->notifyError();
    }
}
