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

        $func = function ($child) use (&$func, $language) {
            if ($child instanceof ContainerComponent) {
                array_map($func, $child->children);
            } else {
                if (isset($child->id)) {
                    $child->id = "$this->id-$language-$child->id";
                }
                if (isset($child->name)) {
                    $child->name = "details[$language][$child->name]";
                }
            }
        };
        array_map($func, [$child]);

        $child->parent = $component;
        $component->addChild($child);
        $component->update();
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

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("dp-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $children = data_get($config, ":children", []);
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        return "<x-orbitali::detail-panel id=\"$id\" $parentField >$content</x-orbitali::detail-panel>";
    }
}
