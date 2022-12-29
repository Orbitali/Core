<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orbitali</title>
    <link rel="shortcut icon" href="{{ asset('vendor/orbitali/images/favicon.png') }}">
    <link rel="stylesheet" id="css-theme" href="{{ mix('/js/vendor.css','vendor/orbitali') }}">
    <link rel="stylesheet" id="css-theme" href="{{ mix('/js/orbitali.core.css', 'vendor/orbitali') }}">
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
    <div class="alert alert-warning alert-dismissible animated fade" data-toast data-delay="2000" aria-live="assertive" role="alert"
        data-notify-position="bottom-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 10000; bottom: 20px; right: 20px; animation-iteration-count: 1;">
            <span data-notify="icon" class="fa fa-exclamation me-1"></span>
            <span data-notify="message">Do not use the development server in a production environment.</span>
    </div>
    @endif
</body>

</html>
