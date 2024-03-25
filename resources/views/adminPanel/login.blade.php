<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ABV Tool - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/fav.ico') }}">
    <!-- Theme Config Js -->
    <script src="{{ asset('public/admin-theme/assetsNew/js/config.js') }}" ></script>
    <!-- App css -->
    <link href="{{ asset('public/admin-theme/assetsNew/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('public/admin-theme/assetsNew/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-lg-6">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-column h-100">
                                        <div class="auth-brand p-4">
                                            <a href="/" class="logo-dark" style="text-align: center;">
                                                <img src="{{ asset('public/web/assets/img/abv.png') }}" alt="dark logo" height="100">
                                            </a>
                                        </div>
                                        <div class="p-4 my-auto">
                                            
                                            <h4 class="fs-20">Sign In</h4>
                                            <p class="text-muted mb-3">Enter your email address and password to access account. </p>
                                             @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <!-- form -->
                                            <form  action="{{route('admin_login_post')}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="emailaddress" class="form-label">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" required="" name="email" placeholder="Enter your email" value="{{old('email')}} ">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">

                                                </div>

                                                <div class="mb-0 text-start">
                                                    <button class="btn btn-soft-primary w-100" type="submit">
                                                        <i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span> </button>
                                                </div>

                                            </form>
                                            <!-- end form-->
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    <!-- end page -->
    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © {{env('APP_NAME')}} All rights reserved.
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{ asset('public/admin-theme/assetsNew/js/vendor.min.js') }}" ></script>
    <!-- App js -->
    <script src="{{ asset('public/admin-theme/assetsNew/js/app.min.js') }}"></script>
    
</body>

</html>