@extends('adminPanel.layout.appNew')
@section('content')
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
            data: 'user_id',
            name: 'user_id'
        },
        {
            data: 'user_id',
            name: 'user_id'
        },
        {
            data: 'user_id',
            name: 'user_id'
        },
        {
            data: 'user_id',
            name: 'user_id'
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