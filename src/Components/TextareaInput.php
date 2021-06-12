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

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("ta-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $name = data_get($config, "name");
        $title = data_get($config, "title");
        //
        $rows = data_get($config, "rows", 0);
        $rowsAttr = $rows > 0 ? "rows=\"$rows\"" : "";
        $cols = data_get($config, "cols");
        $colsAttr = $cols > 0 ? "cols=\"$rows\"" : "";
        $autoHeight = data_get($config, "auto-height", false);
        $autoHeightAttr = $autoHeight ? "auto-height" : "";
        //
        $rules = data_get($config, ":rules", []);
        $required = in_array("required", $rules) ? "required" : "";
        return <<<blade
<x-orbitali::textarea-input id="$id" name="$name" title="$title" $rowsAttr $colsAttr $autoHeightAttr $required $parentField />
blade;
    }
}
