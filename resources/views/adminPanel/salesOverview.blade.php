@extends('adminPanel.layouts.appNew')
@section('adminStyle')
<style type="text/css">
    .apexcharts-tooltip.apexcharts-theme-light {
        color: black;
    }
</style>
@endsection
@section('content')
<?php $img = \App\Models\Admin::getAvtar($userData->image); ?>

<div class="row">
    <div class="col-12 col-lg-4 d-flex">
        <div class="card w-100">
            <div class="card-body">
                <div class="customer-profile text-center">
                    <img src="{{ $img }}" width="120" height="120" class="rounded-circle" alt="">
                    <div class="mt-4">
                        <h5 class="mb-1 customer-name fw-bold">{{$userData->name}}</h5>
                        <p class="mb-0 customer-designation">Admin</p>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <!-- <li class="list-group-item">
                    <b>Address</b>
                    <br>
                    123 Street Name, City, Australia
                </li> -->
                <li class="list-group-item">
                    <b>Email</b>
                    <br>
                    {{ $userData->email }}
                </li>
                <li class="list-group-item">
                    <b>Phone</b>
                    <br>
                    {{ $userData->phone }}
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Today Order</p>
                                <h4 class="mb-0 text-primary">{{ $totalOrdersToday }}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Weekly Order</p>
                                <h4 class="mb-0 text-success">{{ $totalOrderWeekly }}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Monthly Order</p>
                                <h4 class="mb-0 text-danger">{{ $MonthlyOrders }}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Yearly Order</p>
                                <h4 class="mb-0 text-warning">₹{{ $yearOrders }}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-primary border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Today Sale</p>
                                <h4 class="mb-0 text-primary">₹{{ number_format( $totalSaleToday,2)}}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Weekly Sale</p>
                                <h4 class="mb-0 text-success">₹{{ number_format( $totalSaleWeekly,2) }}</h4>
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
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-danger border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Monthly Sale</p>
                                <h4 class="mb-0 text-danger">₹{{ number_format($monthlySale,2) }}</h4>
                            </div>
                            <div class="ms-auto widget-icon bg-danger text-white">
                                <i class="bi bi-graph-down-arrow"></i>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 4.5px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card radius-10 border-0 border-start border-warning border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Yearly Sale</p>
                                <h4 class="mb-0 text-warning">₹{{ number_format($yearSale,2) }}</h4>
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
                <div id="chart2"></div>
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
                <div id="chart3"></div>
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
                <div id="chart4"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminScript')
<script type="text/javascript">
    var dailyOverviewTot = <?php echo json_encode($dailySalesOverview['dailyOverviewTot']); ?>;
    var salesdayName = <?php echo json_encode($dailySalesOverview['salesdayName']); ?>;
    var weekOverviewTot = <?php echo json_encode($weeklySalesOverview['weekOverviewTot']); ?>;
    var salesweekNum = <?php echo json_encode($weeklySalesOverview['salesweekNum']); ?>;
    var monthOverviewTot = <?php echo json_encode($monthlySalesOverview['monthOverviewTot']); ?>;
    var monthName = <?php echo json_encode($monthlySalesOverview['monthName']); ?>;
    var yearOverviewTot = <?php echo json_encode($yearlySalesOverview['yearOverviewTot']); ?>;
    var salesyearNum = <?php echo json_encode($yearlySalesOverview['salesyearNum']); ?>;
</script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/js/index.js')}}"></script>
@endsection