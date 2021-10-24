@aware(['for'])
@props(['model' => $for,'type' => 'text'])
<input id="{{$for}}" type="{{$type}}" @class(["form-control","form-control-alt", "is-invalid"=> $errors->has($model)])
wire:dirty.class="border-red-500" wire:model.lazy="{{$model}}" >