<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <title>ABV Tool - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/fav.ico') }}">
    <!--plugins-->
    <link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">
    <!--Styles-->
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsRoksyn/css/icons.css')}}">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsRoksyn/css/dark-theme.css')}}" rel="stylesheet">
</head>

<body class="authentication-bg position-relative">
    <div class="container-fluid my-5">
        <div class="row">
           <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <div class="card border-3">
                <div class="card-body p-5">
                    <img src="{{ asset('public/web/assets/img/logo/ABV-logo.png')}}" class="mb-4" width="100" alt="">
                    <h4 class="fw-bold">Get Started Now</h4>
                    <p class="mb-0">Enter your credentials to login your account</p>
                    <div class="form-body mt-4">
                        @if ($errors->any())
                            <div class="alert border-0 bg-danger-subtle alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="fs-3 text-danger"><span class="material-symbols-outlined">cancel</span>
                                    </div>
                                    <div class="ms-3">
                                        @foreach ($errors->all() as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form class="row g-3" action="{{route('admin_login_post')}}" method="post">
                            @csrf
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="Enter your email" required="required">
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" required="required"> 
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div> -->
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
           </div>
        </div><!--end row-->
     </div>
    <!--plugins-->
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/bootstrap.bundle.min.js')}}"></script>
    <script>
      $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bi-eye-slash-fill");
            $('#show_hide_password i').removeClass("bi-eye-fill");
          } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password i').addClass("bi-eye-fill");
          }
        });
      });
    </script>    
</body>
</html>