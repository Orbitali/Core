<?php

namespace Orbitali\Foundations\Renderables;

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
    public function __construct(&$config)
    {
        parent::__construct();
        $this->config = $config;
        $this->errors = [];
        $this->id = $this->config["id"] ?? Str::random(8);
        $this->attributes->addClass(
            "js-wizard-simple block block block-rounded block-bordered"
        );

        $contents = $this->buildContents();
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
        foreach ($this->config[":children"] as &$child) {
            $child["id"] = $child["id"] ?? Str::random(8);
            $errCount = $this->errors[$child["id"]] ?? 0;

            $a = (new A())
                ->addClass("nav-link")
                ->href("#" . $child["id"])
                ->data("toggle", "tab")
                ->addChild($child["title"] . " ");

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
        foreach ($this->config[":children"] as &$tab) {
            $tab["id"] = $tab["id"] ?? Str::random(8);
            $tabPanel = (new Div())
                ->addClass("tab-pane")
                ->id($tab["id"])
                ->attribute("role", "tabpanel");

            if ($first) {
                $tabPanel = $tabPanel->addClass("active");
                $first = false;
            }

            foreach ($tab[":children"] as &$content) {
                $prop = $this->initiateClass($content, $this, $tab["id"]);
                $tabPanel = $tabPanel->addChild($prop);
            }
            $div = $div->addChild($tabPanel);
        }
        return $div;
    }
}
