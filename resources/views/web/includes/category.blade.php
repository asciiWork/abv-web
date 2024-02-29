<section class="categories__section section--padding">
    <div class="container">
        <div class="section__heading border-bottom mb-30">
            <h2 class="section__heading--maintitle"><span>Categories</span></h2>
        </div>
        <div class="categories__inner--style3 d-flex">
            @foreach($Catdata as $cat)
                <div class="categories__card--style3 text-center">
                <a class="categories__card--link" href="{{ URL::to('product-category/') }}/{{$cat->cat_slug}}">
                    <div class="categories__thumbnail">
                        <img class="categories__thumbnail--img" src="{{ asset('web/assets/img/categories/') }}/{{ $cat->cat_img }}" alt="categories-img">
                    </div>
                    <div class="categories__content style3">
                        <h2 class="categories__content--title">{{ $cat->category_name }}</h2>
                        <span class="categories__content--subtitle">View All Products</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>