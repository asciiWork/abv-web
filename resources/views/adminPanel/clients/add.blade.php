@extends('adminPanel.layouts.appNew')
@section('content')

{!! Form::model($formObj,['method' => $method,'files' => true, 'route' => [$action_url,$action_params],'class' => '', 'id' => 'module-frm', 'redirect-url' => route($back_url)]) !!}
<div class="row">
    <div class="col-12 col-lg-7 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Basic Info</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Client Name<span class="text-danger">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('name', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Name']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('company_name', null, ['class' => 'form-control','placeholder' => 'Enter Company Name']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Enter Email']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-chat-left-text"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 1<span class="text-danger">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone_1', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 2</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone_2', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 3</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone_3', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">GSTIN</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('gstn', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter GSTN']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-file"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-right">
                    <button type="submit" class="btn btn-primary " id="submit_btn">{{ $buttonText}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5 col-xl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Billing Address</h5>
                <div class="row">
                    <div class="col-lg-12 mb-1">
                        <label class="form-label">Street Address</label>
                        {!! Form::textarea('address',null,['class' => 'form-control', 'data-required' => true, 'rows'=>3]) !!}
                    </div>
                    <div class="col-lg-12 mb-1">
                        <label class="form-label">Landmark</label>
                        {!! Form::text('landmark',null,['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Landmark']) !!}
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">City</label>
                        <div class="position-relative input-icon">
                            {!! Form::text('city', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter City']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">State<span class="text-danger">*</span></label>
                        <div class="position-relative input-icon">
                            {!! Form::select('state', [''=>'Select State']+$stateList,null, ['class' => 'form-control', 'data-required' => true]) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">Pincode</label>
                        <div class="position-relative input-icon">
                            {!! Form::text('pincode', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Pincode']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Shipping Address</h5>
                <div class="row">
                    <div class="col-lg-12 mb-1">
                        <label class="form-label">Street Address</label>
                        {!! Form::textarea('ship_address',null,['class' => 'form-control', 'data-required' => true, 'rows'=>3]) !!}
                    </div>
                    <div class="col-lg-12 mb-1">
                        <label class="form-label">Landmark</label>
                        {!! Form::text('ship_landmark',null,['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Landmark']) !!}
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">City</label>
                        <div class="position-relative input-icon">
                            {!! Form::text('ship_city', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter City']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">State</label>
                        <div class="position-relative input-icon">
                            {!! Form::select('ship_state', [''=>'Select State']+$stateList,null, ['class' => 'form-control', 'data-required' => true]) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">Pincode</label>
                        <div class="position-relative input-icon">
                            {!! Form::text('ship_pincode', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Pincode']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('adminScript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?2455345') }}"></script>
@endsection