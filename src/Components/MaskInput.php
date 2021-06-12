<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class MaskInput extends InputComponent
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
     * The mask of input.
     *
     * @var string
     */
    public $mask;

    /**
     * The regex of input.
     *
     * @var string
     */
    public $regex;

    /**
     * The lazy of input.
     *
     * @var bool
     */
    public $lazy;

    /**
     * The overwrite of input.
     *
     * @var bool
     */
    public $overwrite;

    /**
     * The placeholder char of input.
     *
     * @var string
     */
    public $placeholderChar;

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
        $mask = null,
        $regex = null,
        $lazy = null,
        $overwrite = null,
        $placeholderChar = null,
        $parent = null
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->mask = $mask;
        $this->regex = $regex;
        $this->lazy = $lazy;
        $this->overwrite = $overwrite;
        $this->placeholderChar = $placeholderChar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.mask-input");
    }

    public function update()
    {
        $this->dottedName = $this->dotNotation($this->name);
        $this->notifyError();
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("m-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $name = data_get($config, "name");
        $title = data_get($config, "title");

        //TODO add props

        $rules = data_get($config, ":rules", []);
        $required = in_array("required", $rules) ? "required" : "";
        return <<<blade
<x-orbitali::mask-input id="$id" name="$name" title="$title"  $required $parentField />
blade;
    }
}
