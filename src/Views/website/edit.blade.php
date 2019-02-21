@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.website.title','Websiteleri'])</h3>
            <div class="block-options">
                <button type="button"
                        class="btn btn-sm btn-success js-tooltip"
                        title="@lang(['native.panel.website.add','Yeni websitesi ekle'])">
                    <i class="fas fa-fw fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            {{ Form::model($website, ['route' => ['panel.website.update', $website->id], 'method' => 'PUT']) }}
            <div class="form-group">
                {{ Form::label('status', 'Passive') }}
                {{ Form::radio('status', '0') }}
                {{ Form::label('status', 'Active') }}
                {{ Form::radio('status', '1') }}
            </div>
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('ssl', 'Has SSL') }}
                {{ Form::checkbox('ssl') }}
            </div>

            <div class="form-group">
                {{ Form::label('domain', 'Domain') }}
                {{ Form::text('domain', null, array('class' => 'form-control')) }}
            </div>


            <div class="form-group">
                {{ Form::label('languages[]', 'Langs') }}
                {{ Form::select('languages[]', $languages, $website->languages,['class' => ' js-select2 form-control','multiple']) }}
            </div>

            {{ Form::submit('OK', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        jQuery('.js-select2:not(.js-select2-enabled)').each((index, element) => {
            let el = jQuery(element);
            el.addClass('js-select2-enabled').select2({
                placeholder: el.data('placeholder') || false
            });
        });
    </script>
@endsection
