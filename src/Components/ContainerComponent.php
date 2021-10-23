<?php

namespace Orbitali\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

abstract class ContainerComponent extends BaseComponent
{
    public $children = [];
    public $renderableChildren = [];

    abstract protected function beforeBind(...$args);

    public function addChild($component)
    {
        $this->children[] = $component;
        $this->renderableChildren[] = function (...$args) use ($component) {
            $component = clone $component;
            array_unshift($args, $component);
            $this->beforeBind(...$args);
            $component->update();
            $data = $component->data();
            $view = value($component->resolveView(), $data);
            if ($view instanceof View) {
                return $view->with($data)->render();
            } elseif ($view instanceof Htmlable) {
                return $view->toHtml();
            }
            return view($view, $data)->render();
        };
    }

    public function update()
    {
        foreach ($this->children as $child) {
            $child->update();
            $child->preRender = false;
        }
    }
}
