@extends('adminPanel.layouts.appNew')
@section('adminStyle')
<link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row g-3">
    <!-- <div class="col-auto">
        <div class="position-relative">
            <input class="form-control px-5" type="text" placeholder="Search Customers">
            <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
        </div>
    </div> -->
    <div class="col-auto">
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <a href="{{$add_url}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add New</a>
        </div>
    </div>
</div><!--end row-->
<div class="card mt-4">
    <div class="card-body">
        <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
                <table id="example1" class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userData as $usr)
                            <tr>
                                <td>
                                    <a href="javascript:;">#{{ $usr->id }}</a>
                                </td>
                                <td>
                                    <a class="d-flex align-items-center gap-3" href="javascript:;">
                                        <div class="customer-pic">
                                            @php
                                            $url = App\Models\Admin::getAvtar($usr->image);
                                            @endphp
                                            <img src="{{ $url}}" class="rounded-circle" width="40" height="40" alt="">
                                        </div>
                                        <p class="mb-0 customer-name fw-bold">{{ $usr->name }}</p>
                                    </a>
                                </td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->phone }}</td>
                                <td>
                                    @if($usr->status==1)
                                        <span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span>
                                    @else
                                        <span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">Inactive<i class="bi bi-info-circle ms-2"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route($currentRoute.'.edit',$usr->id) }}"><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-pencil-square ms-2"></i></span></a>
                                </td>
                            </tr>
                        @endforeach  
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminscript')
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    $(document).ready(function() {
        $('#example1').DataTable({
            /*processing: true,
            serverSide: true,
            ajax: MODULE_URL,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'image', name: 'image' },
                { data: 'phone', name: 'phone' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]*/
        });
    });
</script>
@endsection