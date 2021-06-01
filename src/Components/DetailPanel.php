<?php

namespace Orbitali\Components;
use Orbitali\Foundations\Orbitali;

class DetailPanel extends ContainerComponent
{
    public $languages;

    public $that;
    protected $except = ["children", "addChild"];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Orbitali $orbitali, $id, $parent = null)
    {
        $this->languages = collect($orbitali->website->languages)->mapWithKeys(
            function ($lang) {
                return [$lang => trans("native.language." . $lang)];
            }
        );
        $this->that = $this;
    }

    public function renderChild($language, $child, $component)
    {
        $child = clone $child;
        $child->update();
        if (isset($child->id)) {
            $child->id = "$this->id-$language-$child->id";
        }
        if (isset($child->name)) {
            $child->name = "details[$language][$child->name]";
        }
        $child->parent = $component;
        $component->addChild($child);
        return $child->render()->with($child->data());
    }

    public function update()
    {
        foreach ($this->children as $child) {
            $child->update();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.detail-panel");
    }
}
