<?php

namespace Orbitali\Components;
use Orbitali\Foundations\Orbitali;
use Illuminate\Support\Arr;

class RootPanel extends ContainerComponent
{
    public $that;
    protected $except = ["children", "addChild"];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Orbitali $orbitali, $id, $parent = null)
    {
        $this->that = $this;
    }

    public function renderChild($child)
    {
        $child->update();
        return $child->render()->with($child->data());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.root-panel");
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("root-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $children = data_get($config, ":children", []);
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        return "<x-orbitali::root-panel id=\"$id\" $parentField >$content</x-orbitali::root-panel>";
    }
}
