<?php

namespace Orbitali\Components;

use Illuminate\View\Component;

class DemoContainerComponent extends Component
{
    public $that;
    public $children = [];
    public $languages = ["tr", "en"];

    public function __construct($parent = null)
    {
        $this->that = $this;
        if (isset($parent)) {
            $parent->attachChild($this);
        }
    }

    public function attachChild($component)
    {
        $this->children[] = function ($language) use ($component) {
            $component = clone $component;
            if (isset($component->name)) {
                $component->name = "detail[$language][$component->name]";
            }
            $data = $component->data();
            $view = value($component->resolveView(), $data);
            if ($view instanceof View) {
                return $view->with($data)->render();
            } elseif ($view instanceof Htmlable) {
                return $view->toHtml();
            }
            return view($view, $data)->toHtml();
        };
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return <<<'blade'
            @foreach($that->languages as $language)
                @foreach($that->children as $child)
                    {!! $child($language) !!}
                @endforeach
            @endforeach
blade;
        };
    }
}
