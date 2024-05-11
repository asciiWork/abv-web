@extends('adminPanel.layout.appNew')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="server-side-datatables" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Order No.</th>
                            <th>Customer</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th>Ship Date</th>
                            <th>Status/Payment</th>
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
            data: 'order_number',
            name: 'order_number'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'order_tax_amount_total',
            name: 'order_tax_amount_total'
        },
        {
            data: 'order_date',
            name: 'order_date'
        },
        {
            data: 'ship_date',
            name: 'ship_date'
        },
        {
            data: 'order_status',
            name: 'order_status'
        },
        {
            data: 'action',
            orderable: false,
            searchable: false
        }
    ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?123') }}"></script>
@endsection