<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{env("APP_NAME")}} {{ (isset($page_title))?' | '.$page_title:'' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/favicon.ico') }}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsNew/vendor/daterangepicker/daterangepicker.css') }}">

        <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.css') }}">

         <!-- Datatables css -->
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet"
            type="text/css" />

        <!-- Theme Config Js -->
        <script src="{{ asset('public/admin-theme/assetsNew/js/config.js') }}"></script>

        <!-- App css -->
        <link href="{{ asset('public/admin-theme/assetsNew/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{ asset('public/admin-theme/assetsNew/css/icons.min.css?1231') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/admin-theme/assetsNew/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        @yield('styles')

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('adminPanel.includes.header')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        @include('adminPanel.includes.sidebar')


            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @include('adminPanel.includes.breadcrumb')

                        <!-- FLASH MESSAGE -->
                        @include('adminPanel.includes.flashMSG')

                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- content -->

            @include('adminPanel.includes.footer')

            {!! Form::open(['method' => 'DELETE','id' => 'global_delete_form']) !!}
            {!! Form::hidden('id', 0,['id' => 'delete_id']) !!}
            {!! Form::close() !!}

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('public/admin-theme/assetsNew/js/vendor.min.js') }}"></script>
    
    <!-- Datatables js -->
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src=" {{ asset('public/admin-theme/assetsNew/vendor/select2/js/select2.min.js') }}"></script>
    
    <!-- Toast js -->
    <script src="{{ asset('public/admin-theme/assetsNew/vendor/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew/js/pages/toastr.init.js') }}"></script>
    
    <script src="{{ asset('public/admin-theme/assetsNew/js/app.min.js') }}"></script>

    @yield('scripts')
</body>

</html>