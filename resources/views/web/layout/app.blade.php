<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Partsix - Auto Parts & Car Accessories Shop HTML Template</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web/assets/img/favicon.ico') }}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/glightbox.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap" rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/vendor/bootstrap.min.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">

</head>

<body>

    <!-- Start preloader -->
    @include('web.includes.loader')
    <!-- End preloader -->

    <!-- Start header area -->
    @include('web.includes.header')
    <!-- End header area -->

    <main class="main__content_wrapper">
        <!-- Start breadcrumb section -->
        @include('web.includes.breadcrumb')
        <!-- End breadcrumb section -->
        @yield('content')

        <!-- Start shipping section -->
        @include('web.includes.shipping')
        <!-- End shipping section -->

        <!-- Start shipping section -->
        @include('web.includes.customer')
        <!-- End shipping section -->
    </main>

    <!-- Start footer section -->
    @include('web.includes.footer')
    <!-- End footer section -->

    <!-- Quickview Wrapper -->
    <div class="modal fade" id="examplemodal" tabindex="-1" aria-hidden="true">
        
    </div>
    <!-- Quickview Wrapper End -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>

    <!-- All Script JS Plugins here  -->
    <script type="text/javascript">
        var http_host_js = '{{ url("/") }}';
    </script>
    <script src="{{ asset('web/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('web/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('web/assets/js/vendor/popper.js') }}" defer="defer"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('web/assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/glightbox.min.js') }}"></script>

    <!-- Customscript js -->
    <script src="{{ asset('web/assets/js/script.js') }}"></script>
    <script src="{{ asset('web/assets/js/custom-product.js') }}"></script>

    <script type="text/javascript" src="{{ asset('web/js/jquery.bootstrap-growl.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/parsley.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/comman.js')}}"></script>
    @yield('scripts')

</body>

</html>