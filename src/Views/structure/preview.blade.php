{{ html()->modelForm($model)->attribute("disabled","disabled")->open() }}
{!! \Orbitali\Foundations\Helpers\Structure::renderStructure($structure) !!}
{{ html()->form()->close() }}