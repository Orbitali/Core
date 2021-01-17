<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Label;
use Orbitali\Foundations\Html\Elements\Input;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\Span;
use Orbitali\Foundations\Html\Elements\Select;

class FormGroup extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $id;
    protected $errors;
    public function __construct($config)
    {
        parent::__construct();
        $this->config = $config;
        $this->id = $this->config["id"] ?? Str::random(8);
        $this->attributes->addClass("form-group");

        $this->errors = $this->getErrors();

        $label = $this->buildLabel();
        $input = $this->buildInput();
        $error = $this->buildError();

        $children = $this->parseChildren([$label, $input, $error], null);
        $this->children = $this->children->merge($children);
    }

    public function getValidations()
    {
        return [
            "field" => $this->dotNotation($this->config["name"]),
            "rules" => $this->config[":rules"] ?? "",
            "title" => $this->config["title"] ?? "",
        ];
    }

    private function getErrors()
    {
        if (session("errors") == null) {
            return [];
        }
        $name = $this->dotNotation($this->config["name"]);
        return session("errors")->get($name);
    }

    private function getValue()
    {
        if (html()->model == null) {
            return null;
        }

        $attr = Structure::parseName($this->config["name"]);
        if ($attr[0] == "details") {
            $detail = html()
                ->model->details()
                ->firstOrNew(
                    Structure::languageCountryParserForWhere($attr[1])
                );
            $value = $detail->exists ? $detail->{$attr[2]} : null;
        } elseif ($attr[0] == "categories") {
            $categories = html()
                ->model->categories->pluck("id")
                ->toArray();
            $value = $categories;
        } else {
            $value = html()->model->{$attr[0]};
        }

        return html()->old($this->config["name"], $value);
    }

    private function buildInput()
    {
        $type = $this->config["type"];
        if (\in_array($type, ["text", "email", "textarea", "url"])) {
            $input = $this->buildRawInput($type);
        } elseif ($type === "select") {
            $input = $this->buildSelect2();
        } elseif ($type === "file") {
            $input = $this->buildRawInput($type);
        } elseif ($type === "checkbox") {
            $input = $this->buildRawInput($type);
        }

        if (count($this->errors) > 0) {
            $input = $input->class(["is-invalid"]);
        }

        return $input;
    }

    private function buildRawInput($type)
    {
        return (new Input())
            ->id($this->id)
            ->class(["form-control", "form-control-alt"])
            ->type($type)
            ->name($this->config["name"])
            ->value($this->getValue());
    }

    private function buildSelect2()
    {
        $select = (new Select())
            ->id($this->id)
            ->class(["form-control", "js-select2"])
            ->data("width", "100%")
            ->name($this->config["name"])
            ->value($this->getValue());

        if (isset($this->config[":multiple"])) {
            $select = $select->multiple();
        }

        if (isset($this->config[":data-source"])) {
            if (is_array($this->config[":data-source"])) {
                $select = $select->options($this->config[":data-source"]);
            } else {
                $select = $select->options(
                    resolve($this->config[":data-source"])->source()
                );
            }
        }

        return $select;
    }

    private function buildLabel()
    {
        $label = (new Label())
            ->id($this->id . "_label")
            ->for($this->id)
            ->addChild($this->config["title"]);

        if (
            isset($this->config[":rules"]) &&
            Str::contains("required", $this->config[":rules"])
        ) {
            $label = $label->addChild(
                (new Span())->addClass("text-danger")->html(" *")
            );
        }

        if (count($this->errors) > 0) {
            $label = $label->class(["is-invalid"]);
        }

        return $label;
    }

    private function buildError()
    {
        if (count($this->errors) < 1) {
            return null;
        }
        $div = (new Div())->class("invalid-feedback")->html($this->errors);
        return $div;
    }

    public function value($value)
    {
        return $this;
    }
}
