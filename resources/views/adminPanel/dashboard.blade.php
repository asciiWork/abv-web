@extends('adminPanel.layout.appNew')

@section('content')
<div class="row">
    @if($sellingPrices)
    @foreach($sellingPrices as $user)
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="d-flex">
                        <a class="me-3" href="#">
                            <img class="avatar-md rounded-circle bx-s" src="{{$user['image']}}" alt="">
                        </a>
                        <div class="info">
                            <h5 class="fs-18 my-1">{{$user['name']}}</h5>
                            <p class="text-muted fs-15">{{$user['phone']}}</p>
                        </div>
                    </div>
                    <div class="">Sell</div>
                </div>
                <hr>
                <ul class="social-list list-inline mb-0 text-center">
                    <li class="list-inline-item">
                        <div class="card widget-flat text-bg-pink">
                            <div class="card-body">
                                <h6 class="text-uppercase mt-0" title="Customers">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yearly&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                <h2 class="my-2">₹{{ number_format($user['yearly'],2)}}</h2>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="card widget-flat text-bg-info">
                            <div class="card-body">
                                <h6 class="text-uppercase mt-0" title="Customers">Monthly </h6>
                                <h2 class="my-2">₹{{ number_format($user['monthly'],2)}}</h2>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <h6 class="text-uppercase mt-0" title="Customers">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Today&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                                <h2 class="my-2">₹{{ number_format($user['today'],2)}}</h2>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </div>
    @endforeach
    @endif
</div>
@endsection