<div class="form-group">
    @php($items = $getDatasource())
    @php($multiple = count($items)>0)
    @php($items = count($items) != 0 ? $items : [true =>$title])
    @if($type=="checkbox")
    <input id="{{$id}}-hidden" type="hidden" name="{{$name}}" />
    @endif
    @if(!$multiple)
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    @endif
    @php($values = $getValue($model,$dottedName))
    @foreach ($items as $key=>$value)
    <div class="form-control-file custom-control custom-control-inline {{"custom-".$type}} mb-1 w-auto">
        <input type="{{$type}}" name="{{$name.($type == "checkbox" && $multiple ? "[]" : "")}}" value="{{$key}}"
            class="custom-control-input" id="{{"$id-$key"}}"
            {{ (is_array($values) && in_array($key,$values)||$key == $values) ? "checked": ""}} />
        <label id="{{"$id-$key-label"}}" class="custom-control-label" for="{{"$id-$key"}}">
            {{$value}}
        </label>
    </div>
    @endforeach

    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>