<?php

namespace Orbitali\Foundations\Helpers;

use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Element;
use Orbitali\Foundations\Html\Elements\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Structure
{
    public static function parseStructureValidations($structure): array
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
                $validations[] = $obj->getValidations();
            }
        }
        $validations = $validations->flatten(1);
        $titles = $validations
            ->mapWithKeys(function ($item) {
                return [$item["field"] => $item["title"]];
            })
            ->toArray();
        $rules = $validations
            ->mapWithKeys(function ($item) {
                return [$item["field"] => $item["rules"]];
            })
            ->toArray();
        return [$rules, $titles];
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
        preg_match_all("/[\w\d\|]+/", $name, $output_array);
        return $output_array[0];
    }

    public static function renderStructure($structure)
    {
        $element = "";
        foreach ($structure as $struct) {
            $element .= self::renderStruct($struct)->toHtml();
        }

        //Push style and script to frontend, need a stack of script and styles
        /*View::composer('Orbitali::*', function (\Illuminate\View\View $view) {
            $env = $view->getFactory();
            $name = "__pushonce_";
            !isset($env->{$name}) && ($env->{$name} = !0) &&  $env->startPush("scripts", "<script>alert('".$view->name()."');</script>");
            !isset($env->{$name}) && ($env->{$name} = !0) &&  $env->startPush("styles", "<script>alert('".$view->name()."');</script>");
        });*/

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
                    $value = html()->model->{$attr[0]};
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
