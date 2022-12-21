<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Http\Models\Page;

abstract class BaseRenderable extends BaseElement
{
    public function getValidations()
    {
        $vals = collect([]);
        $this->walkAllChild($this->children, $vals);
        return $vals->filter(function ($q) {
            return $q != null;
        });
    }

    private function walkAllChild($childs, &$vals)
    {
        foreach ($childs as $child) {
            if (is_a($child, BaseRenderable::class)) {
                $vals[] = $child->getValidations();
            } elseif ($child != null && isset($child->children)) {
                $this->walkAllChild($child->children, $vals);
            }
        }
    }

    public function dotNotation($name)
    {
        return Str::replaceLast(
            "[]",
            "",
            preg_replace("/\[(.+)\]/U", '.$1', $name)
        );
    }

    public function initiateClass($struct, $form = null, $tabId = null)
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
        return $obj ?? new $class($struct, $form, $tabId);
    }

    public function generateId()
    {
        return "op" . Str::random(6);
    }

    public function getValue()
    {
        $model = html()->model;
        if ($model == null) {
            return null;
        }

        $attr = Structure::parseName($this->config["name"]);
        $value = null;
        if (isset($attr[0])) {
            if ($attr[0] == "details") {
                $detail = \collect(
                    Structure::languageCountryParserForWhere($attr[1])
                )
                    ->reduce(function ($curent, $value, $key) {
                        return $curent->where($key, $value);
                    }, $model->details)
                    ->first();
                $value = data_get($detail, $attr[2]);
            } else {
                $value = data_get($model, $attr[0]);
            }
        }
    
        $value = html()->old($this->dotNotation($this->config["name"]), $value);

        if ($value instanceof Collection) {
            if (isset($this->config[":repeaterIds"])) {
                $value = data_get(
                    $value,
                    implode(".", $this->config[":repeaterIds"])
                );
            } else {
                $value = $value->first();
            }
        }

        return $value;
    }

    public function getTitle($conf = [])
    {
        $key = $orj = $conf["title"] ?? $this->config["title"];
        if (!Str::startsWith($orj, "native.")) {
            $structure = html()->model->structure;
            $key = implode(".", [
                "panel",
                $structure->model_type,
                $structure->model_id,
                $structure->mode,
                Str::snake($orj),
            ]);
        } elseif (Str::startsWith($orj, "native.panel.index.")) {
            $orj = Str::after($orj, "native.panel.index.");
        }

        return trans([$key, $orj]);
    }
}