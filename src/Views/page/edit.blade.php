@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
            <div class="block-options">
                <a href="{{route("panel.structure.edit",[\Orbitali\Foundations\Helpers\Relation::relationFinder($page),$page->id])}}"
                   class="btn btn-sm js-tooltip"
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
                            <li>{{ $key}}.{{ implode(', ',$error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ html()->modelForm($page, 'PUT',  route('panel.page.update', $page->id))->open() }}
            {!! \Orbitali\Foundations\Helpers\Structure::renderStructure($page->structure->data) !!}
            {{html()->submit('OK')->class('btn btn-primary')}}
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
