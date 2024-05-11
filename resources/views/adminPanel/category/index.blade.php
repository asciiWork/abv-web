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
                            <th>Category Name</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    var dataColumns = [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'category_name',
            name: 'category_name'
        },
        {
            data: 'action',
            orderable: false,
            searchable: false
        }
    ];
    $(document).on('click', '.viewCat', function (e) {
        var cid = $(this).attr('data-id');
        var url = $(this).attr("data-action");
        $.ajax({
            headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            url: url,
            data: { id : cid},
            success: function (result)
            {
                Swal.fire({
                    title: "<strong>"+result.catName+"</strong>",
                    html: result.html,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: `Ok`
                });
            }
        });
    });
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?123') }}"></script>

@endsection