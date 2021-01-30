<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\Html\BaseElement;

class DetailPanel extends BaseRenderable
{
    protected $tag = "div";

    public function __construct(&$config, &$form = null, $tabId = null)
    {
        parent::__construct();
        $activeLanguages = orbitali("website")->languages;
        $config[":tag"] = "Panel";
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);

        foreach ($activeLanguages as $lang) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => "native.language." . $lang,
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $lang);
            $config[":children"][] = $panel;
        }

        $element = $this->initiateClass($config, $form, $tabId);
        $this->attributes = $element->attributes;
        $this->children = $element->children;
    }

    private function applyChild($children, $lang)
    {
        foreach ($children as &$child) {
            if (isset($child["name"])) {
                $name = Str::before($child["name"], "[");
                $after = Str::after($child["name"], "[");
                $multiple = $name != $child["name"];
                $child["name"] = "details[{$lang}][" . $name . "]";
                if ($multiple) {
                    $child["name"] .= "[" . $after;
                }

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

    public function fixNestedSet($validations, &$newVal)
    {
        foreach ($validations as $val) {
            if (is_a($val, Collection::class)) {
                $this->fixNestedSet($val, $newVal);
            } elseif (is_array($val) && is_array(Arr::first($val))) {
                $newVal = $newVal->merge($val);
            } else {
                $newVal->push($val);
            }
        }
    }

    public function getValidations()
    {
        $validations = parent::getValidations();
        $newVal = collect([]);
        $this->fixNestedSet($validations, $newVal);
        return $newVal->toArray();
    }
}
