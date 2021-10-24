<?php

namespace Orbitali\Http\Components;

use Livewire\Component;

class RepeaterComponent extends Component
{
    public $model;
    public $activeTab;

    public function mount()
    {
    }

    public function render()
    {
        return view("Orbitali::components.repeater")->slot([
            "title",
            "content",
        ]);
    }
}
