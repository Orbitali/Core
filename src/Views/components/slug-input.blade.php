<div class="form-group">
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <input id="{{$id}}" type="text" name="{{$name}}" value="{{ $getValue($model,$dottedName) }}"
        class="form-control form-control-alt js-imask @error($dottedName) is-invalid @enderror" data-slug="{{$slug}}">
    @error($dottedName)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>