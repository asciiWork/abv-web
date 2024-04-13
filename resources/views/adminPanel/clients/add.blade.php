@extends('adminPanel.layout.appNew')
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
                            {!! Form::text('name', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Name']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 1<span class="required">*</span></label>
                            {!! Form::text('phone_1', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 2</label>
                            {!! Form::text('phone_2', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Phone 3</label>
                            {!! Form::text('phone_3', null, ['class' => 'form-control', 'data-required' => true,'placeholder' => 'Enter Phone']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Enter Email']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            {!! Form::textarea('address',null,['class' => 'form-control', 'data-required' => true]) !!}
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
@section('scripts')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js') }}"></script>
@endsection