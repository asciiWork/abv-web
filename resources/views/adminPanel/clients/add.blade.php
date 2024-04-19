@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{$page_title}}</h4>
            </div>
            <div class="card-body">
                {!! Form::model($formObj,['method' => $method,'files' => true, 'route' => [$action_url,$action_params],'class' => '', 'id' => 'module-frm', 'redirect-url' => route($back_url)]) !!}
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
                            <label class="form-label">Pincode</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('pincode', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Pincode']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('state', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter State']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('city', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter City']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-geo-alt"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            {!! Form::textarea('address',null,['class' => 'form-control', 'data-required' => true, 'rows'=>3]) !!}
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="submit_btn">{{ $buttonText}}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminScript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?2455345') }}"></script>
@endsection