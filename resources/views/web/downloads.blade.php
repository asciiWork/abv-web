@extends('web.layout.app')
@section('content')

<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title mb-20">My Profile</h2>
                @include('web.includes.profileList')
            </div>
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h2 mb-20"><i class="bi bi-cloud-download text-secondary"></i> Downloads</h2>
                    <div class="account__details two">
                        <p class="account__details--desc">No downloads available yet.</p>
                    </div>                    
                </div>
                <div >
                    <a class="primary__btn " href="{{ route('web.my-orders') }}">BACK TO LIST</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->

@endsection