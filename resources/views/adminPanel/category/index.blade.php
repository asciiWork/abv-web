@extends('adminPanel.layouts.app')
<style type="text/css">
    .dataTables_wrapper .dataTables_length {
    float: right !important;
}
</style>
@section('adminContent')
<div >
    <div class="panel border-[#e0e6ed] px-0 dark:border-[#1b2e4b]">
        <div class="px-5">
            <div class="md:top-5 ltr:md:left-5 rtl:md:right-5">
                <div class="flex items-center gap-2">
                    <button type="button" class="btn btn-danger gap-2" id="deleteCat">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                            <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path
                                d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            ></path>
                            <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path
                                opacity="0.5"
                                d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                stroke="currentColor"
                                stroke-width="1.5"
                            ></path>
                        </svg>
                        Delete
                    </button>
                    <a href="{{ route('admin-category.create') }}" class="btn btn-primary gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24px"
                            height="24px"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-5 w-5"
                        >
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="invoice-table">
            <table id="myTable1" class="table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="form-checkbox mt-1" onclick="checkAll(this)"/></th>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('adminscript')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- <script src="{{ asset('admin-theme/assets/js/simple-datatables.js')}}"></script> -->
<script>
    var MODULE_URL="{{ route('admin-category.data') }}";
    var redirecturl="{{route('admin-category.index')}}";
    var url="{{ route('admin-category.destroy',0) }}";
    function checkAll(bx) {
        var cbs = document.getElementsByTagName('input');
        for(var i=0; i < cbs.length; i++) {
            if(cbs[i].type == 'checkbox') {
                cbs[i].checked = bx.checked;
            }
        }
    }
    $(document).on('click', '#deleteCat', function (e) {
        e.preventDefault();
        let allVals = []; 
        $("input:checkbox[name=catid]:checked").each(function() { 
            allVals.push($(this).val()); 
        });
        if(allVals.length <=0)    
        {    
            alert("Please select category.");    
        }else if (confirm('Are you sure want to delete selected category ?')) {
            $.ajax({
                type: "DELETE",
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'ids':allVals},
                enctype: 'multipart/form-data',
                success: function(result) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1) {
                        const toast = window.Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        toast.fire({
                            icon: 'success',
                            title: result.msg,
                            padding: '10px 20px',
                        });
                        window.location = redirecturl;
                    } else {
                        const toast = window.Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        toast.fire({
                            icon: 'error',
                            title: result.msg,
                            padding: '10px 20px',
                        });
                    }
                    $('#submit-form #submit-form-button').attr('disabled', false);
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: 'error',
                        title: "Internal server error !",
                        padding: '10px 20px',
                    });
                    $('#submit-form #submit-form-button').attr('disabled', false);
                }
            });
        }else{
            console.log('no');
        }
    });
    $(document).ready(function(){
        var oTableCustom = $('#myTable1').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            pageLength: 25,
            displayStart: 0,
            ajax: {
                "url": MODULE_URL,
                "data": function ( data ) 
                {
                    
                }
            },
            lengthMenu:
              [
                [25,50,100,200],
                [25,50,100,200]
              ],
            columns: [
                { data: 'chkbox', name: 'chkbox',orderable:false },
                { data: 'id', name: 'id',orderable:false },
                { data: 'category_name', name: 'category_name' },
                { data: 'action', name: 'action', orderable:false},
            ]
        });
    });
</script>
@endsection