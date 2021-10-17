<?php

namespace Orbitali\Components;
use Orbitali\Foundations\Orbitali;
use Illuminate\Support\Arr;

class RepeaterPanel extends ContainerComponent
{
    public $that;
    public $count = 1;
    public $inputNames = [];
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

    public function renderChild($i, $child, $component)
    {
        $child = clone $child;
        $i--;

        $func = function ($child) use (&$func, $i) {
            if ($child instanceof ContainerComponent) {
                array_map($func, $child->children);
            } else {
                if (isset($child->id)) {
                    $child->id = "$this->id-$child->id-$i";
                }
                if (isset($child->name)) {
                    $child->name .= "[$i]";
                }
            }
        };
        array_map($func, [$child]);

        $child->parent = $component;
        $component->addChild($child);
        $component->update();
    }

    public function updateCount($model)
    {
        $func = function ($child) use ($model, &$func) {
            if ($child instanceof ContainerComponent) {
                return array_map($func, $child->children);
            }
            $this->inputNames[] = $child->name;
            $value = data_get($model, $child->dottedName);
            return is_array($value) ? count($value) : 0;
        };
        $values = Arr::flatten(array_map($func, $this->children));
        $values[] = 1;
        $this->count = max($values);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("Orbitali::components.repeater-panel");
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("rp-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $children = data_get($config, ":children", []);
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        return "<x-orbitali::repeater-panel id=\"$id\" $parentField >$content</x-orbitali::repeater-panel>";
    }
}
