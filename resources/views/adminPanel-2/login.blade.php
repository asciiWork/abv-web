<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <title>ABV Tool - Admin Dashboard</title>

    <!--plugins-->
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">
    <!--Styles-->
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/assetsNew-2/css/icons.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/fav.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('public/admin-theme/assetsNew-2/css/dark-theme.css')}}" rel="stylesheet">
     
  </head>
  <body>
    <!--authentication-->
     <div class="container-fluid my-5">
        <div class="row">
           <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <div class="card border-3">
              <div class="card-body p-5">
                  <img src="{{ asset('public/web/assets/img/favicon-32x32.png') }}" class="mb-4" alt="">
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
                    <form class="row g-3" action="{{route('admin_login_post')}}" method="POST">
                      @csrf
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmailAddress" placeholder="" autocomplete="off" name="email" required="required">
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Enter Password" name="password" required="required"> 
                                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12 text-end"> <a href="auth-basic-forgot-password.html">Forgot Password ?</a>
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
      
    <!--authentication-->




    <!--plugins-->
    <script src="{{ asset('public/admin-theme/assetsNew-2/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsNew-2/js/bootstrap.bundle.min.js')}}"></script>
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