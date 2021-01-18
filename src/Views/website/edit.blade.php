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
                <label class="d-block">@lang(['native.status','Durum'])</label>
                <div class="custom-control custom-control-success custom-control-inline custom-radio">
                    {{ html()->radio('status', null,1)->id("active")->class("custom-control-input") }}
                    <label class="custom-control-label" for="active">@lang(['native.active','Aktif'])</label>
                </div>
                <div class="custom-control custom-control-danger custom-control-inline custom-radio">
                    {{ html()->radio('status', null,0)->id("passive")->class("custom-control-input") }}
                    <label class="custom-control-label" for="passive">@lang(['native.passive','Pasif'])</label>
                </div>
                <div class="custom-control custom-control-dark custom-control-inline custom-radio">
                    {{ html()->radio('status', null,2)->id("draft")->class("custom-control-input") }}
                    <label class="custom-control-label" for="draft">@lang(['native.draft','Taslak'])</label>
                </div>
            </div>

            <div class="form-group">
                {{ html()->label(trans(['native.name','İsim']),'name') }}
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

