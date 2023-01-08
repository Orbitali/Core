{{ html()->modelForm($model, 'PUT',  route($update_route, $model))->acceptsFiles()->open() }}
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default sticky-top">
        <h3 class="block-title">{{$title}}</h3>
        <div class="block-options">
            @if(!html()->readonly)
            {{html()->reset('<i class="fa fa-fw fa-undo" aria-hidden="true"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-alt-secondary js-tooltip')}}
            {{html()->submit('<i class="fa fa-fw fa-save" aria-hidden="true"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-alt-secondary btn-alt-secondary js-tooltip')}}
            @endif
            @can('update',\Orbitali\Http\Models\Structure::class)
            <a href="{{route('panel.structure.edit',[$model->structure,'model_id'=>$model->id])}}"
                class="btn btn-sm btn-alt-secondary js-tooltip"
                title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                <i class="fab fa-fw fa-wpforms" aria-hidden="true"></i>
            </a>
            @endcan
        </div>
    </div>
    <div class="block-content">
        {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($model->structure->data) !!}
    </div>
</div>
{{ html()->form()->close() }}
