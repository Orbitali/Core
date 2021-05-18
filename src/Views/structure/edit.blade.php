@extends("Orbitali::inc.app")
@section('contentClass','content-narrow')
@section('content')
{{ html()->form('PUT', route('panel.structure.update', $id))->open() }}
{{ html()->input()->type("hidden")->name("data")->id("structure_form_data") }}
<div class="block block-rounded block-bordered block-mode-loading-refresh invisible" data-toggle="appear">
    <div class="block-header block-header-default sticky-top">
        <h3 class="block-title">@lang(['native.panel.structure.title','Yapılar'])</h3>
        <div class="block-options">
            {{html()->a(route("panel.structure.preview",$id))->html('<i class="fa fa-fw fa-eye" aria-hidden="true"></i>')->attribute("title",trans(["native.preview","Preview"]))->class('btn btn-sm btn-light js-tooltip')->attribute("data-preview")}}
            {{html()->reset('<i class="fa fa-fw fa-undo" aria-hidden="true"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm btn-light js-tooltip')}}
            {{html()->submit('<i class="fa fa-fw fa-save" aria-hidden="true"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm btn-dual js-tooltip')}}
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
                <button type="button" class="btn-block-option" data-configure><i class="fa fa-cog"
                        aria-hidden="true"></i></button>
                <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"></button>
            </div>
        </div>
        <div class="block-content p-2"></div>
    </div>
</template>
<template id="block_configure_modal">
    <div class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Block Configuration</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-12">
                                <div id="p_title" class="form-group">
                                    <label class="d-block" id="title_label" for="title">Title</label>
                                    <input class="form-control form-control-alt" id="title" type="text">
                                </div>
                                <div id="p_name" class="form-group">
                                    <label class="d-block" id="name_label" for="name">Name</label>
                                    <input class="form-control form-control-alt" id="name" type="text">
                                </div>
                                <div id="p_type" class="form-group d-none">
                                    <label class="d-block" id="type_label" for="type">Type</label>
                                    <select id="type" class="w-100 js-select2" data-placeholder="Type">
                                        <option value="text">Text</option>
                                        <option value="email">Email</option>
                                        <option value="file">File</option>
                                        <option value="select">Select</option>
                                        <option value="textarea">Text Area</option>
                                        <option value="url">Url</option>
                                        <option value="slug">Slug</option>
                                        <option value="mask">Masked Input</option>
                                        <option value="radio">Radio Input</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="editor">Editor</option>
                                    </select>
                                </div>
                                <div id="p_rules" class="form-group">
                                    <label class="d-block" id="rules_label" for="rules">Rules</label>
                                    <select id="rules" class="w-100 js-select2" data-prevent-sort=1
                                        data-placeholder="Rules" data-tags='1' data-token-separators='["|", " "]'
                                        multiple>
                                        <option value="accepted">accepted</option>
                                        <option value="active_url">active_url</option>
                                        <option value="after:date" disabled="disabled">after:date</option>
                                        <option value="after_or_equal:date" disabled="disabled">after_or_equal:date
                                        </option>
                                        <option value="alpha">alpha</option>
                                        <option value="alpha_dash">alpha_dash</option>
                                        <option value="alpha_num">alpha_num</option>
                                        <option value="array">array</option>
                                        <option value="bail">bail</option>
                                        <option value="before:date" disabled="disabled">before:date</option>
                                        <option value="before_or_equal:date" disabled="disabled">before_or_equal:date
                                        </option>
                                        <option value="between:min,max" disabled="disabled">between:min,max</option>
                                        <option value="boolean">boolean</option>
                                        <option value="checkbox">checkbox</option>
                                        <option value="confirmed">confirmed</option>
                                        <option value="date">date</option>
                                        <option value="date_equals:date" disabled="disabled">date_equals:date</option>
                                        <option value="date_format:format" disabled="disabled">date_format:format
                                        </option>
                                        <option value="different:field" disabled="disabled">different:field</option>
                                        <option value="digits:value" disabled="disabled">digits:value</option>
                                        <option value="digits_between:min,max" disabled="disabled">
                                            digits_between:min,max</option>
                                        <option value="dimensions">dimensions</option>
                                        <option value="distinct">distinct</option>
                                        <option value="email">email</option>
                                        <option value="exists:table,column" disabled="disabled">exists:table,column
                                        </option>
                                        <option value="file">file</option>
                                        <option value="filled">filled</option>
                                        <option value="gt:field" disabled="disabled">gt:field</option>
                                        <option value="gte:field" disabled="disabled">gte:field</option>
                                        <option value="image">image</option>
                                        <option value="in:foo,bar,..." disabled="disabled">in:foo,bar,...</option>
                                        <option value="in_array:anotherfield.*" disabled="disabled">
                                            in_array:anotherfield.*</option>
                                        <option value="integer">integer</option>
                                        <option value="ip">ip</option>
                                        <option value="ipv4">ipv4</option>
                                        <option value="ipv6">ipv6</option>
                                        <option value="json">json</option>
                                        <option value="lt:field" disabled="disabled">lt:field</option>
                                        <option value="lte:field" disabled="disabled">lte:field</option>
                                        <option value="max:value" disabled="disabled">max:value</option>
                                        <option value="mimetypes:text/plain,..." disabled="disabled">
                                            mimetypes:text/plain,...</option>
                                        <option value="mimes:foo,bar,..." disabled="disabled">mimes:foo,bar,...</option>
                                        <option value="min:value" disabled="disabled">min:value</option>
                                        <option value="not_in:foo,bar,..." disabled="disabled">not_in:foo,bar,...
                                        </option>
                                        <option value="not_regex:pattern" disabled="disabled">not_regex:pattern</option>
                                        <option value="nullable">nullable</option>
                                        <option value="numeric">numeric</option>
                                        <option value="present">present</option>
                                        <option value="regex:pattern" disabled="disabled">regex:pattern</option>
                                        <option value="required">required</option>
                                        <option value="required_if:anotherfield,value,..." disabled="disabled">
                                            required_if:anotherfield,value,...</option>
                                        <option value="required_unless:anotherfield,value,..." disabled="disabled">
                                            required_unless:anotherfield,value,...</option>
                                        <option value="required_with:foo,bar,..." disabled="disabled">
                                            required_with:foo,bar,...</option>
                                        <option value="required_with_all:foo,bar,..." disabled="disabled">
                                            required_with_all:foo,bar,...</option>
                                        <option value="required_without:foo,bar,..." disabled="disabled">
                                            required_without:foo,bar,...</option>
                                        <option value="required_without_all:foo,bar,..." disabled="disabled">
                                            required_without_all:foo,bar,...</option>
                                        <option value="same:field" disabled="disabled">same:field</option>
                                        <option value="size:value" disabled="disabled">size:value</option>
                                        <option value="starts_with:foo,bar,..." disabled="disabled">
                                            starts_with:foo,bar,...</option>
                                        <option value="string">string</option>
                                        <option value="timezone">timezone</option>
                                        <option value="unique:table,column,except,idColumn" disabled="disabled">
                                            unique:table,column,except,idColumn</option>
                                        <option value="url">url</option>
                                        <option value="uuid">uuid</option>
                                    </select>
                                </div>
                                <div id="p_multiple" class="form-group">
                                    <div
                                        class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                                        <input class="custom-control-input" id="multiple" type="checkbox">
                                        <label class="custom-control-label" id="multiple_label"
                                            for="multiple">Multiple</label>
                                    </div>
                                </div>
                                <div id="p_mask" class="form-group">
                                    <label class="d-block" id="mask_label" for="mask">Mask</label>
                                    <input class="form-control form-control-alt" id="mask" type="text">
                                </div>
                                <div id="p_overwrite" class="form-group">
                                    <div
                                        class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                                        <input class="custom-control-input" id="overwrite" type="checkbox">
                                        <label class="custom-control-label" id="overwrite_label"
                                            for="overwrite">Overwrite</label>
                                    </div>
                                </div>
                                <div id="p_auto-height" class="form-group">
                                    <div
                                        class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                                        <input class="custom-control-input" id="auto-height" type="checkbox">
                                        <label class="custom-control-label" id="auto-height_label"
                                            for="auto-height">Auto Height</label>
                                    </div>
                                </div>
                                <div id="p_prevent-sort" class="form-group">
                                    <div
                                        class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto">
                                        <input class="custom-control-input" id="prevent-sort" type="checkbox">
                                        <label class="custom-control-label" id="prevent-sort_label"
                                            for="prevent-sort">Prevent Sort</label>
                                    </div>
                                </div>
                                <div id="p_placeholderChar" class="form-group">
                                    <label class="d-block" id="mask_label" for="placeholderChar">Placeholder
                                        Char</label>
                                    <input class="form-control form-control-alt" id="placeholderChar" type="text">
                                </div>
                                <div id="p_content" class="form-group">
                                    <label class="d-block" id="content_label" for="content">Content</label>
                                    <textarea class="form-control form-control-alt" id="content" rows="5"></textarea>
                                </div>
                                <div id="p_data-source" class="form-group">
                                    <label class="d-block" id="data-source_label" for="data-source">Data Source</label>
                                    <select id="data-source" class="w-100 js-select2" data-placeholder="Data Source"
                                        data-tags='1'>
                                        @foreach ((new \Orbitali\Foundations\Datasources\Datasources())->source() as
                                        $source)
                                        <option value="{{$source}}">{{$source}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($mode)
                                <div id="p_show-on-list" class="form-group form-row">
                                    <div class="col-4">
                                        <div
                                            class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto mt-1">
                                            <input class="custom-control-input" id="show-on-list" type="checkbox">
                                            <label class="custom-control-label" id="show-on-list_label"
                                                for="show-on-list">Show On List</label>
                                        </div>
                                        <div
                                            class="form-control-file custom-control custom-control-inline custom-checkbox mb-1 w-auto mt-1">
                                            <input class="custom-control-input" id="show-on-list-empty-header"
                                                type="checkbox">
                                            <label class="custom-control-label" id="show-on-list-empty-header_label"
                                                for="show-on-list-empty-header">Empty Header</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="d-block" id="show-on-list-order_label"
                                            for="show-on-list-order">Order</label>
                                        <input class="form-control form-control-alt" id="show-on-list-order"
                                            type="text">
                                    </div>
                                    <div class="col-4">
                                        <label class="d-block" id="show-on-list-prefix_label"
                                            for="show-on-list-prefix">Prefix</label>
                                        <input class="form-control form-control-alt" id="show-on-list-prefix"
                                            type="text">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
@endpush