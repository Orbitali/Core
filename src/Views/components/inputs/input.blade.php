@aware(['for','id'])
@props(['model' => $for,'type' => 'text'])
<input id="{{$for}}" type="{{$type}}" @class(["form-control","form-control-alt", "is-invalid"=> $errors->has($model)])
wire:model.lazy="{{$model}}" >