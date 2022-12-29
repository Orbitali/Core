{{ html()->modelForm($model)->attribute("disabled","disabled")->open() }}
@if(!is_null(html()->model))
    {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($structure) !!}
@else
    @lang(["native.orbitali::structure.preview.empty", "Empty"])
@endif
{{ html()->form()->close() }}

