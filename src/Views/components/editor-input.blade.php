<div class="form-group">
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <div id="{{$id}}" data-name="{{$name}}" data-url="{{route("panel.file.upload")}}"
        class="js-editor w-100 form-control-file @error($dottedName) is-invalid @enderror">
        {!! $getValue($model,$dottedName) !!}
    </div>
    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>