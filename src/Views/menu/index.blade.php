@extends("Orbitali::inc.app")

@push('styles')
<script>
    {!! Session::get('script') !!}
</script>
@endpush

@section('content')
{{ html()->form('POST', route('panel.menu.store'))->open() }}
{{ html()->input()->type("hidden")->name("data")->id("menu_form_data") }}
<div class="block block-rounded block-bordered block-mode-loading-refresh invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 class="block-title">@lang(['native.panel.menu.title','Menüler'])</h3>
        <div class="block-options">
            {{html()->reset('<i class="fa fa-fw fa-undo"
                aria-hidden="true"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm
            btn-light js-tooltip')}}
            {{html()->submit('<i class="fa fa-fw fa-save"
                aria-hidden="true"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm
            btn-dual js-tooltip')}}
            <a href="{{route('panel.menu.create')}}" class="btn btn-sm btn-light js-tooltip"
                title="@lang(['native.panel.menu.add','Yeni menü ekle'])">
                <i class="fas fa-fw fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <div id="menu_desinger" class="row">
            <div id="design" class="col-12 pr-sm-1 px-0 pb-7 gu-unselectable" data-data='@json($menus)'>
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
                <div class="btn-group">
                    <a class="btn btn-sm btn-block-option" data-update><i class="fa fa-pen" aria-hidden="true"></i></a>
                    <button class="btn btn-sm btn-block-option js-destroy" data-destroy>
                        <i class="fa fa-times" aria-hidden="true"></i>
                        {{html()->form("DELETE",route("panel.menu.destroy", "@"))->class("d-none")}}
                    </button>
                    <button type="button" class="btn btn-sm btn-block-option" data-toggle="block-option"
                        data-action="content_toggle"></button>
                </div>
            </div>
        </div>
        <div class="block-content p-2 pl-4"></div>
    </div>
</template>
<template id="block_remove_form_template" data-title="@lang(['native.are.you.sure'," Emin misiniz ?"])">
    <p class="mb-1">@lang(['native.wont.recover','İşlemi geri getiremeyeceksiniz'])</p>
    <div class="d-flex justify-content-between">
        <button data-submit class="btn btn-sm btn-alt-danger flex-grow-1 mr-1">@lang(['native.yes','Evet'])</button>
        <button data-close class="btn btn-sm btn-light flex-grow-1 ml-1">@lang(['native.cancel','İptal'])</button>
    </div>
</template>
<template id="block_edit_modal">
    <div class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Menu Editor</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content p-0">
                        <iframe class="border-0 w-100" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
@endpush