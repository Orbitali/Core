@extends("Orbitali::inc.app")

@section('content')
    <div class="block block-rounded block-bordered invisible" data-toggle="appear">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang(['native.panel.category.title','Kategoriler'])</h3>
            <div class="block-options">
                <a href="{{route("panel.category.create")}}"
                   class="btn btn-sm btn-light js-tooltip"
                   title="@lang(['native.panel.category.add','Yeni kategori ekle'])">
                    <i class="fas fa-fw fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="block-content">
            <div id="visual_desinger" class="row">
                <div id="category" class="col-sm-6 pr-sm-1 px-0 pb-7 gu-unselectable" data-data='@json($categories)'>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<template id="block_template">
    <div class="block block-rounded my-2 mx-0 overflow-hidden block-mode-hidden">
        <div class="block-header block-header-default py-1">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-configure><i class="fa fa-cog"></i></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content p-2"></div>
    </div>
</template>
@endpush
