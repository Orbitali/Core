@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.node.title','Düğümler'])</h3>
            <div class="block-options">
                <a href="{{route("panel.structure",[relationFinder($node),$node->id])}}"
                   class="btn btn-sm js-tooltip"
                   title="@lang(['native.panel.node.structure','Düğüm yapısını düzenle'])">
                    <i class="fab fa-fw fa-wpforms"></i>
                </a>
            </div>
        </div>
        <div class="block-content">
            {{ Form::model($node, ['route' => ['panel.node.update', $node->id], 'method' => 'PUT']) }}
            <div class="form-group">
                {{ Form::label('status', 'Passive') }}
                {{ Form::radio('status', '0') }}
                {{ Form::label('status', 'Active') }}
                {{ Form::radio('status', '1') }}
                {{ Form::label('status', 'Draft') }}
                {{ Form::radio('status', '2') }}
            </div>

            <div class="form-group">
                {{ Form::label('type', 'Type') }}
                {{ Form::text('type', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('has_detail', 'Has Detail') }}
                {{ Form::hidden('has_detail',0) }}
                {{ Form::checkbox('has_detail') }}
            </div>

            <div class="form-group">
                {{ Form::label('has_category', 'Has Category') }}
                {{ Form::hidden('has_category',0) }}
                {{ Form::checkbox('has_category') }}
            </div>

            <div class="form-group">
                {{ Form::label('searchable', 'Searchable') }}
                {{ Form::hidden('searchable',0) }}
                {{ Form::checkbox('searchable') }}
            </div>

            {{ Form::submit('OK', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
