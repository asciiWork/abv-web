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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientData as $usr)
                            <tr>
                                <td>
                                    <a href="javascript:;">#{{ $usr->id }}</a>
                                </td>
                                <td>{{ $usr->name }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>
                                    <?php
                                    $phone = '# '. $usr->phone_1;
                                    if($usr->phone_2){
                                        $phone .= '<br># '. $usr->phone_2;
                                    }
                                    if($usr->phone_3){
                                        $phone .= '<br># ' . $usr->phone_3;
                                    }
                                    echo $phone;                                    
                                    ?>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
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
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?123') }}"></script>
@endsection