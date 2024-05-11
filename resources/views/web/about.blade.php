@extends('web.layout.app')
@section('content')

<!-- Start about section -->
<section class="about__section section--padding mb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about__thumb d-flex">
                    <div class="about__thumb--items">
                        <img class="about__thumb--img border-radius-5" src="{{ asset('public/web/assets/img/other/abv-500x500.png') }}" alt="about-thumb">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <span class="about__content--subtitle text__secondary mb-20"> Why Choose us</span>
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
<section class="testimonial__section testimonial__bg section--padding">
    <div class="container">
        <div class="section__heading style2 text-center mb-40">
            <h2 class="section__heading--maintitle">Our Customers</h2>
        </div>
        <div class="testimonial__section--inner">
            <div class="testimonial__active--one  swiper testimonialList">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('public/web/assets/img/logo/anovi.png') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('public/web/assets/img/logo/kgs.png') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('public/web/assets/img/logo/sumip.png') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('public/web/assets/img/logo/tilara.png') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('public/web/assets/img/logo/woodsden.png') }}" alt="testimonial-img">
                        </div>
                    </div>
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End counterup banner section -->
@endsection