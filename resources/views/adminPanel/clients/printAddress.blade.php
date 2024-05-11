@extends('adminPanel.layouts.appNew')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Print {{$page_title}}</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['method' => 'Post','route' => ['admin-clients.search-address'],'id' => 'search-module-frm', 'redirect-url' => '']) !!}
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-4">
                            <label class="form-label">Client Name</label>
                            {!! Form::text('search_name', null, ['class' => 'form-control','placeholder'=>'Search Name']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-4">
                            <label class="form-label">Company Name</label>
                            {!! Form::text('search_company', null, ['class' => 'form-control','placeholder'=>'Search Company']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-4">
                            <label class="form-label">Phone</label>
                            {!! Form::text('search_phone', null, ['class' => 'form-control','placeholder'=>'Search Phone']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-4 mt-4 text-center">
                            <button type="submit" class="btn btn-primary" id="search_form_btn">Search</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <hr />
                <div><br /><br /></div>
                <div class="col-12 col-lg-4 col-xl-3">
                    <address class="m-t-5 m-b-5" id="printableText">
                        <strong class="text-inverse">To,</strong><br>
                        <strong class="text-inverse" id="client-company">Company Name</strong><br>
                        <strong class="text-inverse" id="client-name">Client Name</strong><br>
                        <span id="client-address">Street Address</span><br>
                        <span id="client-landmark">Landmark</span><br>
                        <span id="client-city">City</span>, <span id="client-pincode">Pin code</span><br>
                        <span id="client-state">State</span><br>
                        Mo: <span id="client-phone">Mobile Number</span><br>
                    </address>
                </div>
                <br />
                <div class="mb-3 text-center">
                    <button type="button" onclick="printText()" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminScript')
<script>
    function printText() {
        var printContent = document.getElementById("printableText").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?024545485') }}"></script>
@endsection