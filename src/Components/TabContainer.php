<?php

namespace Orbitali\Components;

class TabContainer extends ContainerComponent
{
    public $that;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $parent = null)
    {
        $this->that = $this;
    }

    protected function beforeBind(...$args)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function ($data) {
            return "Orbitali::components.tab-container";
        };
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("tc-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $children = data_get($config, ":children", []);
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        return "<x-orbitali::tab-container id=\"$id\" $parentField >$content</x-orbitali::tab-container>";
    }
}
