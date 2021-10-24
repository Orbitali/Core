@props(['label', 'for', 'error' => null, 'help-text' => null])
<div class="form-group">
    <label class="d-block" id="{{$for}}_label" for="{{$for}}">
        {{$label}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    {{ $slot }}
    @error($for)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>