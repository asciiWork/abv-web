@extends('adminPanel.layouts.appNew')
@section('content')

{!! Form::model($formObj,['method' => $method,'files' => true, 'route' => [$action_url,$action_params],'class' => '', 'id' => 'module-frm', 'redirect-url' => route($back_url)]) !!}
<div class="row">
    <div class="col-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{$page_title}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Product Name<span class="text-danger">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('name', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Name']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">HSN Code</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('company_name', null, ['class' => 'form-control','placeholder' => 'Enter Company Name']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Starting Items</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Enter Email']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-chat-left-text"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Shipped Items<span class="text-danger">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone_1', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">On Hand Items</label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone_2', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
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
</div>
{!! Form::close() !!}
@endsection
@section('adminScript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?2455345') }}"></script>
@endsection