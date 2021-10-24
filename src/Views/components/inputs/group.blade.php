@props(['label', 'for', 'error' => null, 'help-text' => null])
<div class="form-group">
    <label class="d-block" id="{{$for}}_label" for="{{$for}}">
        {{$label}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    {{ $slot }}
    @isset($error)
    <div class="invalid-feedback">{{ $error }}</div>
    @enderror
</div>