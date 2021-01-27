@extends("Orbitali::inc.app")

@section('content')
    {{ html()->form('POST', route('panel.category.store'))->open() }} 
    {{ html()->input()->type("hidden")->name("data")->id("category_form_data") }}
    <div class="block block-rounded block-bordered block-mode-loading-refresh invisible" data-toggle="appear" >
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.category.title','Kategoriler'])</h3>
            <div class="block-options">
                {{html()->reset('<i class="fa fa-fw fa-undo"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-light js-tooltip')}}
                {{html()->submit('<i class="fa fa-fw fa-save"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-dual js-tooltip')}}
                <a href="{{route("panel.node.category.create",$node)}}"
                   class="btn btn-sm btn-light js-tooltip"
                   title="@lang(['native.panel.category.add','Yeni kategori ekle'])">
                    <i class="fas fa-fw fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="block-content">
            <div id="category_desinger" class="row">
                <div id="design" class="col-12 pr-sm-1 px-0 pb-7 gu-unselectable" data-data='@json($categories)'>
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection

@push('scripts')
<template id="block_template">
    <div class="block block-rounded my-2 mx-0 overflow-hidden">
        <div class="block-header block-header-default py-1">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-configure><i class="fa fa-cog"></i></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content p-2 pl-4"></div>
    </div>
</template>
@endpush
