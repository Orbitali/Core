<div class="form-group">
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <input id="{{$id}}" type="text" name="{{$name}}" value="{{ $getValue($model,$dottedName) }}"
        class="form-control form-control-alt js-imask @error($dottedName) is-invalid @enderror"
        {{ $mask ? "data-mask=\"$maks\"" : "" }} {{ $regex ? "data-regex=\"$regex\"" : "" }}
        {{ $lazy ? "data-lazy=\"$lazy\"" : "" }} {{ $overwrite ? "data-overwrite=\"$overwrite\"" : "" }}
        {{ $placeholderChar ? "data-placeholder-char=\"$placeholderChar\"" : "" }}>
    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>