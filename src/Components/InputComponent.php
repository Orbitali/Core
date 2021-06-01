<?php

namespace Orbitali\Components;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;

abstract class InputComponent extends BaseComponent
{
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
        //old($dottedName, data_get($model,$dottedName))
        if ($model == null) {
            return null;
        }

        $old = old($dottedName);
        if ($old) {
            return $old;
        }

        $attr = explode(".", $dottedName);
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
        /*
        $value = html()->old($this->dotNotation($this->config["name"]), $value);
        if (is_array($value) && isset($this->config[":repeaterIds"])) {
            $value = data_get(
                $value,
                implode(".", $this->config[":repeaterIds"])
            );
        }
        */
        return $value;
    }
}
