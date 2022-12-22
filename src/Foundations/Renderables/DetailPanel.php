<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;
use Orbitali\Http\Models\Category;

class DetailPanel extends BaseRenderable
{
    protected $tag = "div";

    public function __construct(&$config, &$form = null, $tabId = null)
    {
        parent::__construct();
        $activeDetails = $this->findParentDetails();
        $config[":tag"] = "Panel";
        $rawChiled = array_merge([], $config[":children"] ?? []);
        unset($config[":children"]);

        foreach ($activeDetails as $lang => $url) {
            $panel = [
                ":tag" => "PanelTab",
                "title" => "native.language." . $lang,
            ];
            $panel[":children"] = $this->applyChild($rawChiled, $lang, $url);
            $config[":children"][] = $panel;
        }

        $element = $this->initiateClass($config, $form, $tabId);
        $this->attributes = $element->attributes;
        $this->children = $element->children;
    }

    private function applyChild($children, $lang, $url)
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
                    $child[":slug"] = $url . "/";
                }
            }
            if (isset($child[":children"])) {
                $child[":children"] = $this->applyChild(
                    $child[":children"],
                    $lang,
                    $url
                );
            }
        }
        return $children;
    }

    private function findParentDetails()
    {
        $model = html()->model;
        if (is_a($model, Page::class) || is_a($model, Category::class)) {
            $model->loadMissing("node.details.url");
            return $model->node->details->mapWithKeys(function ($detail) {
                return [$detail->language => $detail->url];
            });
        } elseif (is_a($model, Website::class) && isset($model->languages)) {
            return collect($model->languages)->mapWithKeys(function ($lang) {
                return [$lang => ""];
            });
        } else {
            $websiteDetails = orbitali("website")->loadMissing("details.url")
                ->details;
            return collect($websiteDetails)->mapWithKeys(function ($detail) {
                $url = Str::of($detail->url)->rtrim("/");
                return [$detail->language => $url];
            });
        }
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
