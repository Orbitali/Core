<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orbitali</title>
    <link rel="shortcut icon" href="{{ asset('vendor/orbitali/images/favicon.png') }}">
    {{-- <link rel="stylesheet" id="css-theme" href="{{ asset('vendor/orbitali/css/orbitali.css') }}"> --}}
    @stack('styles')
</head>

<body>
    @section('container')
    <div id="page-container" class="page-header-dark main-content-boxed">
        @include("Orbitali::inc.header.index")
        <main id="main-container">
            @include("Orbitali::inc.nav")
            <div class="content @yield('contentClass', 'content-full')">
                @yield("content")
            </div>
        </main>
    </div>
    @show
    <script src="{{ mix('/js/manifest.js','vendor/orbitali') }}"></script>
    <script src="{{ mix('/js/vendor.js','vendor/orbitali') }}"></script>
    <script src="{{ mix('/js/orbitali.core.js','vendor/orbitali') }}"></script>
    @stack('scripts')
    @if(app()->isLocal() || config("app.debug"))
    <div style="position: fixed; bottom: 1rem; right: 1rem; z-index: 9999999;">
        <div class="toast bg-warning-lighter fade hide" data-delay="7000" data-toast role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-fw fa-wrench mr-2" aria-hidden="true"></i>
                <strong class="mr-auto">System</strong>
                <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                Do not use the development server in a production environment.
            </div>
        </div>
    </div>
    @endif
</body>

</html>
