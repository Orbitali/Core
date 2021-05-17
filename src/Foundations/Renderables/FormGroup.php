<?php

namespace Orbitali\Foundations\Renderables;

use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Structure;
use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Foundations\Html\BaseElement;
use Orbitali\Foundations\Html\Elements\Label;
use Orbitali\Foundations\Html\Elements\Input;
use Orbitali\Foundations\Html\Elements\Div;
use Orbitali\Foundations\Html\Elements\Span;
use Orbitali\Foundations\Html\Elements\Select;
use Orbitali\Foundations\Html\Elements\Form;
use Orbitali\Foundations\Html\Elements\Textarea;
use Illuminate\Support\Facades\Storage;

class FormGroup extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $id;
    protected $errors;
    protected $appendLabel = true;
    public $form;
    public $tabId;
    public function __construct($config, $form = null, $tabId = null)
    {
        parent::__construct();
        $this->config = $config;
        $this->id = $this->config["id"] ?? $this->generateId();
        $this->attributes->addClass("form-group");
        $this->form = $form;
        $this->tabId = $tabId;
        $this->errors = $this->getErrors();

        $input = $this->buildInput();
        $child = is_array($input) ? $input : [$input];
        array_push($child, ...$this->buildError());

        if ($this->appendLabel) {
            array_unshift($child, $this->buildLabel());
        }

        $children = $this->parseChildren($child, null);
        $this->children = $this->children->merge($children);
    }

    public function getValidations()
    {
        return [
            "field" => $this->dotNotation($this->config["name"]),
            "rules" => $this->config[":rules"] ?? "",
            "title" => $this->getTitle(),
            "config" => $this->config,
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

    private function buildInput()
    {
        $type = $this->config["type"];
        if (\in_array($type, ["text", "email", "url"])) {
            $input = $this->buildRawInput($type);
        } elseif ($type === "select") {
            $input = $this->buildSelect2();
        } elseif ($type === "file") {
            $input = $this->buildDropzone();
        } elseif (\in_array($type, ["checkbox", "radio"])) {
            $input = $this->buildCheckbox($type);
        } elseif ($type === "textarea") {
            $input = $this->buildTextarea();
        } elseif ($type === "editor") {
            $input = $this->buildEditor();
        } elseif ($type === "slug") {
            $input = $this->buildSlugInput();
        } elseif ($type === "mask") {
            $input = $this->buildMaskInput();
        }

        if (count($this->errors) > 0) {
            if (isset($this->form) && isset($this->tabId)) {
                $this->form->errors[] = $this->tabId;
            }
            if (is_array($input)) {
                foreach ($input as &$val) {
                    $val = $val->class(["is-invalid"]);
                }
            } else {
                $input = $input->class(["is-invalid"]);
            }
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

    private function buildSlugInput()
    {
        $slug = $this->config[":slug"] ?? "";

        return (new Input())
            ->id($this->id)
            ->class(["form-control", "form-control-alt", "js-imask"])
            ->data("slug", $slug)
            ->type("text")
            ->name($this->config["name"])
            ->value($this->getValue());
    }

    private function buildMaskInput()
    {
        $input = (new Input())
            ->id($this->id)
            ->class(["form-control", "form-control-alt", "js-imask"])
            ->type("text")
            ->name($this->config["name"])
            ->value($this->getValue());

        foreach (
            ["mask", "regex", "lazy", "overwrite", "placeholderChar"]
            as $key
        ) {
            if (isset($this->config[":{$key}"])) {
                $input = $input->data($key, $this->config[":{$key}"]);
            }
        }

        return $input;
    }

    private function buildSelect2()
    {
        if ($this->config[":multiple"] ?? false) {
            $this->children->add(
                (new Input())->type("hidden")->name($this->config["name"])
            );
        }
        return (new Select())
            ->id($this->id)
            ->class(["form-control", "js-select2"])
            ->data("width", "100%")
            ->data("prevent-sort", $this->config[":prevent-sort"] ?? false)
            ->name($this->config["name"])
            ->value($this->getValue())
            ->options($this->getDatasource())
            ->multipleIf($this->config[":multiple"] ?? false);
    }

    private function buildDropzone()
    {
        $maxFiles = false;
        if ($this->config[":multiple"]) {
            foreach ($this->config[":rules"] as $rule) {
                if (
                    preg_match(
                        "/max:(?<max>\d+)|between:\d+,(?<max>\d+)/J",
                        $rule,
                        $regexMax
                    )
                ) {
                    $maxFiles = $regexMax["max"];
                    break;
                }
            }
        }
        $dropzone = (new Div())
            ->id($this->id)
            ->class(["js-dropzone", "w-100", "form-control-file"])
            ->data("name", $this->config["name"])
            ->data("url", route("panel.file.upload"))
            ->data("multiple", $this->config[":multiple"])
            ->data("maxFiles", $maxFiles);

        $files = [];
        $localDisk = Storage::disk("public");
        $paths = $this->getValue();
        if ($paths == null || $paths == "") {
            $paths = [];
        } elseif (is_string($paths)) {
            $paths = [$paths];
        }
        foreach ($paths as $path) {
            if ($path == null) {
                continue;
            }
            $files[] = [
                "name" => basename($path),
                "preview" => image($path)
                    ->fit(120)
                    ->get(),
                "type" => $localDisk->mimeType($path),
                "path" => $path,
                "accepted" => true,
            ];
        }
        $dropzone = $dropzone->data("files", json_encode($files));
        return $dropzone;
    }

    private function buildTextarea()
    {
        $editor = (new Textarea())
            ->id($this->id)
            ->class(["form-control", "w-100", "form-control-alt"])
            ->name($this->config["name"])
            ->class([])
            ->data("auto-height", $this->config[":auto-height"] ?? false)
            ->value($this->getValue());

        foreach (["rows", "cols"] as $key) {
            if (isset($this->config[$key])) {
                $editor = $editor->attribute($key, $this->config[$key]);
            }
        }

        return $editor;
    }

    private function buildEditor()
    {
        $editor = (new Div())
            ->id($this->id)
            ->class(["js-editor", "w-100", "form-control-file"])
            ->data("name", $this->config["name"])
            ->data("url", route("panel.file.upload"))
            ->addChild($this->getValue());

        return $editor;
    }

    private function buildCheckbox($type)
    {
        $response = [];
        $items = $this->getDatasource();
        if ($type == "checkbox") {
            $this->children->add(
                (new Input())->type("hidden")->name($this->config["name"])
            );
            if (count($items) > 1) {
                $this->config["name"] .= "[]";
            } else {
                $this->appendLabel = false;
            }
        }
        $values = $this->getValue();
        foreach ($items as $key => $value) {
            if (is_array($value) && count($value) == 1) {
                $key = array_keys($value)[0];
                $value = $value[$key];
            }
            $div = (new Div())->addClass([
                "form-control-file",
                "custom-control",
                "custom-control-inline",
                "custom-" . $type,
                "mb-1",
                "w-auto",
            ]);
            $input = (new Input())
                ->id($this->id . $key)
                ->class(["custom-control-input"])
                ->type($type)
                ->name($this->config["name"])
                ->value($key)
                ->checked(
                    is_array($values)
                        ? in_array($key, $values)
                        : $key == $values
                );
            if (!is_string($value)) {
                $value = "" . $value;
            }
            $label = (new Label())
                ->id($this->id . $key . "_label")
                ->class(["custom-control-label"])
                ->for($this->id . $key)
                ->html($value);
            $response[] = $div->addChild([$input, $label]);
        }

        return $response;
    }

    private function getDatasource()
    {
        if (isset($this->config[":data-source"])) {
            if (is_array($this->config[":data-source"])) {
                $items = $this->config[":data-source"];
            } else {
                $items = resolve($this->config[":data-source"])->source();
            }
        }
        return $items ?? [];
    }

    private function buildLabel()
    {
        $label = (new Label())
            ->addClass(["d-block"])
            ->id($this->id . "_label")
            ->for($this->id)
            ->addChild($this->getTitle());

        if (
            isset($this->config[":rules"]) &&
            Str::contains("required", $this->config[":rules"])
        ) {
            $label = $label->addChild(
                (new Span())->addClass("text-danger")->html(" *")
            );
        }

        return $label->classIf(count($this->errors) > 0, ["is-invalid"]);
    }

    private function buildError()
    {
        if (count($this->errors) < 1) {
            return [];
        }

        return collect($this->errors)
            ->map(function ($error) {
                return (new Div())->class("invalid-feedback")->html($error);
            })
            ->toArray();
    }

    public function value($value)
    {
        return $this;
    }
}
