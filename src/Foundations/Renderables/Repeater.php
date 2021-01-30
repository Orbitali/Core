<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Orbitali\Foundations\Html\BaseElement;

class Repeater extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    public function __construct(&$config, &$form = null, $tabId = null)
    {
        parent::__construct();
        $this->config = &$config;
        $config[":tag"] = "Panel";
        $config["id"] = $config["id"] ?? $this->generateId();
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);
        $defaultName = data_get($rawChiled, "*.name");

        $requestCount = count(
            request($this->dotNotation(data_get($rawChiled, "0.name")), [])
        );
        $forMax = collect($rawChiled)
            ->pluck("name")
            ->filter()
            ->map(function ($name) use (&$config) {
                $config["name"] = $name;
                $val = $this->getValue();
                return is_array($val) ? count($val) : 1;
            })
            ->max();
        $forMax = max($forMax, $requestCount);

        for ($i = 0; $i < $forMax; $i++) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => "native.panel.index." . ($i + 1),
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $i);
            $config[":children"][] = $panel;
        }
        $element = $this->initiateClass($config, $form, $tabId);
        $this->attributes = $element->attributes;
        $this->attributes->setAttributes([
            "data-repeater-count" => $forMax,
            "data-repeater-names" => json_encode($defaultName),
        ]);
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
        return $newVal->toArray();
    }
}
