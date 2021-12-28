<?php

namespace Orbitali\Http\Components;

use Livewire\Component;
use Orbitali\Http\Models\Website;

class DemoComponent extends Component
{
    public $model;

    public $panelState = [];

    public function boot()
    {
        orbitali("website", Website::find(1));
    }

    public function createDetail($lang)
    {
        $detail = $this->model->details()->make(["language" => $lang]);
        $this->model->details->add($detail);
    }

    public function resetModel()
    {
        $this->resetErrorBag();
        $this->panelState = [];
        $this->model = Website::with([
            "details.url",
            "details.extras",
            "extras",
        ])->find(1);
    }

    public function attachPanel($panelId, $activeTab)
    {
        $this->panelState[$panelId] = $activeTab;
    }

    protected function rules()
    {
        return [
            "model.details.*.id" => "",
            "model.details.*.website_id" => "",
            "model.details.*.language" => "",
            "model.details.*.country" => "",
            "model.details.*.name" => "required|min:100",
            "model.details.*.about_title" => "required",
            "model.details.*.feature_title.*" => "required",
            "model.id" => "",
            "model.address" => "",
            "model.phone" => "",
            "model.email" => "",
            "model.feature_icon.*" => "required",
        ];
    }
    protected function validationAttributes()
    {
        return [
            "model.details.*.name" => __([
                "panel.website.1.details.*.name",
                "Name",
            ]),
            "model.details.*.about_title" => __([
                "panel.website.1.details.*.about_title",
                "About Us",
            ]),
            "model.details.*.feature_title.*" => __([
                "panel.website.1.details.*.feature_title.*",
                "Başlık",
            ]),
            "model.feature_icon.*" => __([
                "panel.website.1.feature_icon.*",
                "Resim Adı",
            ]),
        ];
    }

    public function updated($propertyName)
    {
        $this->withValidator(function ($validator) use ($propertyName) {
            $rp = new \ReflectionProperty($validator, "rules");
            $rp->setAccessible(true);
            $rule = $rp->getValue($validator)[$propertyName] ?? [];
            $rp->setValue($validator, [$propertyName => $rule]);
        });
        $this->validate();
    }

    public function mount()
    {
        $this->model = Website::with([
            "details.url",
            "details.extras",
            "extras",
        ])->find(1);
    }

    public function save()
    {
        $this->validate();
        $this->model->push();
    }

    public function render()
    {
        return view("Orbitali::components.website")
            ->extends("Orbitali::inc.app")
            ->section("content");
    }
}
