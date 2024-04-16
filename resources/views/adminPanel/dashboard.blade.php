    @extends('adminPanel.layouts.appNew')
    @section('adminStyle')
    <style type="text/css">
        .apexcharts-tooltip.apexcharts-theme-light{
            color: black;
        }
    </style>
    @endsection
    @section('content')

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
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
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1">Monthly Order</p>
                            <h4 class="mb-0 text-success">{{ $MonthlyOrders }}</h4>
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
                            <h4 class="mb-0 text-danger">{{ $totalOrders }}</h4>
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
                            <h4 class="mb-0 text-warning">₹{{ number_format($totalSale,2) }}</h4>
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
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
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
        <div class="col">
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
        <div class="col">
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
        <div class="col">
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
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        @if($sellingPrices)
        @foreach($sellingPrices as $user)
        <div class="col">
            <div class="card radius-15">
                <div class="card-body text-center">
                    <div class="">
                        <img src="{{$user['image']}}" width="110" height="110" class="rounded-circle shadow" alt="">
                        <h5 class="mb-0 mt-5">{{$user['name']}}</h5>
                        <p class="mb-3">{{$user['phone']}}</p>
                        <div class="list-inline contacts-social mt-3 mb-3"> <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0"><i class="bx bxl-facebook"></i></a>
                            <a href="{{ route('admin-sales-overview',$user['id']) }}" class="list-inline-item bg-twitter text-white border-0"><i class="bx bxl-twitter"></i></a>
                            <a href="{{ route('admin-sales-overview',$user['id']) }}" class="list-inline-item bg-google text-white border-0"><i class="bx bxl-google"></i></a>
                            <a href="{{ route('admin-sales-overview',$user['id']) }}" class="list-inline-item bg-linkedin text-white border-0"><i class="bx bxl-linkedin"></i></a>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('admin-sales-overview',$user['id']) }}" class="btn btn-sm btn-outline-primary radius-15">View Sales Overview </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @endsection
    @section('adminscript')
    <script type="text/javascript">
        var dailyOverviewTot = {!! json_encode($dailySalesOverview['dailyOverviewTot']) !!};
        var salesdayName = {!! json_encode($dailySalesOverview['salesdayName']) !!};
        var weekOverviewTot = {!! json_encode($weeklySalesOverview['weekOverviewTot']) !!};
        var salesweekNum = {!! json_encode($weeklySalesOverview['salesweekNum']) !!};
        var monthOverviewTot = {!! json_encode($monthlySalesOverview['monthOverviewTot']) !!};
        var monthName = {!! json_encode($monthlySalesOverview['monthName']) !!};
        var yearOverviewTot = {!! json_encode($yearlySalesOverview['yearOverviewTot']) !!};
        var salesyearNum = {!! json_encode($yearlySalesOverview['salesyearNum']) !!};
    </script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{ asset('public/admin-theme/assetsRoksyn/js/index.js')}}"></script>
    @endsection