@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row g-3">
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
                <table id="datatable-module" class="table align-middle">
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
                                @if($usr->status)
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
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminScript')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-module').DataTable({});
    });
</script>
@endsection