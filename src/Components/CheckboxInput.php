<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class CheckboxInput extends InputComponent
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
     * The type of input.
     *
     * @var string
     */
    public $type;

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
        $type = "checkbox",
        $parent = null
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->type = $type;
        $this->dataSource = $dataSource;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.checkbox-input");
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
        $id = data_get($config, "id", uniqid("cb-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $name = data_get($config, "name");
        $title = data_get($config, "title");
        $type = data_get($config, "type", "checkbox");
        $dataSource = data_get($config, ":data-source");
        $rules = data_get($config, ":rules", []);
        $required = in_array("required", $rules) ? "required" : "";
        return <<<blade
<x-orbitali::checkbox-input id="$id" name="$name" title="$title" type="$type" data-source="$dataSource" $required $parentField />
blade;
    }
}
