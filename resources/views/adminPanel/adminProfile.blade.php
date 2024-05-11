@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row">
    <div class="col-12 col-lg-8 col-xl-12">
        <div class="card overflow-hidden">
            <div class="profile-cover bg-dark position-relative mb-4">
                <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
                    <img src="{{ $userimg }}" alt="...">
                </div>
            </div>
            <div class="card-body">
                <div class="mt-5 d-flex align-items-start justify-content-between">
                    <div class="">
                        <h3 class="mb-2">{{ $userData->name }}</h3>
                        <div class="">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header px-4 py-3 bg-transparent">
                <h5 class="mb-3">My Profile</h5>
            </div>
            <div class="card-body p-4">
                {!! Form::model($userData,['method' => 'POST', 'route' => 'update-admin-account','class'=>'row g-3 needs-validation', 'id' => 'module-frm','redirect-url'=>route($back_url)]) !!}
                <form class="row g-3 needs-validation" novalidate="">
                    <div class="col-md-6">
                        <label class="form-label">Name<span class="text-danger">*</span></label>
                        <div class="position-relative input-icon">
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Name','required'=>'required']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-person"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email<span class="text-danger">*</span></label>
                        <div class="position-relative input-icon">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Email','required'=>'required']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-chat-left-text"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone<span class="text-danger">*</span></label>
                        <div class="position-relative input-icon">
                            {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'Enter Phone','required'=>'required']) !!}
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-telephone"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Password (leave blank to leave unchanged)</label>
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="bsValidation4" placeholder="Current Password" name="current_password">
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">New Password (leave blank to leave unchanged)</label>
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="bsValidation5" placeholder="New Password" name="password">
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="bsValidation6" placeholder="Confirm New Password" name="password_confirmation">
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                            <button type="reset" class="btn btn-light px-4">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="col-12 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Location</h5>
                <p class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Kalkio Network</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Connect</h5>
                <p class=""><i class="bi bi-browser-edge me-2"></i>https://abvtool.in/</p>
                <p class=""><i class="bi bi-phone me-2"></i>{{ $userData->phone }}</p>
                <p class=""><i class="bi bi-envelope me-2"></i>{{ $userData->email }}</p>
            </div>
        </div>
    </div> -->
</div>
@endsection

@section('adminScript')
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?12345') }}"></script>
@endsection