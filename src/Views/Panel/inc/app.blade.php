<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--<link rel="icon" href="{{ config('orbitali.assetPath') . "img/icon.ico" }}" type="image/x-icon"/>-->

    <!-- Fonts and icons -->
    <script src="{{ config('orbitali.assetPath') . "js/plugin/webfont/webfont.min.js" }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ config('orbitali.assetPath') . "css/fonts.min.css" }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ config('orbitali.assetPath') . "css/bootstrap.min.css" }}">
    <link rel="stylesheet" href="{{ config('orbitali.assetPath') . "css/atlantis.min.css" }}">
</head>
<body>
<div class="wrapper">
    <!-- Header -->
    @include('panel::inc.header')
    <!-- End Header -->

    <!-- Sidebar -->
    @include('panel::inc.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="content">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright ml-auto">
                    2019, All right reserved.
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ config('orbitali.assetPath') . "js/core/jquery.3.2.1.min.js" }}"></script>
<script src="{{ config('orbitali.assetPath') . "js/core/popper.min.js" }}"></script>
<script src="{{ config('orbitali.assetPath') . "js/core/bootstrap.min.js" }}"></script>
<!-- jQuery UI -->
<script src="{{ config('orbitali.assetPath') . "js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js" }}"></script>
<script src="{{ config('orbitali.assetPath') . "js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js" }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ config('orbitali.assetPath') . "js/plugin/jquery-scrollbar/jquery.scrollbar.min.js" }}"></script>
<!-- jQuery Sparkline -->
<script src="{{ config('orbitali.assetPath') . "js/plugin/jquery.sparkline/jquery.sparkline.min.js" }}"></script>
<!-- Bootstrap Notify -->
<script src="{{ config('orbitali.assetPath') . "js/plugin/bootstrap-notify/bootstrap-notify.min.js" }}"></script>
<!-- Atlantis JS -->
<script src="{{ config('orbitali.assetPath') . "js/atlantis.min.js" }}"></script>
</body>
</html>