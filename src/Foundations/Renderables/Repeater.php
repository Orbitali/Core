<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\BaseElement;

class Repeater extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $defaultName;
    protected $element;
    public $form;
    public $tabId;
    public function __construct(&$config, &$form = null, $tabId = null)
    {
        parent::__construct();
        $this->config = &$config;
        $this->form = &$form;
        $this->tabId = &$tabId;
        $config[":tag"] = "Panel";
        $config["id"] = $config["id"] ?? $this->generateId();
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);
        $this->defaultName = data_get($rawChiled, "*.name");

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
        $this->element = $this->initiateClass($config, $form, $tabId);
        $this->fillErrors();
        $this->attributes = $this->element->attributes;
        $this->attributes->setAttributes([
            "data-repeater-count" => $forMax,
            "data-repeater-names" => json_encode($this->defaultName),
        ]);
        $this->children = $this->element->children;
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
        $newVal = collect($this->defaultName)->map(function ($i) {
            return [
                "field" => $this->dotNotation($i),
                "rules" => $this->config[":rules"] ?? [],
                "title" => $this->config["title"],
                "config" => &$this->config,
            ];
        });
        $this->fixNestedSet($validations, $newVal);
        return $newVal->toArray();
    }

    private function fillErrors()
    {
        if (session("errors") == null) {
            return [];
        }
        $errors = collect($this->defaultName)
            ->map(function ($i) {
                return session("errors")->get($this->dotNotation($i));
            })
            ->filter();
        if (count($errors) > 0) {
            $this->element->attributes->addClass("border-danger");
        }
        $invalidMessages = collect($errors)->map(function ($error) {
            if (!is_null($this->tabId)) {
                $this->form->errors[] = $this->tabId;
            }
            return (new Div())
                ->class(["invalid-feedback", "d-block", "mt-0", "mb-1"])
                ->html($error);
        });
        $this->element->children[1]->children = $invalidMessages->merge(
            $this->element->children[1]->children
        );
    }
}
