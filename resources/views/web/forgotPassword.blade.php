@extends('web.layout.app')
@section('content')
<!-- Start login section  -->
<div class="login__section section--padding">
    <div class="container">
        {!! Form::open(['route' => 'web.forgot-password.post', 'id' => 'submit-form', 'redirect'=>url('/')]) !!}
        <div class="login__section--inner">
            <div class="row row-cols-md-2 justify-content-center">
                <div class="col">
                    <div class="account__login">
                        <div class="account__login--header mb-25">
                            <h2 class="account__login--header__title mb-10">Forgot password</h2>
                        </div>
                        <div class="account__login--inner">
                            <label>
                                <input class="account__login--input" placeholder="Email Addres" name="email" type="email">
                            </label>
                            <button class="account__login--btn primary__btn" id="submit-form-button" type="submit">Submit</button>
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