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
                                <a href="javascript:void(0);" class="chngPass" data-id="{{ $usr->id }}"><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold"><i class="bi bi-key"></i></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="chngPassModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close closebtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="chpass" action="{{ route('update-admin-pass') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="admin_id" id="admin-id">
                    <div class="col-md-12">
                        <label class="form-label">New Password </label>
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="bsValidation5" placeholder="New Password" name="password">
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Confirm New Password</label>
                        <div class="position-relative input-icon">
                            <input type="password" class="form-control" id="bsValidation6" placeholder="Confirm New Password" name="password_confirmation">
                            <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-key"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="errorModalBody" class="alert border-0 bg-danger-subtle alert-dismissible fade show mt-3" style="display: none;">
                            <div class="d-flex align-items-center">
                                <div class="text-danger" id="erfrm"></div>
                            </div>
                        </div>
                        <div id="successModalBody" class="alert border-0 bg-success-subtle alert-dismissible fade show mt-3" style="display: none;">
                            <div class="d-flex align-items-center">
                                <div class="text-success" id="scfrm"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary closebtn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('adminScript')
<script type="text/javascript">
    $(document).click(function (e) {
        if ($(e.target).is('#chngPassModal')) {
            $('#scfrm').empty();
            $('#erfrm').empty();
            document.getElementById('errorModalBody').style.display = 'none';
            document.getElementById('successModalBody').style.display = 'none';
            var form = document.getElementById('chpass').reset();
        }
    });
    $(document).ready(function() {
        $('#datatable-module').DataTable({});
        $('.closebtn').click(function (e) {
            $('#scfrm').empty();
            $('#erfrm').empty();
            document.getElementById('errorModalBody').style.display = 'none';
            document.getElementById('successModalBody').style.display = 'none';
            var form = document.getElementById('chpass').reset();
        });
        $('.chngPass').click(function (e) {
            $('#chngPassModal').modal('show');
            var id=$(this).attr("data-id");
            $("#admin-id").val(id);
        });
        var form = document.getElementById('chpass');
        var url="{{ route('update-admin-pass') }}";
        var form = document.getElementById('chpass');
        $('#chpass').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var formErrors = document.getElementById('formErrors');
            
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status==1){
                        $('#scfrm').empty();
                        document.getElementById('errorModalBody').style.display = 'none';
                        document.getElementById('successModalBody').style.display = 'block';
                        $('#scfrm').append(response.msg);
                        form.reset();
                        setTimeout(function() {
                            $('#chngPassModal').modal('hide');
                            $('#scfrm').empty();
                            document.getElementById('successModalBody').style.display = 'none';
                        }, 2000);
                    }
                    if(response.status==0){
                        $('#erfrm').empty();
                        document.getElementById('errorModalBody').style.display = 'block';
                        $('#erfrm').append(response.msg);
                    }
                },
                error: function(response) {
                    console.log(response);
                    var response = jqXHR.responseJSON;
                    $('#erfrm').empty();
                    document.getElementById('errorModalBody').style.display = 'block';
                    if (response.errors) {
                        /*$.each(response.errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                $('#erfrm').append('<p>' + message + '</p>');
                            });
                        });*/
                    }
                }
            });
        });
    });
</script>
@endsection