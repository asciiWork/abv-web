@extends('web.layout.app')
@section('content')
<!-- Start login section  -->
<div class="login__section section--padding">
    <div class="container">
        {!! Form::open(['route' => 'web.check-register', 'id' => 'submit-form']) !!}
        <div class="login__section--inner">
            <div class="row row-cols-md-2 justify-content-center">
                <div class="col">
                    <div class="account__login register">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-10">Create an Account</h2>
                            <p class="account__login--header__desc">Register here if you are a new customer</p>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="name" name="name" type="text">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Email Address" name="email" type="email">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Password" name="password" type="password">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Confirm Password" name="cpassword" type="password">
                            </label>
                            <button class="account__login--btn primary__btn mb-10" type="submit">Register</button>
                            <div class="account__login--remember position__relative">
                                <input class="checkout__checkbox--input" id="check2" type="checkbox" name="term" required>
                                <span class="checkout__checkbox--checkmark"></span>
                                <label class="checkout__checkbox--label login__remember--label" for="check2">
                                    I have read and agree to the terms & conditions</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- End login section  -->
@endsection