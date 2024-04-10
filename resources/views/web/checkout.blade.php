@extends('web.layout.app')
@section('content')
<?php $total = 0;
$authEmail = (\Auth::check()) ? \Auth::user()->email : '';
?>
<!-- Start checkout page area -->
<div class="checkout__page--area section--padding">
    <div class="container">
        {!! Form::open(['route'=>'web.shipping-post','id'=>'submit-form-razorpay']) !!}
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="main checkout__mian">
                    <div class="checkout__content--step section__contact--information">
                        <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                            <h2 class="section__header--title h3">Contact information</h2>
                            @if(!\Auth::check())
                            <p class="layout__flex--item">
                                Already have an account?
                                <a class="layout__flex--item__link" href="{{ route('web.login') }}">Log in</a>
                            </p>
                            @endif
                        </div>
                        <div class="customer__information">
                            <div class="checkout__email--phone mb-12">
                                <label>
                                    <input class="checkout__input--field border-radius-5" required placeholder="Email" value="{{$authEmail}}" name="news_email" type="email">
                                </label>
                            </div>
                            <div class="checkout__checkbox">
                                <input class="checkout__checkbox--input" id="check1" type="checkbox" name="email_me">
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label" for="check1">Email me with news and offers</label>
                            </div>
                        </div>
                    </div>
                    <div class="checkout__content--step section__shipping--address">
                        <div class="section__header mb-25">
                            <h2 class="section__header--title h3">Billing Details</h2>
                        </div>
                        <div class="section__shipping--address__content">
                            <div class="row">
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list ">
                                        <label class="checkout__input--label" for="bil_name">Name <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="Name" id="bil_name" type="text" name="bil_name" value="{{ (isset($uAddress[0]->name))?$uAddress[0]->name:'' }}">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_company">Company name (optional)</label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="bil_company" type="text" name="bil_company" value="{{ (isset($uAddress[0]->company))?$uAddress[0]->company:'' }}">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="country">Country <span class="checkout__input--label__star">*</span></label>
                                        <select id="country" name="country" required class="contact__form--input" placeholder="Country"></select>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_state">State <span class="checkout__input--label__star">*</span></label>
                                        <select name="bil_state" id="state" required class="bil_state_change contact__form--input" placeholder="State"></select>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_city">Town/City <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="City" value="{{ (isset($uAddress[0]->city))?$uAddress[0]->city:'' }}" id="bil_city" type="text" name="bil_city">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="gst_number">GST Number (optional)</label>
                                        <input class="checkout__input--field border-radius-5" placeholder="GST Number (optional)" id="gst_number" type="text" name="gst_number" value="{{ (isset($uAddress[0]->gst_number))?$uAddress[0]->gst_number:'' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_street">Street address <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="Street address" id="bil_street" type="text" name="bil_street" value="{{ (isset($uAddress[0]->street))?$uAddress[0]->street:'' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_area">Area <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="Street address" id="bil_area" type="text" name="bil_area" value="{{ (isset($uAddress[0]->area))?$uAddress[0]->area:'' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_zipcode">Postcode / ZIP <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="Postal code" id="bil_zipcode" type="text" name="bil_zipcode" value="{{ (isset($uAddress[0]->zipcode))?$uAddress[0]->zipcode:'' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="bil_phone">Phone <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="phone" id="bil_phone" type="text" name="bil_phone" value="{{ (isset($uAddress[0]->phone))?$uAddress[0]->phone:'' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label" for="contact_email">Email address <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" required placeholder="Email address " id="contact_email" type="email" name="contact_email" value="{{ (isset($uAddress[0]->contact_email))?$uAddress[0]->contact_email:'' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <details {{ (isset($uAddress[1]->name))?'open':'' }}>
                            <summary class="checkout__checkbox mb-20">
                                <input name="ship_me" class="checkout__checkbox--input" type="checkbox" value="1" {{ (isset($uAddress[1]->name))?'checked':'' }}>
                                <span class="checkout__checkbox--checkmark"></span>
                                <span class="checkout__checkbox--label">Ship to a different address?</span>
                            </summary>
                            <div class="section__shipping--address__content">
                                <div class="row">
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list ">
                                            <label class="checkout__input--label" for="ship_name">Name <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Name" id="ship_name" type="text" name="ship_name" value="{{ (isset($uAddress[1]->name))?$uAddress[1]->name:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_company">Company name (optional)</label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="ship_company" type="text" name="ship_company" value="{{ (isset($uAddress[1]->company))?$uAddress[1]->company:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_country">Country <span class="checkout__input--label__star">*</span></label>
                                            <select name="ship_country" id="ship_country" class="contact__form--input" placeholder="Country"></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_state">State <span class="checkout__input--label__star">*</span></label>
                                            <select name="ship_state" id="ship_state" class="ship_state_change contact__form--input" placeholder="State"></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_city">Town/City <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="City" id="ship_city" type="text" name="ship_city" value="{{ (isset($uAddress[1]->city))?$uAddress[1]->city:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_street">Street address <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Street address" id="ship_street" type="text" name="ship_street" value="{{ (isset($uAddress[1]->street))?$uAddress[1]->street:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_area">Area </label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Street address" id="ship_area" type="text" name="ship_area" value="{{ (isset($uAddress[1]->area))?$uAddress[1]->area:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_zipcode">Postcode / ZIP <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Postal code" id="ship_zipcode" type="text" name="ship_zipcode" value="{{ (isset($uAddress[1]->zipcode))?$uAddress[1]->zipcode:'' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label" for="ship_phone">Phone <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="phone" id="ship_phone" type="text" name="ship_phone" value="{{ (isset($uAddress[1]->phone))?$uAddress[1]->phone:'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                    <div class="order-notes mb-20">
                        <label class="checkout__input--label" for="order">Order Notes </label>
                        <textarea name="note" class="checkout__notes--textarea__field border-radius-5" id="order" placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>
                    </div>
                    <div class="checkout__content--step__footer d-flex align-items-center">
                        <a class="continue__shipping--btn primary__btn border-radius-5" href="{{ route('web.products') }}">Continue To Shipping</a>
                        <a class="previous__link--content" href="{{ route('web.cart') }}">Return to cart</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <aside class="checkout__sidebar sidebar border-radius-10">
                    <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                    <div class="cart__table checkout__product--table">
                        <table class="cart__table--inner">
                            <tbody class="cart__table--body">
                                <?php $totalQnt = 0; ?>
                                @if($products)
                                @foreach($products as $c)
                                <tr class="cart__table--body__items">
                                    <td class="cart__table--body__list">
                                        <div class="product__image two  d-flex align-items-center">
                                            <div class="product__thumbnail border-radius-5">
                                                <img class="display-block border-radius-5" src="{{ asset('public/web/assets/img/product/main-product/') }}/{{ $c['product_img'] }}" alt="cart-product">
                                                <span class="product__thumbnail--quantity">{{ $c['qnt'] }}</span>
                                                <?php $totalQnt += $c['qnt']; ?>
                                            </div>
                                            <div class="product__description">
                                                <h4 class="product__description--name">{{ $c['product_name'] }}</h4>
                                                <span class="product__description--variant">{{ $c['prosize'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__table--body__list">
                                        <span class="cart__price"> ₹{{ number_format($c['total'],2) }}</span>
                                    </td>
                                </tr>
                                <?php $total = $total + $c['total'];  ?>
                                @endforeach
                                <?php $fntotal = $total;  ?>
                                @endif
                                <input type="hidden" value="{{$totalQnt}}" id="final_total_qnt">
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Subtotal </td>
                                    <td class="checkout__total--amount text-right"> ₹{{ number_format($total,2) }}</td>
                                </tr>
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Shipping Rate</td>
                                    <input type="hidden" id="shipping_rate_amount" value="0">
                                    <td class="checkout__total--calculated__text text-right" id="shipping_rate_txt">₹100.00</td>
                                </tr>
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">COD</td>
                                    <input type="hidden" id="cod_rate_amount" value="0">
                                    <td class="checkout__total--calculated__text text-right" id="cod_rate_txt">2%</td>
                                </tr>
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">GST(18%)</td>
                                    <input type="hidden" id="gst_rate_amount" value="0">
                                    <td class="checkout__total--calculated__text text-right" id="gst_rate_txt">₹100.00</td>
                                </tr>
                            </tbody>
                            <tfoot class="checkout__total--footer">
                                <tr class="checkout__total--footer__items">
                                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total </td>
                                    <input type="hidden" id="final_total_amount" value="{{$fntotal}}">
                                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right" id="final_total_txt">₹{{ number_format($fntotal,2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment__history mb-30">
                        <h3 class="payment__history--title mb-20">Payment Method</h3>
                        <ul class="payment__history--inner d-flex">
                            <li class="payment__history--list">
                                <input id="payment_method_razorpay" type="radio" class="variant__color--list" name="payment_method" value="razorpay"> Payment
                            </li>
                            <li class="payment__history--list">
                                <input id="payment_method_cod" type="radio" class="variant__color--list" name="payment_method" value="cod" checked="checked"> Cash on delivery
                            </li>
                            <!-- <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Paypal</button></li> -->
                        </ul>
                    </div>
                    <button class="checkout__now--btn primary__btn" type="submit">Place Order</button>
                </aside>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- End checkout page area -->
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function() {
        $('.bil_state_change').change(function() {
            var shippState = $('.ship_state_change').val();
            var final_total_qnt = $("#final_total_qnt").val()
            var st = (shippState != null) ? shippState : $(this).val();
            if (st != 'Gujarat') {
                if (final_total_qnt < 50) {
                    $("#shipping_rate_amount").val(130)
                    $("#shipping_rate_txt").html('₹130.00');
                } else {
                    $("#shipping_rate_amount").val(260)
                    $("#shipping_rate_txt").html('₹260.00');
                }
            } else {
                if (final_total_qnt < 50) {
                    $("#shipping_rate_amount").val(100)
                    $("#shipping_rate_txt").html('₹100.00');
                } else {
                    $("#shipping_rate_amount").val(200)
                    $("#shipping_rate_txt").html('₹200.00');
                }
            }
            finalAmount();
        });
        $('.ship_state_change').change(function() {
            var final_total_qnt = $("#final_total_qnt").val()
            var st = $(this).val();
            if (st != 'Gujarat') {
                if (final_total_qnt < 50) {
                    $("#shipping_rate_amount").val(130)
                    $("#shipping_rate_txt").html('₹130.00');
                } else {
                    $("#shipping_rate_amount").val(260)
                    $("#shipping_rate_txt").html('₹260.00');
                }
            } else {
                if (final_total_qnt < 50) {
                    $("#shipping_rate_amount").val(100)
                    $("#shipping_rate_txt").html('₹100.00');
                } else {
                    $("#shipping_rate_amount").val(200)
                    $("#shipping_rate_txt").html('₹200.00');
                }
            }
            finalAmount();
        });
    });

    function finalAmount() {
        var totl = parseFloat($("#final_total_amount").val()) + parseFloat($("#shipping_rate_amount").val());

        var codAmount = parseFloat(totl) * 0.02;
        $("#cod_rate_txt").html('₹' + parseFloat(codAmount).toFixed(2));
        
        var gst_total = totl + codAmount;
        var gstAmount = parseFloat(gst_total) * 0.18;
        $("#gst_rate_txt").html('₹' + parseFloat(gstAmount).toFixed(2));

        var final_total_txt = totl + gstAmount;
        final_total_txt = codAmount + final_total_txt;
        $("#final_total_txt").html('₹' + (parseFloat(final_total_txt).toFixed(2)));
    }
</script>
@endsection