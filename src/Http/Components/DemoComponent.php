<?php

namespace Orbitali\Http\Components;

use Livewire\Component;
use Orbitali\Http\Models\{Website, Menu};
use Illuminate\Database\Eloquent\Model;
use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DemoComponent extends Component
{
    public $model;

    public $panelState = [];

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

    public function hydrateModel($model, $request)
    {
        $relationName = "details";
        $model->setRelation(
            $relationName,
            $model->$relationName->map(function ($relation) use (
                $request,
                $relationName
            ) {
                if ($relation instanceof Model) {
                    return $relation;
                }
                $withOutExtras = $this->model->$relationName()->getRelated()
                    ::$withoutExtra;
                $relationModel = $this->model
                    ->$relationName()
                    ->make(Arr::only($relation, $withOutExtras));

                if ($relationModel->isRelation("extras")) {
                    $relationModel->setRelation(
                        "extras",
                        new KeyValueCollection([], $relationModel->extras())
                    );
                    $extras = Arr::except($relation, $withOutExtras);
                    array_walk($extras, function ($value, $key) use (
                        $relationModel
                    ) {
                        if (!is_null($value)) {
                            $relationModel->$key = $value;
                        }
                    });
                }
                return $relationModel;
            })
        );
    }

    protected function rules()
    {
        return [
            "model.details.*.id" => "",
            "model.details.*.website_id" => "",
            "model.details.*.language" => "",
            "model.details.*.country" => "",
            "model.details.*.name" => "required|min:10",
            "model.details.*.about_title" => "required",
            "model.id" => "",
            "model.address" => "",
            "model.phone" => "",
            "model.email" => "",
            "model.feature_icon.*" => "",
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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
