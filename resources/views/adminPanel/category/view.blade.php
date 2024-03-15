@extends('adminPanel.layouts.app')
@section('adminStyle')
<link rel="stylesheet" href="{{asset('admin-theme/assets/css/swiper-bundle.min.css')}}" />
@endsection
@section('adminContent')
<div x-data="carousel">
    <div class="mb-6 flex flex-wrap items-center justify-center gap-4 lg:justify-end">
        <a href="{{ route('admin-category.index') }}" type="button" class="btn btn-primary gap-2" @click="back">
            <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg> Back to Category
        </a>        
    </div>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="max-w-[19rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
            <div class="py-7 px-6">
                <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr overflow-hidden">
                    <img src="{{ asset('web/assets/img/categories/') }}/{{ $catData->cat_img }}" alt="image" class="w-full h-full object-cover" />
                </div>
                <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">{{$catData->category_name}}</h5>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminscript')
<script src="{{ asset('admin-theme/assets/js/swiper-bundle.min.js')}}"></script>
<script>
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
