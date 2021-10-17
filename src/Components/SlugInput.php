<?php

namespace Orbitali\Components;

use Illuminate\Container\Container;

class SlugInput extends InputComponent
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
     * The slug of input.
     *
     * @var string
     */
    public $slug;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @param  string  $title
     * @return void
     */
    public function __construct($id, $name, $title, $slug, $parent = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->dottedName = $this->dotNotation($this->name);
        return view("Orbitali::components.slug-input");
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
        $id = data_get($config, "id", uniqid("s-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $name = data_get($config, "name");
        $title = data_get($config, "title");
        $slug = data_get($config, "slug", "/");

        $rules = data_get($config, ":rules", []);
        $required = in_array("required", $rules) ? "required" : "";
        return <<<blade
<x-orbitali::slug-input id="$id" name="$name" title="$title" slug="$slug" $required $parentField />
blade;
    }
}