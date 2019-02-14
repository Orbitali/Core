<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orbitali</title>

    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">

    <link rel="stylesheet" id="css-main"
          href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-theme" href="{{ asset('vendor/orbitali/css/dashmix.css') }}">
    @yield('styles')
</head>
<body>
<div id="page-container" class="page-header-dark main-content-boxed">
    @include("Orbitali::inc.header.index")
    <main id="main-container">
        @include("Orbitali::inc.nav")
        <div class="content content-full">
            @yield("content")
        </div>
    </main>
</div>
<script src="{{ asset('vendor/orbitali/js/dashmix.app.js') }}"></script>
<script src="{{ asset('vendor/orbitali/js/laravel.app.js') }}"></script>
@yield('scripts')
</body>
</html>

