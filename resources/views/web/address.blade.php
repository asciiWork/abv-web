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
            @if($formObj)
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h2 mb-20"> <i class="bi bi-geo-alt-fill text-secondary"></i> {{ ($formObj->is_ship==0)?'Billing':'Shipping' }} Address</h2>
                    <p>The following addresses will be used on the checkout page by default.</p>                    
                    <div class="row">
                        {!! Form::model($formObj,['method' => 'POST', 'route' => 'update-address', 'id' => 'submit-form','redirect-url'=>route('web.my-address')]) !!}

                            {!! Form::hidden('id',null) !!}
                            <div class="row" id="address-form">
                                <div class="col-md-6">
                                    <span>Name </span>
                                    {!! Form::text('name',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter Name','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Company </span>
                                    {!! Form::text('company',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter company']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Street </span>
                                    {!! Form::text('street',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter street','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Area </span>
                                    {!! Form::text('area',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter area','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>City </span>
                                    {!! Form::text('city',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter city','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Country </span>
                                    {!! Form::select('country',[''=>'Select Country'],null,['class'=>'contact__form--input','id'=>'country','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Zipcode </span>
                                    {!! Form::text('zipcode',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter zipcode','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>State </span>
                                    {!! Form::select('state',[''=>'Select State'],null,['class'=>'contact__form--input','id'=>'state','required'=>'required']) !!}
                               </div>
                               <div class="col-md-6">
                                    <span>Phone </span>
                                    {!! Form::text('phone',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter phone','required'=>'required']) !!}
                               </div>
                               @if($formObj->is_ship==0)
                                   <div class="col-md-6">
                                        <span>GST Number (optional) </span>
                                        {!! Form::text('gst_number',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter GST Number']) !!}
                                   </div>
                                   <div class="col-md-6">
                                        <span>Email address </span>
                                        {!! Form::text('contact_email',null,['class'=>'checkout__input--field border-radius-5','placeholder'=>'Enter Email','required'=>'required']) !!}
                                   </div>
                                @endif
                            </div>
                            <div class="account__details--footer d-flex">
                                <button name="button" type="submit"class="account__details--footer__btn">Save</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @else
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h2 mb-20"> <i class="bi bi-geo-alt-fill text-secondary"></i> Addresses</h2>
                    <p>The following addresses will be used on the checkout page by default.</p>                    
                    <div class="row">
                        @if($addData)
                            @foreach($addData as $a)
                            <div class="col-sm-6">
                                <div class="account__details two">
                                    <h3 class="account__details--title h4">{{ ($a->is_ship==0)?'Billing':'Shipping' }} Address</h3>
                                    <p class="account__details--desc">
                                            {{$a->name}} <br>
                                            {{$a->street}}  {{$a->street}}<br>
                                            {{$a->city}} {{$a->zipcode}}<br>
                                            {{$a->state}}<br>
                                            {{$a->phone}}<br>
                                    </p>
                                </div>
                                <div class="account__details--footer d-flex">
                                   <a class="account__details--footer__btn" type="button" href="{{ url('my-address?id='.$a->id) }}">Edit Address</a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- my account section end -->

@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
        var country= '<?php echo (!empty($formObj->country) ? $formObj->country : '""'); ?>';
        var state= '<?php echo (!empty($formObj->state) ? $formObj->state : '""'); ?>';
        $("#country").val(country).change();
        $("#state").val(state).change();
});
</script>
@endsection