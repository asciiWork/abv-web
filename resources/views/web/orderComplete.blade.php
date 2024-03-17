<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Partsix - Auto Parts & Car Accessories Shop HTML Template</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/web/assets/img/favicon.ico') }}">
    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/plugins/glightbox.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('public/web/assets/css/style.css') }}">
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

        <!-- Start about section -->
        <section class="about__section section--padding mb-95">
            <div class="container">
                <div class="row mx-5">
                    <div class="col-lg-12 col-sm-12">
                        <div class="about__content my-4">
                            <aside class="checkout__sidebar sidebar border-radius-10" style="border-color: green">
                                <h4 class="checkout__order--summary__title"><i class="bi bi-check-lg" style="color: green;font-size: 2.7rem"></i> Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be processing your order soon.</h4>
                            </aside>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-md-2 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Order Number<br><b>{{$order->order_number}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Status<br><b>{{$order->order_status}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Date<br><b>{{date_format(date_create($order->order_date),"F d, Y")}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Total<br><b>₹{{$order->total_amount}}</b></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12 m-b-md">
                            <div class="text-center">
                                <p>Payment method<br><b>Cash on delivery</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p>Pay with cash upon delivery.</p>
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h3 class="checkout__order--summary__title">Your Order</h3>
                            <p>
                            <h4 class="">Product</h4>
                            </p>
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="cart__table--body">
                                        <?php $total = 0; ?>
                                        @foreach($orderDet as $ord)
                                        <tr class="cart__table--body__items">
                                            <td class="">{{$ord->product_name}} - {{$ord->prosize}} <b>× {{$ord->quantity}}</b><br>
                                                <p>size : {{$ord->prosize}}</p>
                                            </td>
                                            <td class=" text-right">₹{{ number_format($ord->total_amount,2) }}</td>
                                        </tr>
                                        <?php $total = $total + $ord->total_amount;  ?>
                                        @endforeach
                                        <tr class="cart__table--body__items">
                                            <td class=""><b>Subtotal : </b></td>
                                            <td class=" text-right">₹{{ number_format($total,2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="text-left"><b>Shipping</b></td>
                                            <td class="text-right">₹{{ number_format($order->shipping_charge,2) }} via Flat rate</td>
                                        </tr>

                                        <tr class="checkout__total--footer__items">
                                            <td class="checkout__total--footer__title checkout__total--footer__list text-left"><b>Payment method: </b></td>
                                            <td class="checkout__total--footer__title checkout__total--footer__list text-right">Cash on delivery</td>
                                        </tr>
                                        <tr class="checkout__total--footer__items">
                                            <td class="checkout__total--footer__title checkout__total--footer__list text-left"><b>Total: </b></td>
                                            <td class=" checkout__total--footer__title checkout__total--footer__list text-right">
                                                <h2>₹{{ number_format($order->total_amount,2) }}</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </aside>
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
    <script src="{{ asset('public/web/assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/web/assets/js/plugins/glightbox.min.js') }}"></script>

    <!-- Customscript js -->
    <script src="{{ asset('public/web/assets/js/script.js') }}"></script>
    <script src="{{ asset('public/web/assets/js/custom-product.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/web/js/jquery.bootstrap-growl.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/web/js/parsley.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/web/js/comman.js')}}"></script>
</body>

</html>