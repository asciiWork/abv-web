@extends('web.layout.app')
@section('content')
<!-- Start breadcrumb section -->
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>About Us</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->

<!-- Start about section -->
<section class="about__section section--padding mb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about__thumb d-flex">
                    <div class="about__thumb--items">
                        <img class="about__thumb--img border-radius-5" src="{{ asset('web/assets/img/other/about-thumb-list1.webp') }}" alt="about-thumb">
                    </div>
                    <div class="about__thumb--items position__relative">
                        <img class="about__thumb--img border-radius-5" src="{{ asset('web/assets/img/other/about-thumb-list2.webp') }}" alt="about-thumb">
                        <div class="banner__bideo--play about__thumb--play">
                            <a class="banner__bideo--play__icon about__thumb--play__icon glightbox" href="https://vimeo.com/115041822" data-gallery="video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 31 37">
                                    <path id="Polygon_1" data-name="Polygon 1" d="M16.783,2.878a2,2,0,0,1,3.435,0l14.977,25.1A2,2,0,0,1,33.477,31H3.523a2,2,0,0,1-1.717-3.025Z" transform="translate(31) rotate(90)" fill="currentColor" />
                                </svg>
                                <span class="visually-hidden">bideo play</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <span class="about__content--subtitle text__secondary mb-20"> Why Choose us</span>
                    <h2 class="about__content--maintitle mb-25">We do not buy from the open market & traders.</h2>
                    <p class="about__content--desc mb-20">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit illo, est repellendus are quia voluptate neque reiciendis ea placeat labore maiores cum, hic ducimus ad a dolorem soluta consectetur adipisci. Perspiciatis quas ab quibusdam is.</p>
                    <p class="about__content--desc mb-25">Itaque accusantium eveniet a laboriosam dolorem? Magni suscipit est corrupti explicabo non perspiciatis, excepturi ut asperiores assumenda rerum? Provident ab corrupti sequi, voluptates repudiandae eius odit aut.</p>
                    <div class="about__author position__relative">
                        <h3 class="about__author--name h4">Bruce Sutton</h3>
                        <span class="about__author--rank">Spa Manager</span>
                        <img class="about__author--signature" src="{{ asset('web/assets/img/icon/signature.webp') }}" alt="signature">
                    </div>
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
                        <h2 class="counterup__title">YEARS OF <br>
                            FOUNDATION</h2>
                        <span class="counterup__number js-counter" data-count="50">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">SKILLED TEAM <br>
                            MEMBERS </h2>
                        <span class="counterup__number js-counter" data-count="100">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">HAPPY <br>
                            CUSTOMERS</h2>
                        <span class="counterup__number js-counter" data-count="80">0</span>
                    </div>
                    <div class="counterup__items text-center">
                        <h2 class="counterup__title">MONTHLY <br>
                            ORDERS</h2>
                        <span class="counterup__number js-counter" data-count="70">0</span>
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
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb1.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb2.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb3.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb4.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb5.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--thumbnail">
                            <img class="testimonial__items--thumbnail__img" src="{{ asset('web/assets/img/other/testimonial-thumb4.webp') }}" alt="testimonial-img">
                        </div>
                    </div>
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
                    <div class="swiper-slide">
                        <div class="testimonial__items--content">
                            <p class="testimonial__items--desc">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                            <ul class="rating testimonial__rating d-flex justify-content-center">
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
                            </ul>
                            <span class="testimonial__items--subtitle">Calire copper</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial__items--content">
                            <p class="testimonial__items--desc">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                            <ul class="rating testimonial__rating d-flex justify-content-center">
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
                            </ul>
                            <span class="testimonial__items--subtitle">Calire copper</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End testimonial section -->
@endsection