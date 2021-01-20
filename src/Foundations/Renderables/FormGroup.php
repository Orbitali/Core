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
use Orbitali\Foundations\Html\Elements\Form;
use Orbitali\Foundations\Html\Elements\Textarea;
use Illuminate\Support\Facades\Storage;

class FormGroup extends BaseRenderable
{
    protected $tag = "div";
    protected $config;
    protected $id;
    protected $errors;
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

        $label = $this->buildLabel();
        $child = [$label];

        $input = $this->buildInput();
        if (is_array($input)) {
            $child = array_merge($child, $input);
        } else {
            $child[] = $input;
        }

        $child[] = $this->buildError();

        $children = $this->parseChildren($child, null);
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
        if (\in_array($type, ["text", "email", "url"])) {
            $input = $this->buildRawInput($type);
        } elseif ($type === "select") {
            $input = $this->buildSelect2();
        } elseif ($type === "file") {
            $input = $this->buildDropzone();
        } elseif (\in_array($type, ["checkbox", "radio"])) {
            $input = $this->buildCheckbox($type);
        } elseif (\in_array($type, ["editor", "textarea"])) {
            $input = $this->buildEditor($type);
        } elseif ($type === "slug") {
            $input = $this->buildSlugInput();
        } elseif ($type === "mask") {
            $input = $this->buildMaskInput();
        }

        if (count($this->errors) > 0) {
            if (isset($this->form) && isset($this->tabId)) {
                $this->form->errors[] = $this->tabId;
            }
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

    private function buildSlugInput()
    {
        return (new Input())
            ->id($this->id)
            ->class(["form-control", "form-control-alt", "js-imask"])
            ->data("slug", $this->config[":slug"])
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
        $select = (new Select())
            ->id($this->id)
            ->class(["form-control", "js-select2"])
            ->data("width", "100%")
            ->data("prevent-sort", $this->config[":prevent-sort"] ?? false)
            ->name($this->config["name"])
            ->value($this->getValue())
            ->options($this->getDatasource());

        if (isset($this->config[":multiple"])) {
            $select = $select->multiple();
        }

        return $select;
    }

    private function buildDropzone()
    {
        $dropzone = (new Div())
            ->id($this->id)
            ->class(["js-dropzone", "w-100"])
            ->data("name", $this->config["name"])
            ->data("url", route("panel.file.upload"))
            ->data("multiple", isset($this->config[":multiple"]));
        $files = [];
        $localDisk = Storage::disk("public");
        $paths = $this->getValue();
        if ($paths == null || $paths == "") {
            $paths = [];
        }
        foreach ($paths as $path) {
            if ($path == null) {
                continue;
            }
            $files[] = [
                "name" => basename($path),
                "preview" => $localDisk->url($path),
                "type" => $localDisk->mimeType($path),
                "path" => $path,
            ];
        }
        $dropzone = $dropzone->data("files", json_encode($files));
        return $dropzone;
    }

    private function buildEditor($type)
    {
        $editor = (new Textarea())
            ->name($this->config["name"])
            ->class(["w-100"])
            ->value($this->getValue());
        if ($type == "editor") {
            $editor = $editor->id("js-ckeditor");
        } else {
            $editor = $editor
                ->id($this->id)
                ->class(["form-control", "form-control-alt"]);
            foreach (["rows", "cols"] as $key) {
                if (isset($this->config[$key])) {
                    $editor = $editor->attribute($key, $this->config[$key]);
                }
            }
        }

        //TODO: editor is not working correctly
        return $editor;
    }

    private function buildCheckbox($type)
    {
        $response = [];
        $items = $this->getDatasource();
        if (count($items) > 1 && $type == "checkbox") {
            $this->config["name"] .= "[]";
        }
        $values = $this->getValue();
        foreach ($items as $key => $value) {
            $div = (new Div())->addClass([
                "custom-control",
                "custom-control-inline",
                "custom-" . $type,
                "mb-1",
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
        /*
             <div class="custom-control custom-checkbox mb-1">
                 <input type="checkbox" class="custom-control-input" id="example-cb-custom1" name="example-cb-custom1" checked>
                 <label class="custom-control-label" for="example-cb-custom1">Option 1</label>
             </div>
            */
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
