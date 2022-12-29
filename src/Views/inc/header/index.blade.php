{{-- Header --}}
<header id="page-header">
    {{-- Header Content --}}
    <div class="content-header">
        {{-- Left Section --}}
        <div class="d-flex align-items-center">
            {{-- Logo --}}
            <a class="link-fx fs-3 text-white" href="{{route('panel.index')}}">
                <span class="text-white">Orbital</span><span class="text-white-75">i</span>
            </a>
            {{-- END Logo --}}
        </div>
        {{-- END Left Section --}}
        {{-- Right Section --}}
        <div>
            @auth
            @include("Orbitali::inc.header.user")
            @endauth
        </div>
        {{-- END Right Section --}}
    </div>
    {{-- END Header Content --}}

    {{-- Header Loader --}}
    {{-- Please check out the Loaders page under Components category to see examples of showing/hiding it --}}
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-spinner fa-spin text-white" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    {{-- END Header Loader --}}
</header>
{{-- END Header --}}
