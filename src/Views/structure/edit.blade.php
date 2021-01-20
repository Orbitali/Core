@extends("Orbitali::inc.app")
@section('contentClass','content-narrow')
@section('content')
    {{ html()->form('PUT')->open() }}
    {{ html()->input()->type("hidden")->name("data")->id("structure_form_data") }}
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default sticky-top">
            <h3 class="block-title">@lang(['native.panel.structure.title','Yapılar'])</h3>
            <div class="block-options">
                {{html()->reset('<i class="fa fa-fw fa-undo"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-light js-tooltip')}}
                {{html()->submit('<i class="fa fa-fw fa-save"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-dual js-tooltip')}}
            </div>
        </div>
        
        <div class="block-content">
            <div id="visual_desinger" class="row">
                <div id="design" class="col-sm-9 pr-sm-1 px-0 pb-7 gu-unselectable" data-data='@json($structure)'>
                </div>

                <div id="elements" class="col-sm-3 pl-sm-1 px-0 gu-unselectable" data-data='@json($children)'>
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection

@push('scripts')
    <template id="block_template">
        <div class="block block-rounded my-2 mx-0 overflow-hidden block-mode-hidden">
            <div class="block-header block-header-default py-1">
                <h3 class="block-title"></h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option"><i class="fa fa-cog"></i></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>
            <div class="block-content p-2"></div>
        </div>
    </template>
@endpush