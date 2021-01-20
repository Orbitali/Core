<?php

namespace Orbitali\Foundations\Renderables;

use Orbitali\Foundations\Html\BaseElement;
use Illuminate\Support\Facades\View;

class Status extends BaseRenderable
{
    protected $tag = "div";
    protected $formGroup;
    public function __construct(&$config, $form = null, $tabId = null)
    {
        parent::__construct();
        $struct = [
            ":tag" => "FormGroup",
            "id" => "status",
            "type" => "radio",
            ":data-source" => [
                ["1" => "Active"],
                ["0" => "Passive"],
                ["2" => "Draft"],
            ],
            "name" => "status",
            "title" => "Status",
            ":rules" => ["required"],
        ];
        $this->formGroup = $this->initiateClass($struct, $form, $tabId);
        $this->attributes = $this->formGroup->attributes;
        $this->children = $this->formGroup->children;

        $script = [
            ":tag" => "Script",
            ":content" => "$('#status1').parent().addClass('custom-control-success');
                $('#status0').parent().addClass('custom-control-danger');
                $('#status2').parent().addClass('custom-control-dark');",
        ];
        $scripts = $this->initiateClass($script, $form, $tabId);
        $this->children->add($scripts);
    }

    public function getValidations()
    {
        return $this->formGroup->getValidations();
    }
}
