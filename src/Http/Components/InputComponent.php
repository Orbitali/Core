<?php

namespace Orbitali\Http\Components;

use Livewire\Component;

class InputComponent extends Component
{
    public $model;
    public $name;

    protected function rules()
    {
        return [
            "model.$this->name" => "",
        ];
    }

    public function render()
    {
        return <<<'blade'
<input class="form-control form-control-alt" type="text" wire:dirty.class="border-red-500"
        wire:model.lazy="model.{{$name}}">
blade;
    }
}
