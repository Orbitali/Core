<?php

namespace Orbitali\Components;

use Illuminate\View\Component;

abstract class BaseComponent extends Component
{
    /**
     * The id of input.
     *
     * @var string
     */
    public $id;

    /**
     * The parent component.
     *
     * @var Component|null
     */
    public $parent;

    /**
     *
     * @var bool
     */
    public $preRender = true;

    abstract public function update();

    public function baseComponentBoot($app, $parameters)
    {
        $this->except[] = "parent";
        $this->except[] = "baseComponentBoot";
        $this->except[] = "update";
        $this->except[] = "preRender";

        if (isset($parameters["id"])) {
            $this->id = $parameters["id"];
        }

        if (isset($parameters["parent"])) {
            $this->parent = $parameters["parent"];
            if (method_exists($this->parent, "addChild")) {
                $this->parent->addChild($this);
            }
        } else {
            $this->preRender = false;
        }
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        return "";
    }

    public static function componentClassFinder(array $config)
    {
        if (!isset($config[":tag"])) {
            throw new \Exception("Component is not found");
        }
        $tag = $config[":tag"];

        if ($tag == "Column") {
            return null;
        }

        if ($tag == "Status") {
            return StatusPanel::class;
        }

        if ($tag == "Repeater") {
            return RepeaterPanel::class;
        }

        if ($tag == "DetailPanel") {
            return DetailPanel::class;
        }

        if ($tag == "Panel") {
            return TabContainer::class;
        }
        if ($tag == "PanelTab") {
            return TabPanel::class;
        }

        if ($tag == "Style") {
            return StylePanel::class;
        }
        if ($tag == "Script") {
            return ScriptPanel::class;
        }

        if ($tag == "FormGroup") {
            if (!isset($config["type"])) {
                throw new \Exception("Component is not found");
            }
            $type = $config["type"];

            if ($type == "text") {
                return TextInput::class;
            }
            if ($type == "editor") {
                return EditorInput::class;
            }
            if ($type == "textarea") {
                return TextareaInput::class;
            }
            if ($type == "url") {
                return TextInput::class;
            }
            if ($type == "email") {
                return TextInput::class;
            }
            if ($type == "slug") {
                return SlugInput::class;
            }
            if ($type == "mask") {
                return MaskInput::class;
            }
            if ($type == "file") {
                return DropzoneInput::class;
            }
            if ($type == "checkbox") {
                return CheckboxInput::class;
            }
            if ($type == "radio") {
                return RadioInput::class;
            }
            if ($type == "select") {
                return Select2Input::class;
            }
        }
    }
}
