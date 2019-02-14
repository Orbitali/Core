{{-- Header --}}
<header id="page-header">
    {{-- Header Content --}}
    <div class="content-header">
        {{-- Left Section --}}
        <div class="d-flex align-items-center">
            {{-- Logo --}}
            <a class="link-fx font-size-lg font-w600 text-white" href="#">
                <span class="text-white">Orbital</span><span class="text-white-75">i</span>
            </a>
            {{-- END Logo --}}

            {{-- Open Search Section --}}
            {{-- Layout API, functionality initialized in Template._uiApiLayout() --}}
            <button type="button" class="btn btn-dual ml-2" data-toggle="layout" data-action="header_search_on">
                <i class="si si-magnifier"></i>
            </button>
            {{-- END Open Search Section --}}
        </div>
        {{-- END Left Section --}}
        {{-- Right Section --}}
        <div>
            @include("Orbitali::inc.header.user")
        </div>
        {{-- END Right Section --}}
    </div>
    {{-- END Header Content --}}

    {{-- Header Search --}}
    <div id="page-header-search" class="overlay-header bg-header-dark">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group">
                    <div class="input-group-prepend">
                        {{-- Layout API, functionality initialized in Template._uiApiLayout() --}}
                        <button type="button" class="btn btn-primary" data-toggle="layout"
                                data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search your websites.."
                           id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    {{-- END Header Search --}}

    {{-- Header Loader --}}
    {{-- Please check out the Loaders page under Components category to see examples of showing/hiding it --}}
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-spinner fa-spin text-white"></i>
            </div>
        </div>
    </div>
    {{-- END Header Loader --}}
</header>
{{-- END Header --}}
