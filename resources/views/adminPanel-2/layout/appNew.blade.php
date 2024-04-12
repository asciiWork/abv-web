<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <title>{{env("APP_NAME")}} {{ (isset($page_title))?' | '.$page_title:'' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/favicon.ico') }}">
    <!--plugins-->
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" >
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">
    <!-- loader-->
      <link href="{{ asset('public/admin-theme/assetsNew-2/css/pace.min.css')}}" rel="stylesheet">
      <script src="{{ asset('public/admin-theme/assetsNew-2/js/pace.min.js')}}"></script>
    <!--Styles-->
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsNew-2/css/icons.css')}}" >

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/dark-theme.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/semi-dark-theme.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/minimal-theme.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/shadow-theme.css')}}" rel="stylesheet">
    
    @yield('styles')

</head>

<body>
    @include('adminPanel-2.includes.header')

        @include('adminPanel-2.includes.sidebar')
        <!--start main content-->
        <main class="page-content">
            @include('adminPanel-2.includes.breadcrumb')
            <!-- FLASH MESSAGE -->
            @include('adminPanel-2.includes.flashMSG')
            @yield('content')
        </main>
        <!--end main content-->
        <!--start overlay-->
        <div class="overlay btn-toggle-menu"></div>
        <!--end overlay-->

        <!-- Search Modal -->
        @include('adminPanel-2.includes.searchmodal')

        <!--start theme customization-->
        @include('adminPanel-2.includes.themecustomization')


        {!! Form::open(['method' => 'DELETE','id' => 'global_delete_form']) !!}
        {!! Form::hidden('id', 0,['id' => 'delete_id']) !!}
        {!! Form::close() !!}

        

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    <!--plugins-->
   <script src="{{ asset('public/admin-theme/assetsNew-2/js/jquery.min.js')}}"></script>
   <script src="{{ asset('public/admin-theme/assetsNew-2/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
   <script src="{{ asset('public/admin-theme/assetsNew-2/plugins/metismenu/js/metisMenu.min.js')}}"></script>
   <script src="{{ asset('public/admin-theme/assetsNew-2/plugins/simplebar/js/simplebar.min.js')}}"></script>
   <script src="{{ asset('public/admin-theme/assetsNew-2/plugins/apex/apexcharts.min.js')}}"></script>
   <script src="{{ asset('public/admin-theme/assetsNew-2/js/index.js')}}"></script>
    <!--BS Scripts-->
    <script src="{{ asset('public/admin-theme/assetsNew-2/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew-2/js/main.js')}}"></script>
    @yield('scripts')
  </body>
</html>