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
            @if($userData)
              <div class="account__wrapper">
                  <div class="account__content">
                      <h2 class="account__content--title h2 mb-20"> <i class="bi bi-person text-secondary"></i> Account details</h2>
                      <div class="row">
                          {!! Form::model($userData,['method' => 'POST', 'route' => 'update-account', 'id' => 'submit-form','redirect-url'=>route('web.edit-account')]) !!}
                              <div class="row" id="account-form">
                                  <div class="col-md-12">
                                      <span>Name </span><span class="contact__form--label__star">*</span>
                                      {!! Form::text('name',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter Name','required'=>'required']) !!}
                                  </div>
                                  <div class="col-md-12">
                                      <span>Display name </span><span class="contact__form--label__star">*</span>
                                      {!! Form::text('display_name',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter Name','required'=>'required']) !!}
                                      <span>This will be how your name will be displayed in the account section and in reviews</span>
                                  </div>
                                  <div class="col-md-12">
                                      <span>Name </span><span class="contact__form--label__star">*</span>
                                      {!! Form::text('email',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter Name','required'=>'required']) !!}
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkout__sidebar sidebar border-radius-10 my-5">
                                      <h4>PASSWORD CHANGE</h4>
                                      <div class="col-md-12">
                                          <span>Current Password (leave blank to leave unchanged)</span>
                                          <input type="password" name="current_password" class="checkout__input--field border-radius-5">
                                      </div>
                                      <div class="col-md-12">
                                          <span>New Password (leave blank to leave unchanged)</span>
                                          <input type="password" name="password" class="checkout__input--field border-radius-5">
                                      </div>
                                      <div class="col-md-12">
                                          <span>Confirm New Password</span>
                                          <input type="password" name="password_confirmation" class="checkout__input--field border-radius-5">
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="account__details--footer d-flex">
                                  <button name="button" type="submit"class="account__details--footer__btn">Save Changes</button>
                              </div>
                          {!! Form::close() !!}
                      </div>
                  </div>
              </div>
            @endif
        </div>
    </div>
</section>
<!-- my account section end -->
@endsection