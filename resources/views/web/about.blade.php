@extends('web.layout.app')
@section('content')

<!-- Start about section -->
<section class="about__section section--padding mb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about__thumb d-flex">
                    <div class="about__thumb--items">
                        <img class="about__thumb--img border-radius-5" src="{{ asset('web/assets/img/other/abv-500x500.png') }}" alt="about-thumb">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <h2 class="about__content--maintitle mb-25">Welcome to ABV Tools - Leading CNC machine tool Supplier and Manufacturer in India</h2>
                    <p class="about__content--desc mb-20">Welcome to ABV TOOLS! We are your ultimate destination for all things related to CNC machine auto part tools. Whether you’re a seasoned professional or just starting out in the world of CNC machining, our website offers a comprehensive range of high-quality tools and accessories to meet your specific needs. Our team of experts has carefully curated a diverse selection of CNC machine parts, ensuring precision, durability, and efficiency in every product we offer. From cutting-edge technologies to classic essentials, we take pride in catering to hobbyists, small businesses, and large industries alike. With a user-friendly interface, secure transactions, and prompt delivery, we strive to provide an unparalleled online shopping experience for all CNC enthusiasts. Discover the tools that will elevate your machining projects to new heights with www.abvtools.in .</p>
                    <p class="about__content--desc mb-25">At the core of ABV TOOLS lies an unwavering commitment to technological advancement and customer satisfaction. Our dedication to constant improvement drives us to stay at the forefront of the CNC machine tool industry. By partnering with reputable manufacturers and collaborating with leading minds in the field, we remain at the cutting edge of innovation, delivering products that keep pace with the ever-changing demands of modern machining</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End about section -->

<!-- Start counterup banner section -->
<div class="counterup__banner--section counterup__banner__bg2" id="funfactId">
    <div class="container">
        <div class="row row-cols-1 align-items-center">
            <div class="col">
                <div class="counterup__banner--inner position__relative d-flex align-items-center justify-content-between">
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">Business Year</h2>
                        <span class="counterup__number js-counter" data-count="8">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">City Supplier</h2>
                        <span class="counterup__number js-counter" data-count="800">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">Success Ratio</h2>
                        <span class="counterup__number js-counter" data-count="95">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">Top Professionals </h2>
                        <span class="counterup__number js-counter" data-count="10">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End counterup banner section -->

<!-- Start testimonial section -->
<section class="testimonial__section testimonial__bg section--padding pt-0">
    <div class="container">
        <div class="section__heading style2 text-center mb-40">
            <h2 class="section__heading--maintitle">What People Are Saying</h2>
        </div>
        <div class="testimonial__section--inner">
            <div class="testimonial__active--one  swiper">
                <div class="swiper-wrapper">
                    @foreach($proReview as $proRev)
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb1.webp') }}" alt="testimonial-img">
                        </div>
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
            <div class="testimonial__active--two swiper">
                <div class="swiper-wrapper">
                    @foreach($proReview as $proRev)
                    <div class="swiper-slide">
                        <div class="testimonial__items--content">
                            <p class="testimonial__items--desc">{{$proRev->review}}</p>
                            @if($proRev->review_rate)
                            <ul class="rating testimonial__rating d-flex justify-content-center">
                                @for ($i=1; $i <= 5; $i++)
                                    @if($i<=$proRev->review_rate)
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
                            </ul>
                            <span class="testimonial__items--subtitle">{{$proRev->name}}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End testimonial section -->
@endsection