@extends('web.layout.app')
@section('content')

<!-- Start portfolio section -->
<section class="portfolio__section section--padding">
    <div class="container">
        <div class="section__heading border-bottom mb-40">
            <h2 class="section__heading--maintitle">Watch Our Portfolio</h2>
        </div>
        <div class="portfolio__section--inner">
            <div class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 mb--n30">
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio1.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio1.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio2.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio2.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio3.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio3.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio4.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio4.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio5.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio5.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col mb-30">
                    <div class="portfolio__items">
                        <div class="portfolio__items--thumbnail position__relative">
                            <a class="portfolio__items--thumbnail__link display-block glightbox" data-gallery="portfolio" href="{{ asset('web/assets/img/other/portfolio1.webp') }}"><img class="portfolio__items--thumbnail__img" src="{{ asset('web/assets/img/other/portfolio1.webp') }}" alt="portfolio-img">
                                <div class="portfolio__view--icon">
                                    <span class="portfolio__view--icon__link "><svg xmlns="http://www.w3.org/2000/svg" width="25.697" height="20.066" viewBox="0 0 39.697 27.066">
                                            <path d="M20.849,4.5A21.341,21.341,0,0,0,1,18.033a21.322,21.322,0,0,0,39.7,0A21.341,21.341,0,0,0,20.849,4.5Zm0,22.555a9.022,9.022,0,1,1,9.022-9.022A9.025,9.025,0,0,1,20.849,27.055Zm0-14.435a5.413,5.413,0,1,0,5.413,5.413A5.406,5.406,0,0,0,20.849,12.62Z" transform="translate(-1 -4.5)" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End portfolio section -->
@endsection