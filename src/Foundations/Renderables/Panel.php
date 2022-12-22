<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\A;
use Orbitali\Foundations\Html\Elements\Span;

class Panel extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $id;
    public $errors;
    public $form;
    public $tabId;
    public function __construct(&$config, &$form = null, $tabId = null)
    {
        parent::__construct();
        $this->config = $config;
        $this->form = $form;
        $this->tabId = $tabId;
        $this->errors = [];
        $this->id = $this->config["id"] ?? $this->generateId();
        $this->attributes->setAttribute("id", $this->id);
        $this->attributes->addClass(
            "js-wizard-simple block block block-rounded block-bordered"
        );

        $contents = $this->buildContents();
        if (count($this->errors) > 0) {
            if (isset($this->form) && isset($this->tabId)) {
                array_push(
                    $this->form->errors,
                    ...array_fill(0, count($this->errors), $this->tabId)
                );
            }
        }
        $this->errors = array_count_values($this->errors);
        $tabs = $this->buildTabs();

        $children = $this->parseChildren([$tabs, $contents], null);
        $this->children = $this->children->merge($children);
    }

    public function buildTabs()
    {
        $ul = Element::withTag("ul")
            ->addClass(
                "nav nav-tabs nav-tabs-alt nav-justified sticky-top bg-white-95"
            )
            ->attribute("role", "tablist");
        $first = true;

        $children = [];
        if (isset($this->config[":children"])) {
            $children = &$this->config[":children"];
        }
        foreach ($children as &$child) {
            $child["id"] = $child["id"] ?? $this->generateId();
            $errCount = $this->errors[$child["id"]] ?? 0;

            $a = (new A())
                ->addClass("nav-link")
                ->href("#" . $child["id"])
                ->data("toggle", "tab")
                ->attribute("role", "tab")
                ->addChild($this->getTitle($child) . " ");

            if ($errCount > 0) {
                $a = $a->addChild(
                    (new Span())
                        ->addClass(["badge", "badge-pill", "badge-danger"])
                        ->html("" . $errCount)
                );
            }

            if ($first) {
                $a = $a->addClass("active");
                $first = false;
            }

            $tab = Element::withTag("li")
                ->addClass("nav-item")
                ->addChild($a);

            $ul = $ul->addChild($tab);
        }
        return $ul;
    }

    public function buildContents()
    {
        $div = (new Div())->addClass(
            "block-content block-content-full tab-content"
        );
        $first = true;
        $children = [];
        if (isset($this->config[":children"])) {
            $children = &$this->config[":children"];
        }
        foreach ($children as &$tab) {
            $tab["id"] = $tab["id"] ?? $this->generateId();
            $tabPanel = (new Div())
                ->addClass("tab-pane")
                ->id($tab["id"])
                ->attribute("role", "tabpanel");

            if ($first) {
                $tabPanel = $tabPanel->addClass("active");
                $first = false;
            }

            $tabChildren = [];
            if (isset($tab[":children"])) {
                $tabChildren = &$tab[":children"];
            }
            foreach ($tabChildren as &$content) {
                $prop = $this->initiateClass($content, $this, $tab["id"]);
                $tabPanel = $tabPanel->addChild($prop);
            }
            $div = $div->addChild($tabPanel);
        }
        return $div;
    }

    public function fixNestedSet($validations, &$newVal)
    {
        foreach ($validations as $val) {
            if (is_a($val, Collection::class)) {
                $this->fixNestedSet($val, $newVal);
            } elseif (Arr::accessible($val) && Arr::accessible(Arr::first($val))) {
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
