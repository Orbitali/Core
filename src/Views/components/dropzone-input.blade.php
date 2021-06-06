<div class="form-group">
    <label class="d-block" id="{{$id}}_label" for="{{$id}}">
        {{$title}}
        @if($attributes->has("required"))
        <span class="text-danger">*</span>
        @endif
    </label>
    <div id="{{$id}}" class="js-dropzone w-100 form-control-file" data-name="{{$name}}"
        data-url="{{route("panel.file.upload")}}" {{$multiple?"data-multiple":""}} data-max-files="{{$maxFiles}}"
        data-files="{{$getFiles($model,$dottedName)}}">
    </div>
</div>