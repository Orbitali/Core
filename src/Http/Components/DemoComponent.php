<?php

namespace Orbitali\Http\Components;

use Livewire\Component;
use Orbitali\Http\Models\Website;

class DemoComponent extends Component
{
    public $model;

    protected $rules = [
        //"model.detail_tr.name" => "",
        "model.detail.name" => "",
        "model.address" => "",
        "model.phone" => "",
        "model.email" => "",
        "model.feature_icon.*" => "",
    ];

    public function missingRuleFor($dotNotatedProperty)
    {
        return false;
    }

    public function mount()
    {
        $this->model = Website::with([
            "details.url",
            "details.extras",
            "extras",
        ])->find(1);
        $this->model->details->each(function ($detail) {
            $this->model->setRelation("detail_" . $detail->language, $detail);
        });
        // dd($this->model);
    }

    public function save()
    {
        $this->validate();
        $this->model->push();
    }

    public function render()
    {
        return view("Orbitali::components.website");
    }
}
