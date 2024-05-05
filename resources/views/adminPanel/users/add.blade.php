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
                            <label class="form-label">Name<span class="required">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('name', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Name']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="required">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('phone', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Email<span class="required">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::text('email', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Email']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-chat-left-text"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    @if(!$isEdit)
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Password <span class="required">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::password('password',['class' => 'form-control','data-required' => 'true','placeholder'=>'Enter Password']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password <span class="required">*</span></label>
                            <div class="position-relative input-icon">
                                {!! Form::password('confirm_password',['class' => 'form-control','data-required' => 'true','placeholder'=>'Enter Confirm Password']) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="position-relative input-icon">
                                {!! Form::select('status',[1=>'Active',0=>'Inactive'],null,['class' => 'form-control', 'data-required' => true]) !!}
                                <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="submit_btn">{{ $buttonText}}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @if(isset($devices) && !empty($devices))
        <div class="col-12 col-lg-6 col-xl-5 d-flex">
            <div class="card w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h6 class="mb-0 fw-bold">Logged In Devices</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="team-list">
                        @foreach($devices as $device)
                        <div class="d-flex align-items-center gap-3 border-start border-success border-4 border-0 px-2 py-1">
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">{{$device->user_agent}}</h6>
                                <span class="">{{$device->last_logged_at}}</span>
                            </div>
                            <div class="form-check form-switch form-check-success border-0">
                                {{$device->ip_address}}
                            </div>
                        </div>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('adminScript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?1234') }}"></script>
@endsection