@extends('adminPanel.layout.appNew')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="server-side-datatables" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'product_name',
            name: 'product_name'
        },
        {
            data: 'price',
            orderable: false,
            searchable: false,
        }
    ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?123') }}"></script>

@endsection