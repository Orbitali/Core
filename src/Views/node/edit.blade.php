@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
            <div class="block-options">
                <a href="{{route("panel.structure",[\Orbitali\Foundations\Helpers\Relation::relationFinder($node),$node->id])}}"
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

            {{ html()->modelForm($node, 'PUT',  route('panel.node.update', $node->id))->open() }}
            <div class="form-group">
                {{ html()->label('Passive','status') }}
                {{ html()->radio('status', null,0) }}
                {{ html()->label('Active','status') }}
                {{ html()->radio('status', null,1) }}
                {{ html()->label('Draft','status') }}
                {{ html()->radio('status', null,2) }}
            </div>

            <div class="form-group">
                {{ html()->label('Type','type') }}
                {{ html()->text('type')->class('form-control') }}
            </div>

            <div class="form-group">
                {{ html()->label('Has Detail','has_detail') }}
                {{ html()->checkbox('has_detail') }}
            </div>

            <div class="form-group">
                {{ html()->label('Has Category','has_category') }}
                {{ html()->checkbox('has_category') }}
            </div>

            <div class="form-group">
                {{ html()->label('Searchable','searchable') }}
                {{ html()->checkbox('searchable') }}
            </div>

            {{html()->submit('OK')->class('btn btn-primary')}}
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
