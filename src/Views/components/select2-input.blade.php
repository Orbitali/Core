<div class="form-group">
    @if($multiple)
    <input type="hidden" name="{{$name}}">
    @endif
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <select id="{{$id}}" class="form-control js-select2 @error($dottedName) is-invalid @enderror" width="100%"
        name="{{$name}}" {{$preventSort ? "data-prevent-sort": ""}} {{$multiple ? "multiple": ""}}>
        @php($values = $getValue($model,$dottedName))
        @foreach ($getDatasource() as $key=>$value)
        <option value="{{$key}}" {{in_array($key,$values) ? "selected": ""}}>{{$value}}</option>
        @endforeach
    </select>
    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>