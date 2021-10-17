<?php

namespace Orbitali\Components;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;

abstract class InputComponent extends BaseComponent
{
    public $dottedName;

    public function inputComponentBoot($app, $parameters)
    {
        $this->except[] = "inputComponentBoot";
    }

    protected function dotNotation($name)
    {
        return Str::replaceLast(
            "[]",
            "",
            preg_replace("/\[(.+)\]/U", '.$1', $name)
        );
    }

    protected function notifyError()
    {
        if (is_null($this->parent)) {
            return;
        }

        $errors = view()->shared("errors");
        if (!$errors->has($this->dottedName)) {
            return;
        }

        if (method_exists($this->parent, "notifyError")) {
            $this->parent->notifyError($this);
        }
    }

    public function getValue($model, $dottedName)
    {
        if (is_null($model) || $this->preRender) {
            return null;
        }

        $value = old($dottedName, function () use ($dottedName, $model) {
            $attr = explode(".", $dottedName);
            if ($attr[0] == "details") {
                $detail = $this->getDetailModel($model, $attr);
                return data_get($detail, $attr[2]);
            } else {
                return data_get($model, $attr[0]);
            }
        });

        if (is_array($value)) {
            $repeater = $this->findRepeater();

            if (!is_null($repeater)) {
                $index = $repeater->attributes->get("repeater-id");
                $value = data_get($value, $index - 1);
            } else {
                $value = data_get($value, 0);
            }
        }

        return $value;
    }

    private function getDetailModel($model, $attr)
    {
        return collect(Structure::languageCountryParserForWhere($attr[1]))
            ->reduce(function ($curent, $value, $key) {
                return $curent->where($key, $value);
            }, $model->details)
            ->first();
    }

    private function findRepeater()
    {
        $parent = $this;
        do {
            $parent = $parent->parent;
            if ($parent == null) {
                return null;
            }
        } while (!$parent->attributes->has("repeater-id"));
        return $parent;
    }

    public function getDatasource()
    {
        if (isset($this->dataSource)) {
            return resolve($this->dataSource)->source();
        }
        return [];
    }
}
