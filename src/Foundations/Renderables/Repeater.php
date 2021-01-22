<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Orbitali\Foundations\Html\BaseElement;

class Repeater extends BaseRenderable
{
    protected $tag = "div";

    public function __construct(&$config)
    {
        parent::__construct();
        $config[":tag"] = "Panel";
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);

        foreach ([0, 1, 2, 3, 4, 5] as $i) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => $i,
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $i);
            $config[":children"][] = $panel;
        }
        $element = $this->initiateClass($config);
        $this->attributes = $element->attributes;
        $this->children = $element->children;
    }

    private function applyChild($children, $i)
    {
        foreach ($children as &$child) {
            if (!isset($child[":repeaterIds"])) {
                $child[":repeaterIds"] = [];
            }
            $child[":repeaterIds"][] = $i;
            if (isset($child["name"])) {
                $child["name"] .= "[{$i}]";
            }
            if (isset($child[":children"])) {
                $child[":children"] = $this->applyChild(
                    $child[":children"],
                    $i
                );
            }
        }
        return $children;
    }

    public function fixNestedSet($validations, &$newVal)
    {
        foreach ($validations as $val) {
            if (is_a($val, Collection::class)) {
                $this->fixNestedSet($val, $newVal);
            } elseif (is_array($val)) {
                $newVal->push($val);
            }
        }
    }

    public function getValidations()
    {
        $validations = parent::getValidations();
        $newVal = collect([]);
        $this->fixNestedSet($validations, $newVal);
        return $newVal;
    }
}
