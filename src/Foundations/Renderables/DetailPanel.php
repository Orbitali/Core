<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Html\BaseElement;

class DetailPanel extends BaseRenderable
{
    protected $tag = "div";

    public function __construct(&$config)
    {
        parent::__construct();
        $activeLanguages = orbitali("website")->languages;
        $config[":tag"] = "Panel";
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);

        foreach ($activeLanguages as $lang) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => __("native.language." . $lang),
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $lang);
            $config[":children"][] = $panel;
        }

        $element = $this->initiateClass($config);
        $this->attributes = $element->attributes;
        $this->children = $element->children;
    }

    private function applyChild($children, $lang)
    {
        foreach ($children as &$child) {
            if (isset($child["name"])) {
                $child["name"] = "details[{$lang}][" . $child["name"] . "]";
                if ($child["type"] == "slug") {
                    $child[":slug"] = "/{$lang}/";
                }
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
}
