<?php

namespace Orbitali\Http\Components;

use Livewire\Component;

class InputGroupComponent extends Component
{
    public $model;
    public $label;
    public $for;
    public $error;

    public function render()
    {
        return <<<'blade'
<div class="form-group">
    <label class="d-block" id="{{$for}}_label" for="{{$for}}">
        {{$label}}
        <span class="text-danger">*</span>
    </label>
    
    @isset($error)
    <div class="invalid-feedback">{{ $error }}</div>
    @enderror
</div>
blade;
    }
}
