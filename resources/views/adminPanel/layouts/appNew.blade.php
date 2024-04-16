<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abv Tools | Management System</title>

    <!--plugins-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/fav.ico') }}">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/pace.min.js') }}"></script>
    <!--Styles-->
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsRoksyn/css/icons.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/semi-dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/minimal-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/shadow-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsRoksyn/plugins/notifications/css/lobibox.min.css')}}">
    @yield('adminStyle')
</head>

<body>

    <!--start header-->
    @include('adminPanel.includes.header')
    <!--end header-->


    <!--start sidebar-->
    @include('adminPanel.includes.sidebar')
    <!--end sidebar-->


    <!--start main content-->
    <main class="page-content">
        @include('adminPanel.includes.breadcrumb')
        @yield('content')

    </main>
    <!--end main content-->


    <!--start overlay-->
    <div class="overlay btn-toggle-menu"></div>
    <!--end overlay-->

    <!--start theme customization-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="ThemeCustomizer" aria-labelledby="ThemeCustomizerLable">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="ThemeCustomizerLable">Theme Customizer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
                <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2" checked="">
                <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
                <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
                <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ShadowTheme" value="option4">
                <label class="form-check-label" for="ShadowTheme">Shadow Theme</label>
            </div>

        </div>
    </div>
    <!--end theme customization-->


    <!--plugins-->
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <!--BS Scripts-->
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/main.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/notifications/js/notifications.min.js')}}"></script>
    @yield('adminscript')
</body>

</html>