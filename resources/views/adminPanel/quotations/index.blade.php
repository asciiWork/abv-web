@extends('adminPanel.layout.appNew')
@section('content')
@include($moduleViewName.".search")

<div class="row">
    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-purple">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-wallet-2-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Yearly Total</h6>
                <h2 class="my-2">{{ number_format($qnStatics['yearly_total'],2)}}</h2>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-info">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-wallet-2-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Monthly Total</h6>
                <h2 class="my-2">{{ number_format($qnStatics['monthly_total'],2)}}</h2>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-info">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-wallet-2-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Today Total</h6>
                <h2 class="my-2">{{ number_format($qnStatics['today_total'],2)}}</h2>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-pink">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-shopping-basket-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers">Pending Quotations</h6>
                <h2 class="my-2">{{ $qnStatics['total_qns']}}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <a href="{{$add_url}}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="server-side-datatables" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Number</th>
                            <th>Created By</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div> <!-- end row-->
@endsection

@section('scripts')
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'quotation_number',
            name: 'quotation_number'
        },
        {
            data: 'uname',
            name: 'admin_users.name'
        },
        {
            data: 'cname',
            name: 'clients.name'
        },
        {
            data: 'quotation_date',
            name: 'quotation_date'
        },
        {
            data: 'quotation_due_date',
            name: 'quotation_due_date'
        },
        {
            data: 'final_total_amount',
            name: 'final_total_amount'
        },
        {
            data: 'action',
            orderable: false,
            searchable: false
        }
    ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?45') }}"></script>
@endsection