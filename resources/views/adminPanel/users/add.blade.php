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
                            <label  class="form-label">Name<span class="required">*</span></label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Name']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label  class="form-label">Phone<span class="required">*</span></label>
                            {!! Form::text('phone', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                        </div>
                    </div>
                    @if(!$isEdit)
                        <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Password <span class="required">*</span></label>
                            {!! Form::password('password',['class' => 'form-control','data-required' => 'true','placeholder'=>'Enter Password']) !!}
                        </div>
                        </div>
                    @endif
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label  class="form-label">Email<span class="required">*</span></label>
                            {!! Form::text('email', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Email']) !!}
                        </div>
                    </div>
                    @if(!$isEdit)
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password <span class="required">*</span></label>
                            {!! Form::password('confirm_password',['class' => 'form-control','data-required' => 'true','placeholder'=>'Enter Confirm Password']) !!}
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                                {!! Form::select('status',[1=>'Active',0=>'Inactive'],null,['class' => 'form-control', 'data-required' => true]) !!}
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
@section('adminscript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?1234') }}"></script>
@endsection