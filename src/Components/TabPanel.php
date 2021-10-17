<?php

namespace Orbitali\Components;

class TabPanel extends ContainerComponent
{
    public $title;
    public $that;
    public $errorCount = 0;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $parent = null)
    {
        $this->that = $this;
        $this->title = $title;
    }

    public function renderChild($child)
    {
        $child->update();
        return $child->render()->with($child->data());
    }

    public function notifyError()
    {
        $this->errorCount++;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.tab-panel");
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("tp-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $title = data_get($config, "title");
        $children = data_get($config, ":children", []);
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        return "<x-orbitali::tab-panel id=\"$id\" title=\"$title\" $parentField >$content</x-orbitali::tab-panel>";
    }
}
