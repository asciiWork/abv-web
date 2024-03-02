@extends('web.layout.app')
@section('content')
<style type="text/css">.container.demo {margin-top:4em}</style>
<!-- cart section start -->
<section class="cart__section section--padding">
    <div class="container-fluid">
        <div class="cart__section--inner">
            @if($cartData)
            <form action="#">
                <h2 class="cart__title mb-30">Shopping Cart</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart__table">
                            <table class="cart__table--inner">
                                <thead class="cart__table--header">
                                    <tr class="cart__table--header__items">
                                        <th class="cart__table--header__list">Product</th>
                                        <th class="cart__table--header__list">Price</th>
                                        <th class="cart__table--header__list">Quantity</th>
                                        <th class="cart__table--header__list">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="cart__table--body">
                                    <?php $total_amount = 0 ?>
                                    @foreach($cartData as $c)
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <button class="cart__remove--btn remove-cart-btn" aria-label="search button" type="button" data-id="{{ $c['id'] }}" action="{{ route('remove-cart') }}" isRefresh="1">
                                                        
                                                        <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                                                            <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z" />
                                                        </svg>
                                                    </button>
                                                    <div class="cart__thumbnail">
                                                        <a href="{{ URL::to('product-details/') }}/{{$c['slug']}}"><img class="border-radius-5" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $c['product_img'] }}" alt="cart-product"></a>
                                                    </div>
                                                    <div class="cart__content">
                                                        <h3 class="cart__content--title h4"><a href="{{ URL::to('product-details/') }}/{{$c['slug']}}">{{$c['product_name']}}</a></h3>
                                                        <span class="cart__content--variant">SIZE: {{$c['prosize']}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price">₹{{$c['price']}}</span>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <div class="quantity__box">
                                                    <a type="minus" data-id="{{ $c['id'] }}" class="increase-decrease-cart-btn quantity__value quickview__value--quantity decrease" aria-label="quantity value" action="{{route('inc-dec-cart')}}" value="Decrease Value">-</a>
                                                    <label>
                                                        <input type="number" name="qnt" class="quantity__number quickview__value--number" value="{{$c['qnt']}}" data-counter />
                                                    </label>
                                                    <a type="plus" data-id="{{ $c['id'] }}" class="increase-decrease-cart-btn quantity__value quickview__value--quantity increase" aria-label="quantity value" action="{{route('inc-dec-cart')}}" value="Increase Value">+</a>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price end">₹{{$c['total']}}</span>
                                            </td>
                                        </tr>
                                    <?php $total_amount = $total_amount + $c['total']; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="continue__shopping d-flex justify-content-between">
                                <a class="continue__shopping--link" href="{{ URL::to('products/') }}">Continue shopping</a>
                                <!-- <button class="continue__shopping--clear" type="submit">Clear Cart</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__summary border-radius-10">
                            <!--<div class="coupon__code mb-30">
                                 <h3 class="coupon__code--title">Coupon</h3>
                                <p class="coupon__code--desc">Enter your coupon code if you have one.</p>
                                <div class="coupon__code--field d-flex">
                                    <label>
                                        <input class="coupon__code--field__input border-radius-5" placeholder="Coupon code" type="text">
                                    </label>
                                    <button class="coupon__code--field__btn primary__btn" type="submit">Apply Coupon</button>
                                </div> 
                            </div>
                            <div class="cart__note mb-20">
                                <h3 class="cart__note--title">CART TOTALS</h3>
                                <p class="cart__note--desc">Add special instructions for your seller...</p>
                                <textarea class="cart__note--textarea border-radius-5"></textarea>
                            </div>-->
                            <div class="coupon__code mb-30">
                                 <h3 class="coupon__code--title">CART TOTALS</h3>
                            </div>
                            <div class="cart__summary--total mb-20">
                                <table class="cart__summary--total__table">
                                    <tbody>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left"><strong> SUBTOTAL</strong></td>
                                            <td class="cart__summary--amount text-right">₹{{number_format($total_amount,2)}}</td>
                                        </tr>                                        
                                        <tr><td colspan="2"><hr></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <label class="contact__form--label"><strong> Shipping Detail</strong></label>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact__form--list mb-20">
                                        <select id="country" name="country" class="contact__form--input"></select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact__form--list mb-20">
                                        <select name="state" id="state" class="contact__form--input" placeholder="State"></select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact__form--list mb-20">
                                        <input class="contact__form--input" name="city"  placeholder="City" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="contact__form--list mb-20">
                                        <input class="contact__form--input" name="zipcode"  placeholder="Postcode/ Zip" type="text">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <table class="cart__summary--total__table">
                                    <tbody>
                                        <tr class="cart__summary--total__list">
                                            <td class="cart__summary--total__title text-left"><strong> SUBTOTAL</strong></td>
                                            <td class="cart__summary--amount text-right">₹{{number_format($total_amount,2)}}</td>
                                        </tr>                                        
                                        <tr><td colspan="2"><hr></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart__summary--footer">
                                <ul class="d-flex justify-content-between">
                                    <!-- <li><button class="cart__summary--footer__btn primary__btn cart" type="submit">Update Cart</button></li> -->
                                    <li><a class="cart__summary--footer__btn primary__btn checkout" href="{{ URL::to('checkout/') }}">Check Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <p align="center">Your cart is currently empty.</p>
                <p align="center"><a class="cart__summary--footer__btn primary__btn" href="{{ url('/') }}">Continue shopping</a></p>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            @endif
        </div>
    </div>
</section>
<!-- cart section end -->

<!-- Start product section -->
<section class="product__section section--padding  pt-0">
    <div class="container">
        <div class="section__heading border-bottom mb-30">
            <h2 class="section__heading--maintitle">New <span>Products</span></h2>
        </div>
        <div class="product__section--inner pb-15 product__swiper--activation swiper">
            <div class="swiper-wrapper">
            @foreach($ranProduct as $proRan)
                <div class="swiper-slide">
                    <article class="product__card">
                        <div class="product__card--thumbnail">
                            <a class="product__card--thumbnail__link display-block" href="{{ URL::to('product-details/') }}/{{$proRan->product_slug}}">
                                <img class="product__card--thumbnail__img product__primary--img" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $proRan->product_img_url }}" alt="product-img">
                                <img class="product__card--thumbnail__img product__secondary--img" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $proRan->product_img_url }}" alt="product-img">
                            </a>
                            <span class="product__badge">-{{ $proRan->product_offer_per }}%</span>
                            <ul class="product__card--action d-flex align-items-center justify-content-center">
                                <li class="product__card--action__list">
                                    <a class="product__card--action__btn" title="Quick View" data-bs-toggle="modal" data-bs-target="#examplemodal" href="javascript:void(0)">
                                        <svg class="product__card--action__btn--svg" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z" fill="currentColor"></path>
                                        </svg>
                                        <span class="visually-hidden">Quick View</span>
                                    </a>
                                </li>
                                <!-- <li class="product__card--action__list">
                                    <a class="product__card--action__btn" title="Compare" href="compare.html">
                                        <svg class="product__card--action__btn--svg" width="17" height="17" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.89137 6.09375C6.89137 6.47656 7.16481 6.75 7.54762 6.75H10.1453C10.7195 6.75 11.0203 6.06641 10.5828 5.65625L9.8445 4.89062L12.907 1.82812C13.0437 1.69141 13.0437 1.47266 12.907 1.36328L12.2781 0.734375C12.1687 0.597656 11.95 0.597656 11.8132 0.734375L8.75075 3.79688L7.98512 3.05859C7.57496 2.62109 6.89137 2.92188 6.89137 3.49609V6.09375ZM1.94215 12.793L5.00465 9.73047L5.77028 10.4688C6.18043 10.9062 6.89137 10.6055 6.89137 10.0312V7.40625C6.89137 7.05078 6.59059 6.75 6.23512 6.75H3.61012C3.0359 6.75 2.73512 7.46094 3.17262 7.87109L3.9109 8.63672L0.848402 11.6992C0.711683 11.8359 0.711683 12.0547 0.848402 12.1641L1.47731 12.793C1.58668 12.9297 1.80543 12.9297 1.94215 12.793Z" fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Compare</span>
                                    </a>
                                </li>
                                <li class="product__card--action__list">
                                    <a class="product__card--action__btn" title="Wishlist" href="wishlist.html">
                                        <svg class="product__card--action__btn--svg" width="18" height="18" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z" fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Wishlist</span>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="product__card--content">
                            <ul class="rating product__card--rating d-flex">
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                                <li class="rating__list">
                                    <span class="rating__icon">
                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </li>
                                <li>
                                    <span class="rating__review--text">(126) Review</span>
                                </li>
                            </ul>
                            <h3 class="product__card--title"><a href="{{ URL::to('product-details/') }}/{{$proRan->product_slug}}">{{ $proRan->product_name }}</a></h3>
                            <div class="product__card--price">
                                <span class="current__price">₹{{ $proRan->product_min_price }}</span> -
                                <span class="current__price"> ₹{{ $proRan->product_max_price }}</span>
                            </div>
                            <div class="product__card--footer">
                                <a class="product__card--btn primary__btn" href="{{ URL::to('product-details/') }}/{{$proRan->product_slug}}">
                                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z" fill="currentColor" />
                                    </svg>
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
            </div>
            <div class="swiper__nav--btn swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
            <div class="swiper__nav--btn swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
</section>
<!-- End product section -->
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection