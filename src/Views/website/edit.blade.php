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
            {{ html()->modelForm($website, 'PUT',  route('panel.website.update', $website->id))->open() }}
            <div class="form-group">
                {{ html()->label('Passive','status') }}
                {{ html()->radio('status', null,0) }}
                {{ html()->label('Active','status') }}
                {{ html()->radio('status', null,1) }}
                {{ html()->label('Draft','status') }}
                {{ html()->radio('status', null,2) }}
            </div>
            <div class="form-group">
                {{ html()->label('Name','name') }}
                {{ html()->text('name')->class('form-control') }}
            </div>

            <div class="form-group">
                {{ html()->label('Has SSL','ssl') }}
                {{ html()->checkbox('ssl') }}
            </div>

            <div class="form-group">
                {{ html()->label('Domain','domain') }}
                {{ html()->text('domain')->class('form-control') }}
            </div>


            <div class="form-group">
                {{ html()->label('Langs','languages[]') }}
                {{ html()->select('languages[]', $languages,$website->languages)->class('js-select2 form-control')->multiple() }}
            </div>
            {{html()->submit('OK')->class('btn btn-primary')}}
            {{ html()->form()->close() }}
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
