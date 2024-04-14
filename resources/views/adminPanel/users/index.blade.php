@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row g-3">
    <div class="col-auto">
        <div class="position-relative">
            <input class="form-control px-5" type="text" placeholder="Search Customers">
            <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
        </div>
    </div>
    <div class="col-auto">
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <a href="{{$add_url}}" class="btn btn-danger px-4"><i class="bi bi-plus-lg me-2"></i>Search</a>
            <a href="{{$add_url}}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add New</a>
        </div>
    </div>
</div><!--end row-->

<div class="card mt-4">
    <div class="card-body">
        <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Join At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="javascript:;">#5</a>
                            </td>
                            <td>
                                <a class="d-flex align-items-center gap-3" href="javascript:;">
                                    <div class="customer-pic">
                                        <img src="{{ asset('public/admin-theme/assetsRoksyn/images/avatars/01.png')}}" class="rounded-circle" width="40" height="40" alt="">
                                    </div>
                                    <p class="mb-0 customer-name fw-bold">Andrew Carry</p>
                                </a>
                            </td>
                            <td>test@gmail.com</td>
                            <td>+91 5689562520</td>
                            <td><span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">Active<i class="bi bi-check2 ms-2"></i></span></td>
                            <td>Nov 12, 10:45 PM</td>
                            <td><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-check2 ms-2"></i></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'image',
            name: 'image'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'phone',
            name: 'phone'
        },
        {
            data: 'status',
            name: 'status'
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