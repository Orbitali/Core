@extends("Orbitali::inc.app")

@section('content')
{{ html()->modelForm($formEntry, 'GET')->open() }}
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default sticky-top">
        <h3 class="block-title">@lang(['native.panel.form.title','Formlar'])</h3>
        <div class="block-options">
            @can('update',\Orbitali\Http\Models\Structure::class)
            <a href="{{route("panel.structure.edit",[$formEntry->structure->id,"model_id"=>$formEntry->id])}}"
                class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                <i class="fab fa-fw fa-wpforms" aria-hidden="true"></i>
            </a>
            @endcan
        </div>
    </div>
    <div class="block-content">
        {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($formEntry->structure->data) !!}
    </div>
</div>
{{ html()->form()->close() }}
@endsection