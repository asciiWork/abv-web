@extends('adminPanel.layouts.app')
@section('adminStyle')
<link rel="stylesheet" href="{{asset('admin-theme/assets/css/swiper-bundle.min.css')}}" />
<style type="text/css">
    .tab-price {
        display: none;
    }
    .tab-price.active {
        display: block;
    }
</style>
@endsection
@section('adminContent')
<div x-data="carousel">
    <div class="mb-6 flex flex-wrap items-center justify-center gap-4 lg:justify-end">
        <a href="{{ route('admin-products.index') }}" type="button" class="btn btn-primary gap-2" @click="back">
            <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg> Back to Product
        </a>        
    </div>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="panel">
            <div class="swiper mx-auto mb-5 max-w-3xl" id="slider4">
                <div class="swiper-wrapper">
                    @foreach($prImg as $pimg)
                    <div class="swiper-slide">
                        <img src="{{ asset('public/web/assets/img/product/main-product/') }}/{{ $pimg->product_img_url }}" class="w-full" alt="image" />
                        <div class="absolute bottom-8 left-1/2 z-[999] w-full -translate-x-1/2 px-11 text-center text-white sm:px-0">
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                <a
                    href="javascript:;"
                    class="swiper-button-prev-ex4 absolute top-1/2 z-[999] grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:left-2 rtl:right-2"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 rtl:rotate-180"
                    >
                        <path
                            d="M15 5L9 12L15 19"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
                <a
                    href="javascript:;"
                    class="swiper-button-next-ex4 absolute top-1/2 z-[999] grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:right-2 rtl:left-2"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ltr:rotate-180"
                    >
                        <path
                            d="M15 5L9 12L15 19"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="">
            <h3 class="mb-2 text-xl font-bold dark:text-white md:text-2xl">{{ $prObj->product_name }}</h3>
            <h3 class="text-lg font-semibold dark:text-white-light">₹{{ $prObj->product_min_price }} - ₹{{ $prObj->product_max_price }}</h3>
            <p class="text-base py-2">{{ $prObj->product_detail }}</p>
            @if($prObj->size_in_mm=='1')<p class="text-base py-1 font-bold">Size in MM</p>@endif
            @if($prObj->product_dimension!='')<p class="text-base py-1 font-bold">{{ $prObj->product_dimension }}</p>@endif
            <p class="text-base py-2"><span class="text-base font-bold">CATEGORIES : </span>{{ $catData->category_name }}</p>
            <p class="text-base py-2"><span class="text-base font-bold">Size : </span>
                <ol class="flex items-center flex-wrap text-gray-500 font-semibold dark:text-white-dark gap-y-4 py-2" id="labelList">
                    @foreach($prSize as $ps)
                    <li class="flex before:px-1.5">
                        <span class="p-2.5 border border-gray-500/20 rounded-md shadow flex items-center justify-center  dark:border-0 dark:bg-[#191e3a]" data-tab="{{$ps->product_size}}" x-tooltip="<strong>Click and see price</strong>">{{ $ps->product_size }}
                        </span>
                    </li>
                    @endforeach                    
                </ol>
            </p>
            @foreach($prSize as $r)
                <p class="text-base font-bold py-2 tab-price" id="{{$r->product_size}}">
                    Price : 
                    @if($r->product_old_price>0)
                        @if($r->product_old_price>0 && $r->product_current_price<=0) 
                            <strong>₹{{$r->product_old_price}}</strong>&nbsp;
                        @elseif($r->product_current_price!=$r->product_old_price)
                            <strong><s>₹{{$r->product_old_price}}</s></strong>&nbsp;
                        @endif
                    @endif
                    @if($r->product_current_price>0)
                        <strong>₹{{$r->product_current_price}}</strong>
                    @endif
                </p>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('adminscript')
<script src="{{ asset('public/admin-theme/assets/js/swiper-bundle.min.js')}}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var labelList = document.getElementById("labelList");
    var tabContents = document.querySelectorAll(".tab-price");

    labelList.addEventListener("click", function(event) {
        var selectedTab = event.target.dataset.tab;
        if (selectedTab) {
            // Hide all tab contents
            tabContents.forEach(function(tab) {
                tab.classList.remove("active");
            });
            
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
document.addEventListener('alpine:init', () => {
    Alpine.data('carousel', () => ({
        init() {   
            const swiper4 = new Swiper('#slider4', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    type: 'fraction',
                },
                navigation: {
                    nextEl: '.swiper-button-next-ex4',
                    prevEl: '.swiper-button-prev-ex4',
                },
            });
        },
    }));
});
</script>
@endsection