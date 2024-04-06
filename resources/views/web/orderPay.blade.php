<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/favicon.ico') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/glightbox.min.css') }}">
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/style.css') }}">
</head>

<body>
    <!-- Start preloader -->
    <!-- @include('web.includes.loader') -->
    <!-- End preloader -->

    <!-- Start header area -->
    @include('web.includes.header')
    <!-- End header area -->

    <main class="main__content_wrapper">
        <!-- Start breadcrumb section -->
        @include('web.includes.breadcrumb')

        <!-- Start about section -->
        <section class="about__section section--padding mb-95">
            <div class="container">
                <div class="row mx-5">
                    <div class="row py-4">
                        <div class="col-md-2 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Order Number<br><b>{{$order->order_number}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Date<br><b>{{date_format(date_create($order->order_date),"F d, Y")}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Total<br><b>₹{{$order->order_tax_amount_total}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Payment method<br><b>Credit Card/Debit Card/NetBanking</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row py-4">
                        <p>Thank you for your order, please click the button below to pay with Razorpay.</p>
                    </div>
                    <div class="row">
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                        @endif
                        @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                        @endif
                        <form action="{{ route('razorpay.payment.store') }}" method="POST">
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}" data-amount="{{(number_format($order->order_tax_amount_total,2)*100)}}" data-buttontext="Pay Now" data-name="Abv Tools" data-description="Rozerpay" data-image="{{asset('public/web/assets/img/abv.png')}}" data-prefill.name="{{$order->bil_name}}" data-prefill.email="{{$order->contact_email}}" data-prefill.order_id="{{$order->id}}" data-theme.color="#005bf2">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End about section -->
    </main>
    @include('web.includes.footer')
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    <!-- All Script JS Plugins here  -->
    <script type="text/javascript">
        var http_host_js = '{{ url("/") }}';
    </script>
    <script src="{{ asset('public/web/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/web/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/web/assets/js/vendor/popper.js') }}" defer="defer"></script>
    <script src="{{ asset('public/web/assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
    <script>
        $(window).on('load', function() {
            $('.razorpay-payment-button').click();
        });
    </script>
</body>

</html>