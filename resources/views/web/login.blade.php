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
                        <li class="breadcrumb__content--menu__items"><span>Account</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->

<!-- Start login section  -->
<div class="login__section section--padding">
    <div class="container">
        <form action="#">
            <div class="login__section--inner">
                <div class="row row-cols-md-2 justify-content-center">
                    <div class="col">
                        <div class="account__login">
                            <div class="account__login--header mb-25">
                                <h2 class="account__login--header__title mb-10">Login</h2>
                                <p class="account__login--header__desc">Login if you area a returning customer.</p>
                            </div>
                            <div class="account__login--inner">
                                <label>
                                    <input class="account__login--input" placeholder="Email Addres" type="email">
                                </label>
                                <label>
                                    <input class="account__login--input" placeholder="Password" type="password">
                                </label>
                                <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                    <div class="account__login--remember position__relative">
                                        <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="check1">
                                            Remember me</label>
                                    </div>
                                    <button class="account__login--forgot" type="submit">Forgot Your Password?</button>
                                </div>
                                <button class="account__login--btn primary__btn" type="submit">Login</button>
                                <div class="account__login--divide">
                                    <span class="account__login--divide__text">OR</span>
                                </div>
                                <p class="account__login--signup__text">Don,t Have an Account? <button type="submit">Sign up now</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End login section  -->
@endsection