<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class Select2Input extends InputComponent
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
     * The multiple of input.
     *
     * @var bool
     */
    public $multiple;

    /**
     * The prevent sort of input.
     *
     * @var bool
     */
    public $preventSort;

    /**
     * The data source of input.
     *
     * @var string
     */
    public $dataSource;

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
        $dataSource,
        $multiple = false,
        $preventSort = false,
        $parent = null
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->multiple = $multiple;
        $this->dataSource = $dataSource;
        $this->preventSort = $preventSort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.select2-input");
    }

    public function update()
    {
        $this->dottedName = $this->dotNotation($this->name);
        $this->notifyError();
    }
}
