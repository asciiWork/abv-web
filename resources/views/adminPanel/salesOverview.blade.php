@extends('adminPanel.layouts.appNew')

@section('content')

<div class="row">
    <div class="col-12 col-lg-4 d-flex">
        <div class="card w-100">
            <div class="card-body">
                <div class="customer-profile text-center">
                    <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png') }}" width="120" height="120" class="rounded-circle" alt="">
                    <div class="mt-4">
                        <h5 class="mb-1 customer-name fw-bold">Jhon Maxwell</h5>
                        <p class="mb-0 customer-designation">UI Engineer</p>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <b>Address</b>
                    <br>
                    123 Street Name, City, Australia
                </li>
                <li class="list-group-item">
                    <b>Email</b>
                    <br>
                    mail@example.com
                </li>
                <li class="list-group-item">
                    <b>Phone</b>
                    <br>
                    Toll Free (123) 472-796
                    <br>
                    Mobile : +91-9910XXXX
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-8 d-flex row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Today Order</p>
                            <h4 class="mb-0 text-primary">248</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-primary text-white">
                            <i class="bi bi-basket2-fill"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4.5px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Monthly Order</p>
                            <h4 class="mb-0 text-success">$1,245</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-success text-white">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4.5px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Total Order</p>
                            <h4 class="mb-0 text-danger">24.25%</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-danger text-white">
                            <i class="bi bi-graph-down-arrow"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4.5px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Total Sales</p>
                            <h4 class="mb-0 text-warning">214</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-warning text-dark">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4.5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
 

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Sales Overview Daily</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Sales Overview Weekly</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Sales Overview Monthly</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold">Sales Overview Yearly</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
</div>
@endsection