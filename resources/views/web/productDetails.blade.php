@extends('web.layout.app')
@section('stylecss')
<style type="text/css">
    .tab-price {
        display: none;
    }

    .psize {
        /*border: 1px solid;*/
    }

    .tab-price.active {
        display: block;
    }

    .rate_c {
        float: left;
        height: 46px;
    }

    .rate_c:not(:checked)>input {
        position: fixed;
        top: -9999px;
    }

    .rate_c:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate_c:not(:checked)>label:before {
        content: '★ ';
    }

    .rate_c>input:checked~label {
        color: #ed1d24;
    }

    .rate_c:not(:checked)>label:hover,
    .rate_c:not(:checked)>label:hover~label {
        color: #ed1d24;
    }

    .rate_c>input:checked+label:hover,
    .rate_c>input:checked+label:hover~label,
    .rate_c>input:checked~label:hover,
    .rate_c>input:checked~label:hover~label,
    .rate_c>label:hover~input:checked~label {
        color: #c59b08;
    }

    .rate_c::-webkit-scrollbar {
        display: none;
    }

    .rate_c {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
    .psize:hover {
        color: #ffffff;
        background: #0a58ca;
    }
</style>
@endsection
@section('content')

<!-- Start product details section -->
<section class="product__details--section section--padding">
    <div class="container">
        <div class="row row-cols-lg-2 row-cols-md-2">
            <div class="col">
                <div class="product__details--media">
                    <div class="single__product--preview  swiper mb-25">
                        <div class="swiper-wrapper">
                            @foreach($proimges as $proimg)
                            <div class="swiper-slide">
                                <div class="product__media--preview__items">
                                    <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="{{ asset('web/assets/img/product/main-product/') }}/{{ $proimg->product_img_url }}">
                                        <img class="product__media--preview__items--img" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $proimg->product_img_url }}" alt="product-media-img"></a>
                                    <div class="product__media--view__icon">
                                        <a class="product__media--view__icon--link glightbox" href="{{ asset('web/assets/img/product/main-product/') }}/{{ $proimg->product_img_url }}" data-gallery="product-media-preview">
                                            <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443" viewBox="0 0 512 512">
                                                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                                            </svg>
                                            <span class="visually-hidden">product view</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="single__product--nav swiper">
                        <div class="swiper-wrapper">
                            @foreach($proimges as $proimg)
                            <div class="swiper-slide">
                                <div class="product__media--nav__items">
                                    <img class="product__media--nav__items--img" src="{{ asset('web/assets/img/product/main-product/') }}/{{ $proimg->product_img_url }}" alt="product-nav-img">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="product__details--info">
                    {!! Form::open(['route' => 'web.add-to-cart', 'id' => 'submit-form','redirect'=>url('/product-details/'.$productWithSize->product_slug)]) !!}
                    <input type="hidden" name="id" value="{{$productWithSize->product_id}}">
                    <input type="hidden" id="inputValue" name="prosize" placeholder="Selected tab value">
                    <h2 class="product__details--info__title mb-15">{{$productWithSize->product_name}}</h2>
                    <div class="product__details--info__price mb-12">
                        <span class="current__price">₹{{ $productWithSize->product_min_price }} - </span>
                        <span class="current__price">₹{{ $productWithSize->product_max_price }}</span>
                        <!-- <span class="old__price">$68.00</span> -->
                    </div>
                    <ul class="rating product__card--rating mb-15 d-flex">
                        @if($avgRate['avgRate'])
                        @for ($i=1; $i <= 5; $i++) @if($i<=$avgRate['avgRate']) <li class="rating__list">
                            <span class="rating__icon">
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                </svg>
                            </span>
                            </li>
                            @else
                            <li class="rating__list">
                                <span class="rating__icon">
                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </li>
                            @endif
                            @endfor
                            <li>
                                <span class="rating__review--text">({{$avgRate['totalRate']}}) Review</span>
                            </li>
                            @else
                            @for ($i=1; $i <= 5; $i++) <li class="rating__list">
                                <span class="rating__icon">
                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                    </svg>
                                </span>
                                </li>
                                @endfor
                                <li>
                                    <span class="rating__review--text">(0) Review</span>
                                </li>
                                @endif
                    </ul>
                    <p class="product__details--info__desc mb-15">
                        @if($productWithSize->product_detail!='')
                            {{substr($productWithSize->product_detail,0,150)}} ...
                        @endif
                    </p>
                    <div class="product__variant">
                        <div class="product__variant--list mb-15">
                            <div class="product__details--info__meta">
                                @if($productWithSize->size_in_mm=='1')
                                <p class="product__details--info__meta--list"><strong>Size in MM</strong> </p>
                                @else
                                @endif
                                <p class="product__details--info__meta--list"><strong>{{$productWithSize->product_dimension}}</strong> </p>
                                <p class="product__details--info__meta--list"><strong>SKU:</strong> <span> N/A</span> </p>
                                <p class="product__details--info__meta--list"><strong>CATEGORIES:</strong> <span>{{$catData[0]->category_name}}</span> </p>
                            </div>
                        </div>
                        <div class="product__variant--list mb-20">
                            <fieldset class="variant__input--fieldset">
                                <legend class="product__variant--title mb-8">Size :</legend>
                                <ul class="variant__size d-flex" id="labelList" style="flex-wrap: wrap;">
                                    @foreach ($productSize->product_size as $r)
                                    <li class="variant__size--list mb-2">
                                        <label data-tab="{{$r->product_size}}" class="variant__size--value psize" for="weight{{$r->id}}">{{$r->product_size}} - {{ $r->product_current_price }} - {{$r->product_code}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                                @foreach ($productSize->product_size as $r)
                                <div id="{{$r->product_size}}" class="tab-price">
                                    <p></p>
                                    <p class="product__details--info__meta--list">
                                        @if($r->product_old_price>0)
                                        @if($r->product_old_price>0 && $r->product_current_price<=0) <strong>₹{{$r->product_old_price}}</strong>&nbsp;
                                            @elseif($r->product_current_price!=$r->product_old_price)
                                            <strong><s>₹{{$r->product_old_price}}</s></strong>&nbsp;
                                            @endif
                                            @endif
                                            @if($r->product_current_price>0)
                                            <strong>₹{{$r->product_current_price}}</strong>
                                            @endif
                                    </p>
                                </div>
                                @endforeach
                            </fieldset>
                        </div>
                        <div class="product__variant--list quantity d-flex align-items-center mb-20">
                            <div class="quantity__box">
                                <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                <label>
                                    <input name="qnt" type="number" class="quantity__number quickview__value--number" value="1" data-counter />
                                </label>
                                <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>
                            </div>
                            <button class="primary__btn quickview__cart--btn" type="submit">Add To Cart</button>
                        </div>
                    </div>
                    <div class="quickview__social d-flex align-items-center mb-15">
                        <label class="quickview__social--title">Social Share:</label>
                        <ul class="quickview__social--wrapper mt-0 d-flex">
                            <li class="quickview__social--list">
                                <a class="quickview__social--icon" target="_blank" href="https://www.facebook.com">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524" viewBox="0 0 7.667 16.524">
                                        <path data-name="Path 237" d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z" transform="translate(-960.13 -345.407)" fill="currentColor" />
                                    </svg>
                                    <span class="visually-hidden">Facebook</span>
                                </a>
                            </li>
                            <li class="quickview__social--list">
                                <a class="quickview__social--icon" target="_blank" href="https://twitter.com">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384" viewBox="0 0 16.489 13.384">
                                        <path data-name="Path 303" d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z" transform="translate(-951.23 -1140.849)" fill="currentColor" />
                                    </svg>
                                    <span class="visually-hidden">Twitter</span>
                                </a>
                            </li>
                            <li class="quickview__social--list">
                                <a class="quickview__social--icon" target="_blank" href="https://www.instagram.com">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492" viewBox="0 0 19.497 19.492">
                                        <path data-name="Icon awesome-instagram" d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z" transform="translate(0.004 -1.492)" fill="currentColor"></path>
                                    </svg>
                                    <span class="visually-hidden">Instagram</span>
                                </a>
                            </li>
                            <li class="quickview__social--list">
                                <a class="quickview__social--icon" target="_blank" href="https://www.youtube.com">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                        <path data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor" />
                                    </svg>
                                    <span class="visually-hidden">Youtube</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End product details section -->

<!-- Start product details tab section -->
<section class="product__details--tab__section section--padding">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <ul class="product__tab--one product__details--tab d-flex mb-30">
                    <li class="product__details--tab__list active" data-toggle="tab" data-target="#description">Description</li>
                    <li class="product__details--tab__list" data-toggle="tab" data-target="#reviews">Product Reviews</li>
                    <li class="product__details--tab__list" data-toggle="tab" data-target="#information">Additional Info</li>
                </ul>
                <div class="product__details--tab__inner border-radius-10">
                    <div class="tab_content">
                        <div id="description" class="tab_pane active show">
                            <div class="product__tab--content">
                                <div class="product__tab--content__step mb-30">
                                    <h2 class="product__tab--content__title h4 mb-10">{{$productWithSize->product_name}}</h2>
                                    <p class="product__tab--content__desc">{{$productWithSize->product_detail}}</p>
                                </div>
                            </div>
                        </div>
                        <div id="reviews" class="tab_pane">
                            <div class="product__reviews">
                                <div class="product__reviews--header">
                                    <h2 class="product__reviews--header__title h3 mb-20">Customer Reviews</h2>
                                    <div class="reviews__ratting d-flex align-items-center">
                                        @if($avgRate['avgRate'])
                                        <ul class="rating d-flex">
                                            @for ($i=1; $i <= 5; $i++) @if($i<=$avgRate['avgRate']) <li class="rating__list">
                                                <span class="rating__icon">
                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                </li>
                                                @else
                                                <li class="rating__list">
                                                    <span class="rating__icon">
                                                        <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </li>
                                                @endif
                                                @endfor
                                        </ul>
                                        <span class="reviews__summary--caption">Based on {{$avgRate['totalRate']}} reviews</span>
                                        @else
                                        <span>There are no reviews yet.</span>
                                        @endif
                                    </div>
                                    <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A Review</a>
                                </div>
                                <div class="reviews__comment--area">
                                    @foreach($pwr as $proRev)
                                    <div class="reviews__comment--list d-flex">
                                        <!-- <div class="reviews__comment--thumb">
                                            <img src="{{ asset('web/assets/img/other/comment-thumb1.webp') }}" alt="comment-thumb">
                                        </div> -->
                                        <div class="reviews__comment--content">
                                            <div class="reviews__comment--top d-flex justify-content-between">
                                                <div class="reviews__comment--top__left">
                                                    <h3 class="reviews__comment--content__title h4">{{$proRev->name}}</h3>
                                                    <ul class="rating d-flex">
                                                        @if($proRev->review_rate)
                                                        @for ($i=1; $i <= 5; $i++) @if($i<=$proRev->review_rate)
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </li>
                                                            @else
                                                            <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </li>
                                                            @endif
                                                            @endfor
                                                            @else
                                                            @for ($i=1; $i <= 5; $i++) <li class="rating__list">
                                                                <span class="rating__icon">
                                                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M12.4141 4.53125L8.99219 4.03906L7.44531 0.921875C7.1875 0.382812 6.39062 0.359375 6.10938 0.921875L4.58594 4.03906L1.14062 4.53125C0.53125 4.625 0.296875 5.375 0.742188 5.82031L3.20312 8.23438L2.61719 11.6328C2.52344 12.2422 3.17969 12.7109 3.71875 12.4297L6.78906 10.8125L9.83594 12.4297C10.375 12.7109 11.0312 12.2422 10.9375 11.6328L10.3516 8.23438L12.8125 5.82031C13.2578 5.375 13.0234 4.625 12.4141 4.53125ZM9.53125 7.95312L10.1875 11.75L6.78906 9.96875L3.36719 11.75L4.02344 7.95312L1.25781 5.28125L5.07812 4.71875L6.78906 1.25L8.47656 4.71875L12.2969 5.28125L9.53125 7.95312Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                </li>
                                                                @endfor
                                                                @endif
                                                    </ul>
                                                </div>
                                                <span class="reviews__comment--content__date">{{date_format(date_create($proRev->created_date),"F d Y")}}</span>
                                            </div>
                                            <p class="reviews__comment--content__desc">{{$proRev->review}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div id="writereview" class="reviews__comment--reply__area">
                                    {!! Form::open(['route' => 'web.add-review', 'id' => 'submit-form','redirect'=>url('/product-details/$productWithSize->product_slug')]) !!}
                                    <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="rate_c">
                                                <input type="radio" id="star_5" name="rate_c" value="5" />
                                                <label for="star_5" title="text">5 stars</label>
                                                <input type="radio" id="star_4" name="rate_c" value="4" />
                                                <label for="star_4" title="text">4 stars</label>
                                                <input type="radio" id="star_3" name="rate_c" value="3" />
                                                <label for="star_3" title="text">3 stars</label>
                                                <input type="radio" id="star_2" name="rate_c" value="2" />
                                                <label for="star_2" title="text">2 stars</label>
                                                <input type="radio" id="star_1" name="rate_c" value="1" />
                                                <label for="star_1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-10">
                                            <textarea class="reviews__comment--reply__textarea" placeholder="Your Comments...." name="review_text" required></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-15">
                                            <label>
                                                <input class="reviews__comment--reply__input" placeholder="Your Name...." name="review_name" type="text" value="{{ (\Auth::check())?\Auth::user()->name:'' }}" required>
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-15">
                                            <label>
                                                <input class="reviews__comment--reply__input" placeholder="Your Email...." name="review_email" type="email" value="{{ (\Auth::check())?\Auth::user()->email:'' }}" required>
                                            </label>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$productWithSize->product_id}}">
                                        <input type="hidden" name="category_id" value="{{$productWithSize->category_id}}">
                                    </div>
                                    <button class="primary__btn text-white" data-hover="Submit" type="submit">SUBMIT</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div id="information" class="tab_pane">
                            <div class="product__tab--conten">
                                <div class="product__tab--content__step">
                                    <ul class="additional__info_list">
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Size</strong></span>
                                            <span class="info__list--item-content">
                                                <ul class="variant__size d-flex" id="labelList" style="flex-wrap: wrap;">
                                                    @foreach ($productSize->product_size as $r)
                                                    <li class="variant__size--list mb-2">
                                                        <label data-tab="{{$r->product_size}}" class="variant__size--value psize" for="weight{{$r->id}}">{{$r->product_size}}</label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End product details tab section -->

<!-- End product section -->
@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var labelList = document.getElementById("labelList");
        var tabContents = document.querySelectorAll(".tab-price");
        var inputElement = document.getElementById("inputValue");

        labelList.addEventListener("click", function(event) {
            var selectedTab = event.target.dataset.tab;

            if (selectedTab) {
                // Hide all tab contents
                tabContents.forEach(function(tab) {
                    tab.classList.remove("active");
                });
                inputElement.value = selectedTab;
                // Show selected tab content
                document.getElementById(selectedTab).classList.add("active");

                // Hide other list items
                var listItems = labelList.querySelectorAll("li");
                listItems.forEach(function(item) {
                    if (item.dataset.tab !== selectedTab) {
                        item.classList.remove("active");
                    } else {
                        item.classList.add("active");
                    }
                });
            }
        });
    });
</script>
@endsection