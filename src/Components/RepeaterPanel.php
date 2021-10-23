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

    protected function beforeBind(...$args)
    {
        $child = $args[0];
        $parent = $args[1];
        $i = $args[2];
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
        if (method_exists($parent, "addChild")) {
            $parent->addChild($child);
        }
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
        $children = data_get($config, ":children", []);
        $content = "";
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, true) . PHP_EOL;
        }
        //return "<x-orbitali::repeater-panel id=\"$id\" $parentField >$content</x-orbitali::repeater-panel>";
        return <<<blade
        @php(\$arr=[0,1,2])
<div class="js-wizard-simple block block-rounded block-bordered" id="$id" data-repeater-count="{{count(\$arr)}}" data-repeater-names="['feature_icon','feature_title']">
    <ul class="nav nav-tabs nav-tabs-alt nav-justified sticky-top bg-white-95" role="tablist">
        @foreach(\$arr as \$i)
        <li class="nav-item">
            <a class="nav-link {{ \$loop->first ? " active":"" }}" href="#$id-{{\$loop->index}}" data-toggle="tab" role="tab">
                {{\$loop->index}}
            </a>
        </li>
        @endforeach
    </ul>
    <div class="block-content block-content-full tab-content">
        @foreach (\$arr as \$i)
        <div class="tab-pane {{ \$loop->first ? " active":"" }}" id="$id-{{\$loop->index}}" role="tabpanel">
            $content
        </div>
        @endforeach
    </div>
</div>
blade;
    }
}
