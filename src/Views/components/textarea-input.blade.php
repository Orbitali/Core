<div class="form-group">
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <textarea id="{{$id}}" name="{{$name}}"
        class="form-control w-100 form-control-alt @error($dottedName) is-invalid @enderror"
        {{ $rows ? "rows=$rows" : "" }} {{ $cols ? "cols=$cols" : "" }}
        {{ $autoHeight ? 'data-auto-height="true"' : "" }}>{{ $getValue($model,$dottedName) }}</textarea>
    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>