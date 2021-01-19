@extends("Orbitali::inc.app")

@section('content')
   {{ html()->modelForm($page, 'PUT',  route('panel.page.update', $page->id))->acceptsFiles()->open() }}
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default sticky-top">
            <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
            <div class="block-options">
                {{html()->reset('<i class="fa fa-fw fa-undo"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-light js-tooltip')}}
                {{html()->submit('<i class="fa fa-fw fa-save"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-dual js-tooltip')}}
                <a href="{{route("panel.structure.edit",[\Orbitali\Foundations\Helpers\Relation::relationFinder($page),$page->id])}}"
                   class="btn btn-sm btn-light js-tooltip"
                   title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                    <i class="fab fa-fw fa-wpforms"></i>
                </a>
            </div>
        </div>
        
        <div class="block-content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->getMessages() as $key => $error)
                            <li>{{ implode(', ',$error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($structure->data) !!}
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection