<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Html\BaseElement;

class DetailPanel extends BaseElement
{
    protected $tag = "div";
    protected $element;

    public function __construct(&$config)
    {
        parent::__construct();
        $activeLanguages = orbitali("website")->languages;
        $config[":tag"] = "Panel";
        $rawChiled = array_merge([], $config[":children"]);
        unset($config[":children"]);

        foreach ($activeLanguages as $lang) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => __("native.language." . $lang),
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $lang);
            $config[":children"][] = $panel;
        }
        $this->element = $this->initiateClass($config);
    }

    public function render()
    {
        return $this->element->render();
    }

    private function applyChild($children, $lang)
    {
        //$rawChildren = clone $children;
        foreach ($children as &$child) {
            if (isset($child["name"])) {
                $child["name"] = "details[{$lang}][" . $child["name"] . "]";
            }
            if (isset($child[":children"])) {
                $child[":children"] = $this->applyChild(
                    $child[":children"],
                    $lang
                );
            }
        }
        return $children;
    }

    public function initiateClass($struct)
    {
        $tag = $struct[":tag"];
        if (
            !class_exists(
                $class =
                    "Orbitali\Foundations\Html\Elements\\" . Str::studly($tag)
            )
        ) {
            if (
                !class_exists(
                    $class =
                        "Orbitali\Foundations\Renderables\\" . Str::studly($tag)
                )
            ) {
                $obj = Element::withTag($tag);
            }
        }
        return $obj ?? new $class($struct);
    }
}
