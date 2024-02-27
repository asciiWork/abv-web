@extends('web.layout.app')
@section('content')
<link rel="stylesheet" type="text/css" href="">
<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title mb-20">My Profile</h2>
                @include('web.includes.profileList')
            </div>
            <div class="account__wrapper">
                <div class="align-left">
                    <div class="box-content">
                        <p class="mb-4"> Hello <strong class="account-text-user">{{ $userData->name}}</strong> (not <strong class="account-text-user">{{$userData->name}}</strong>?<a href="{{route ('logout') }}">Log out</a>)</p>
                        <p class="m-b-xl">From your account dashboard you can view your <a href="{{route ('web.my-orders') }}" class="link-primary">recent orders</a>, manage your <a href="{{route ('web.my-address') }}"  class="link-primary">shipping and billing addresses</a>, and <a href="{{ route('web.edit-account') }}"  class="link-primary">edit your password and account details</a>.</p>
                    </div>
                </div>
                <div class="account__content">
                    <div class="row py-4">
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{route ('web.my-orders') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-dropbox text-secondary"></i></h1>
                                <h4>ORDERS</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{ route('web.downloads') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-cloud-download text-secondary"></i></h1>
                                <h4>DOWNLOADS</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{ route('web.my-address') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-geo-alt-fill text-secondary"></i></h1>
                                <h4>ADDRESS</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{ route('web.edit-account') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-person text-secondary"></i></h1>
                                <h4>ACCOUNT DETAILS</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{ route('web.my-address') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-heart text-secondary"></i></h1>
                                <h4>WISHLIST</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 m-b-md">
                            <div class="border text-center">
                            <a href="{{ route('logout') }}" class="text-decoration-none">
                            <div class="box-content align-items-center py-4">
                                <h1><i class="bi bi-box-arrow-left text-secondary"></i></h1>
                                <h4>LOGOUT</h4>
                            </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->
@endsection