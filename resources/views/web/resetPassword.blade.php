@extends('web.layout.app')
@section('content')
<!-- Start login section  -->
<div class="login__section section--padding">
    <div class="container">
        {!! Form::open(['route' => 'web.reset-password', 'id' => 'submit-form', 'redirect'=>url('/')]) !!}
        <div class="login__section--inner">
            <div class="row row-cols-md-2 justify-content-center">
                <div class="col">
                    <div class="account__login">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-10">Reset Password</h2>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Email Addres" name="email" type="email" required="required">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Password" name="password" type="password" required="required" autocomplete="off">
                            </label>
                            <label>
                                <input class="account__login--input" placeholder="Confirm password" name="password_confirmation" type="password" required="required" autocomplete="off">
                            </label>
                            <input type="hidden" name="activation_key" value="{{ $activation_key }}">
                            <button class="account__login--btn primary__btn" id="submit-form-button" type="submit">Update</button>
                            <p class="account__login--signup__text"> <a href="{{ route('web.login') }}">Back to login</a></p>
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