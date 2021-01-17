<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\A;

class Panel extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $id;
    protected $errors;
    public function __construct(&$config)
    {
        parent::__construct();
        $this->config = $config;
        $this->id = $this->config["id"] ?? Str::random(8);
        $this->attributes->addClass(
            "js-wizard-simple block block block-rounded block-bordered"
        );

        $tabs = $this->buildTabs();
        $contents = $this->buildContents();

        $children = $this->parseChildren([$tabs, $contents], null);
        $this->children = $this->children->merge($children);
    }

    public function buildTabs()
    {
        $ul = Element::withTag("ul")
            ->addClass("nav nav-tabs nav-tabs-alt nav-justified")
            ->attribute("role", "tablist");
        $first = true;
        foreach ($this->config[":children"] as &$child) {
            $child["id"] = $child["id"] ?? Str::random(8);

            $a = (new A())
                ->addClass("nav-link")
                ->href("#" . $child["id"])
                ->data("toggle", "tab")
                ->addChild($child["title"]);

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
                $prop = $this->initiateClass($content);
                $tabPanel = $tabPanel->addChild($prop);
            }
            $div = $div->addChild($tabPanel);
        }
        return $div;
    }
}
