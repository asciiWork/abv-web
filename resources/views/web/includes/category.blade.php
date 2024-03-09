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
                    <div class="categories__content style1">
                        <br/>
                        <h3 class="categories__content--title" style="font-size: 15px; border-top: 1px solid red; border-bottom: 1px solid red;">{{ $cat->category_name }}</h3>
                        <span class="categories__content--subtitle">({{$cat->p_count}} Items)</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>