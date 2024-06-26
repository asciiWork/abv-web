<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Abv Tools | CNC machine tool">
  <meta name="description" content="Welcome to ABV TOOLS! We are your ultimate destination for all things related to CNC machine auto part tools.">
  <meta property="og:title" content="Abv Tools | CNC machine tool">
  <meta property="og:description" content="Welcome to ABV TOOLS! We are your ultimate destination for all things related to CNC machine auto part tools.">
  <meta property="og:url" content="https://abvtool.in/">
  <meta property="og:site_name" content="Abv Tools">
  <meta property="og:image" content="{{ asset('public/web/assets/images/ABV-logo.png') }}" />
  <meta property="og:image:width" content="512">
  <meta property="og:image:height" content="512">
  <meta property="og:url" content="{{url('/')}}">
  <meta property="og:image:type" content="image/png">
  <meta property="og:type" content="website">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Leading CNC machine tool Supplier in India | Abv Tools</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/favicon.ico') }}">
  <link rel="icon" href="{{ asset('public/web/assets/img/favicon-32x32.png') }}" type="image/png">
  <link rel="icon" sizes="32x32" href="{{ asset('public/web/assets/img/favicon-32x32.png') }}" />
  <link rel="icon" sizes="192x192" href="{{ asset('public/web/assets/img/android-chrome-192x192.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('public/web/assets/img/apple-touch-icon.png') }}" />

  <!-- ======= All CSS Plugins here ======== -->
  <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/glightbox.min.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap" rel="stylesheet">

  <!-- Plugin css -->
  <link rel="stylesheet" href="{{ asset('public/web/assets/css/vendor/bootstrap.min.css') }}">

  <!-- Custom Style CSS -->
  <link rel="stylesheet" href="{{ asset('public/web/assets/css/style.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/web/assets/css/custome-style.css') }}">
  @yield('stylecss')
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

    @if(!in_array(\Route::currentRouteName(), ['web.login','web.register']))
    <!-- Start shipping section -->
    @include('web.includes.shipping')
    <!-- End shipping section -->

    <!-- Start shipping section -->
    @include('web.includes.customer')
    <!-- End shipping section -->
    @endif
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
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script type="text/javascript">
    var http_host_js = '{{ url("/") }}';
    var readMoreBtns = document.querySelectorAll('.read-more-btn');
    readMoreBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var moreContent = this.previousElementSibling.querySelector('.more-content');
        moreContent.classList.toggle('hidden');
      });
    });
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 5000, // Change slide every 3 seconds
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
    var swiper = new Swiper('.customerList', {
      slidesPerView: 'auto', // Automatically adjust number of slides visible
      spaceBetween: '28', // Add space between slides
      loop: true, // Enable loop mode
      autoplay: {
        delay: 4000, // Change slide every 3 seconds
        disableOnInteraction: false,
      },
      // Enable horizontal scrolling
      direction: 'horizontal',
    });
    var swiper = new Swiper('.testimonialList', {
      slidesPerView: 'auto', // Automatically adjust number of slides visible
      spaceBetween: 20, // Add space between slides
      loop: true, // Enable loop mode
      centeredSlides: true, // Center the active slide
      autoplay: {
        delay: 3000, // Change slide every 3 seconds
        disableOnInteraction: false,
      },
      // Enable horizontal scrolling
      direction: 'horizontal',
    });
    /*var colors = ["blue", "red"]
    var currentColor = 0
    var lis = document.querySelectorAll("#stepsId .text__secondary")
    function changeColor() {
      --currentColor
      if (currentColor < 0) currentColor = colors.length -1
      for (var i = 0; i < lis.length; i++) {
        lis[i].style.color = colors[(currentColor +i) % colors.length]
      }
    }
    setInterval(changeColor, 2500);*/
  </script>
  <script src="{{ asset('public/web/js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('public/web/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('public/web/assets/js/vendor/popper.js') }}" defer="defer"></script>
  <script src="{{ asset('public/web/assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
  <script src="{{ asset('public/web/assets/js/plugins/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('public/web/assets/js/plugins/glightbox.min.js') }}"></script>

  <!-- Customscript js -->
  <script src="{{ asset('public/web/assets/js/script.js') }}"></script>
  <script src="{{ asset('public/web/assets/js/custom-product.js') }}"></script>

  <script type="text/javascript" src="{{ asset('public/web/js/jquery.bootstrap-growl.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('public/web/js/parsley.js')}}"></script>
  <script type="text/javascript" src="{{ asset('public/web/js/comman.js?45255')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  @yield('scripts')

</body>

</html>