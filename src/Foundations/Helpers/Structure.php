<?php

namespace Orbitali\Foundations\Helpers;

use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Foundations\Html\Elements\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Structure
{
    public static function parseStructureValidations($structure, $model): array
    {
        $validations = collect([]);
        if (is_a($structure, \Orbitali\Http\Models\Structure::class)) {
            $structure = $structure->data;
        }

        foreach ($structure as $struct) {
            if (
                class_exists(
                    $class =
                        "Orbitali\Foundations\Renderables\\" .
                        Str::studly($struct[":tag"])
                )
            ) {
                $obj = new $class($struct);
                $val = $obj->getValidations();
                $first = Arr::first($val);
                if (is_array($first)) {
                    $validations->push(...$val);
                } else {
                    $validations->push($val);
                }
            }
        }
        $validations = $validations->filter();

        $titles = $validations
            ->mapWithKeys(function ($item) {
                return [$item["field"] => $item["title"]];
            })
            ->toArray();
        $rules = $validations
            ->mapWithKeys(function ($item) use (&$model) {
                return [
                    $item["field"] => self::ruleFixer(
                        $item["rules"],
                        $model,
                        $item["config"]
                    ),
                ];
            })
            ->toArray();

        return [$rules, $titles];
    }

    public static function ruleFixer(&$rules, &$model, &$config)
    {
        foreach ($rules as &$rule) {
            while(true)
            {
                if (preg_match('/(\$|@)([\:\w\.]+)/', $rule, $out)) {
                    if ($out[1] == "@") {
                        //Replace via model
                        self::ruleFixerForDetail($out, $model, $config);
                        $rule = str_replace(
                            $out[0],
                            data_get($model, $out[2], ""),
                            $rule
                        );
                    } elseif ($out[1] == "$") {
                        //Replace via config
                        if ($out[2] == "model_type") {
                            $rule = str_replace(
                                $out[0],
                                Relation::relationFinder($model->detail()->getRelated()),
                                $rule
                            );
                        } else {
                            $rule = str_replace(
                                $out[0],
                                data_get($config, $out[2], ""),
                                $rule
                            );
                        }
                    }
                } else {
                    break;
                }
            }
        }
        return $rules;
    }

    private static function ruleFixerForDetail(&$out, &$model, &$config)
    {
        if (Str::startsWith($out[2], "detail.")) {
            $language = Str::before(
                Str::after($config["name"], "details["),
                "]"
            );
            $indexOf = $model->details->search(function ($i) use ($language) {
                return $i->language == $language;
            });
            $out[2] = str_replace("detail", "details.$indexOf", $out[2]);
        }
    }

    /**
     * details[tr|TR][name][] -> details.tr|TR.name
     * @param $name
     * @return mixed
     */
    public static function nameToDotNotation($name)
    {
        return implode(".", self::parseName($name));
    }

    /**
     * details[tr|TR][name][] -> [details,tr|TR,name]
     * @param $name
     * @return mixed
     */
    public static function parseName($name)
    {
        preg_match_all("/[\w\d\|\.]+/", $name, $output_array);
        return $output_array[0];
    }

    public static function renderStructure($structure)
    {
        $element = "";
        foreach ($structure as $struct) {
            $element .= self::renderStruct($struct)->toHtml();
        }
        return $element;
    }

    public static function renderStruct($struct)
    {
        $tag = $struct[":tag"];
        $flagForRenderables = false;
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
            } else {
                $flagForRenderables = true;
            }
        }

        /** @var BaseElement $obj */
        $obj = $obj ?? new $class($struct);
        if (!$flagForRenderables) {
            $obj = $obj->attributes(
                array_filter(
                    $struct,
                    function ($key) {
                        return $key[0] != ":";
                    },
                    ARRAY_FILTER_USE_KEY
                )
            );

            if (isset($struct[":content"])) {
                $obj = $obj->children($struct[":content"]);
            }
            if (isset($struct[":children"])) {
                $obj = $obj->children($struct[":children"], [
                    __CLASS__,
                    "renderStruct",
                ]);
            }

            if (isset($struct["name"])) {
                $attr = self::parseName($struct["name"]);
                if ($attr[0] == "details") {
                    $value = html()
                        ->model->details()
                        ->firstOrNew(
                            self::languageCountryParserForWhere($attr[1])
                        )->{$attr[2]};
                } else {
                    $value = html()->model->{$attr[0]} ?? null;
                }

                $value = html()->old($struct["name"], $value);

                $name = preg_replace("/\[(.+)\]/U", '.$1', $struct["name"]);
                if (session("errors") && session("errors")->has($name)) {
                    $obj = $obj->addClass("is-invalid");
                }

                if (is_array($value)) {
                    $obj = $obj
                        ->attribute("data-value", json_encode($value))
                        ->value(json_encode($value));
                } else {
                    $checked =
                        is_a($obj, Input::class) &&
                        (($obj->getAttribute("type") == "radio" &&
                            isset($struct[":value"]) &&
                            $struct[":value"] == ($value ?? "0")) ||
                            ($obj->getAttribute("type") == "checkbox" &&
                                filter_var($value, FILTER_VALIDATE_BOOLEAN)));
                    $obj = $obj
                        ->attributeIf($checked, "checked")
                        ->value($value);
                }
            }

            if (isset($struct[":value"])) {
                $obj = $obj->value($struct[":value"]);
            }
        }
        return $obj;
    }

    /**
     * tr|TR -> ["language"=>"tr", "country"=>"TR"]
     * @param $language_country
     * @return mixed
     */
    public static function languageCountryParserForWhere($language_country)
    {
        $where = explode("|", $language_country);
        if (count($where) == 1) {
            $where[] = null;
        }
        return array_combine(["language", "country"], $where);
    }

    /**
     * [details,tr|TR,name,0] -> details[tr|TR][name][0]
     * @param $attr
     * @return mixed
     */
    public static function implodeName($attr)
    {
        return $attr[0] . "[" . implode("][", array_slice($attr, 1)) . "]";
    }
}
