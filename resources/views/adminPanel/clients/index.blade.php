@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row g-3">
    <div class="col-auto">
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <a href="{{$add_url}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add New</a>
        </div>
    </div>
</div>
@include($moduleViewName.".search")
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="server-side-datatables" class="table" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%">Name</th>
                        <th width="15%">Company</th>
                        <th width="15%">Email</th>
                        <th width="15%">Phone</th>
                        <th width="15%">Courier</th>
                        <th width="5%">By</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('adminScript')
<script>
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'company_name',
            name: 'company_name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'phone_1',
            name: 'phone_1'
        },
        {
            data: 'courier',
            name: 'courier'
        },
        {
            data: 'user_id',
            name: 'user_id'
        },
        {
            data: 'action',
            orderable: false,
            searchable: true
        }
    ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?250') }}"></script>
@endsection