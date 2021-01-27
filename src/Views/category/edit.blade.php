@extends("Orbitali::inc.app")

@section('content')
   {{ html()->modelForm($category, 'PUT',  route('panel.category.update', $category->id))->acceptsFiles()->open() }}
    <div class="block block-rounded block-bordered invisible" data-toggle="appear">
        <div class="block-header block-header-default sticky-top">
            <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
            <div class="block-options">
                {{html()->reset('<i class="fa fa-fw fa-undo"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-light js-tooltip')}}
                {{html()->submit('<i class="fa fa-fw fa-save"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-dual js-tooltip')}}
                <a href="{{route("panel.structure.edit",[$category->structure->id ,"model_id"=>$category->id])}}"
                   class="btn btn-sm btn-light js-tooltip"
                   title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                    <i class="fab fa-fw fa-wpforms"></i>
                </a>
            </div>
        </div>
        <div class="block-content">
            {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($category->structure->data) !!}
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection