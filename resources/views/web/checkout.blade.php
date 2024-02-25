@extends('web.layout.app')
@section('content')
<?php $total = 0; ?>
<!-- Start checkout page area -->
<div class="checkout__page--area section--padding">
    <div class="container">
        {!! Form::open(['route'=>'web.shipping-post','id'=>'submit-form']) !!}
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
                        <!-- <div class="customer__information">
                            <div class="checkout__email--phone mb-12">
                                <label>
                                    <input class="checkout__input--field border-radius-5" placeholder="Email or mobile phone mumber" name="news_email" type="text">
                                </label>
                            </div>
                            <div class="checkout__checkbox">
                                <input class="checkout__checkbox--input" id="check1" type="checkbox" name="email_me">
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label" for="check1">Email me with news and offers</label>
                            </div>
                        </div> -->
                    </div>
                    <div class="checkout__content--step section__shipping--address">
                        <div class="section__header mb-25">
                            <h2 class="section__header--title h3">Billing Details</h2>
                        </div>
                        <div class="section__shipping--address__content">
                            <div class="row">
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list ">
                                        <label class="checkout__input--label mb-5" for="bil_name">Name <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Name" id="bil_name" type="text" name="bil_name">
                                    </div>
                                </div>                                    
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_company">Company name (optional)</label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="bil_company" type="text" name="bil_company">
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="country">Country <span class="checkout__input--label__star">*</span></label>
                                        <select id="country" name="country" class="contact__form--input" placeholder="Country"></select>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_state">State <span class="checkout__input--label__star">*</span></label>
                                        <select name="bil_state" id="state" class="contact__form--input" placeholder="State"></select>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_city">Town/City <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="City" id="bil_city" type="text" name="bil_city">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="gst_number">GST Number (optional)</label>
                                        <input class="checkout__input--field border-radius-5" placeholder="GST Number (optional)" id="gst_number" type="text" name="gst_number">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_street">Street address <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Street address" id="bil_street" type="text" name="bil_street">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_area">Area </label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Street address" id="bil_area" type="text" name="bil_area">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_zipcode">Postcode / ZIP <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Postal code" id="bil_zipcode" type="text" name="bil_zipcode">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="bil_phone">Phone <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="phone" id="bil_phone" type="text" name="bil_phone">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                        <label class="checkout__input--label mb-5" for="contact_email">Email address <span class="checkout__input--label__star">*</span></label>
                                        <input class="checkout__input--field border-radius-5" placeholder="Email address " id="contact_email" type="text" name="contact_email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!\Auth::check())
                        <div class="checkout__checkbox">
                            <input class="checkout__checkbox--input" id="checkbox2" type="checkbox" name="create_acc">
                            <span class="checkout__checkbox--checkmark"></span>
                            <label class="checkout__checkbox--label" for="checkbox2">
                                Create an account?</label>
                        </div>
                        @endif
                        <details>
                            <summary class="checkout__checkbox mb-20">
                                <input name="ship_me" class="checkout__checkbox--input" type="checkbox">
                                <span class="checkout__checkbox--checkmark"></span>
                                <span class="checkout__checkbox--label">Ship to a different address?</span>
                            </summary>
                            <div class="section__shipping--address__content">
                                <div class="row">
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list ">
                                            <label class="checkout__input--label mb-5" for="ship_name">Name <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Name" id="ship_name" type="text" name="ship_name">
                                        </div>
                                    </div>                                    
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_company">Company name (optional)</label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Company (optional)" id="ship_company" type="text" name="ship_company">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_country">Country <span class="checkout__input--label__star">*</span></label>
                                            <select name="ship_country" id="ship_country" class="contact__form--input" placeholder="Country"></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_state">State <span class="checkout__input--label__star">*</span></label>
                                            <select name="ship_state" id="ship_state" class="contact__form--input" placeholder="State"></select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_city">Town/City <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="City" id="ship_city" type="text" name="ship_city">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_street">Street address <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Street address" id="ship_street" type="text" name="ship_street">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_area">Area </label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Street address" id="ship_area" type="text" name="ship_area">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_zipcode">Postcode / ZIP <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Postal code" id="ship_zipcode" type="text" name="ship_zipcode">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                        <div class="checkout__input--list">
                                            <label class="checkout__input--label mb-5" for="ship_phone">Phone <span class="checkout__input--label__star">*</span></label>
                                            <input class="checkout__input--field border-radius-5" placeholder="phone" id="ship_phone" type="text" name="ship_phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>                            
                    </div>
                    <div class="order-notes mb-20">
                        <label class="checkout__input--label mb-5" for="order">Order Notes </label>
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
                                @if($products)
                                    @foreach($products as $c)
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="product__image two  d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <img class="display-block border-radius-5" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $c['product_img'] }}" alt="cart-product">
                                                        <span class="product__thumbnail--quantity">{{ $c['qnt'] }}</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h4 class="product__description--name">{{ $c['product_name'] }}</h4>
                                                        <span class="product__description--variant">{{ $c['prosize'] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price">  ₹{{ number_format($c['total'],2) }}</span>
                                            </td>
                                        </tr>
                                        <?php $total = $total + $c['total'];  ?>
                                    @endforeach
                                    <?php $fntotal = $total + 100;  ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="checkout__total">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Subtotal </td>
                                    <td class="checkout__total--amount text-right"> ₹{{ number_format($total,2) }}</td>
                                </tr>
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Shipping</td>
                                    <td class="checkout__total--calculated__text text-right">Flat Rate: ₹100.00</td>
                                </tr>
                            </tbody>
                            <tfoot class="checkout__total--footer">
                                <tr class="checkout__total--footer__items">
                                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total </td>
                                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right">₹{{ number_format($fntotal,2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment__history mb-30">
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