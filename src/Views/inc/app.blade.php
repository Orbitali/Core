<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orbitali</title>
    <link rel="shortcut icon" href="{{ asset('vendor/orbitali/images/favicon.png') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('vendor/orbitali/css/orbitali.css') }}">
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
    <script src="{{ asset('vendor/orbitali/js/orbitali.core.js') }}"></script>
    @stack('scripts')
</body>

</html>