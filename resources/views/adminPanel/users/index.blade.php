@extends('adminPanel.layouts.app')
@section('adminContent')
<div>    
    <div class="panel mt-6">
        <h5 class="text-lg font-semibold dark:text-white-light">{{$page_title}}</h5>
        <table id="myTable1" class="table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('adminscript')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin-theme/assets/js/simple-datatables.js')}}"></script>
<script>
    var MODULE_URL="{{ route('admin-users.data') }}";
    $(document).ready(function(){
        var oTableCustom = $('#myTable1').DataTable({
            processing: false,
            serverSide: true,
            searching: false,
            pageLength: 10,
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
                { data: 'id', name: 'id',orderable:false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email', orderable:false},
            ]
        });
    });
    /*document.addEventListener('alpine:init', () => {
        Alpine.data('basic', () => ({
            datatable: null,
            init() {
                this.datatable = new simpleDatatables.DataTable('#myTable1', {
                    data: {
                        headings: ['ID', 'First Name','Last Name', 'Email', 'Phone'],
                        data: [
                            console.log(addNewColumn()),
                        ],
                    },
                    sortable: false,
                    searchable: false,
                    perPage: 10,
                    perPageSelect: [10, 20, 30, 50, 100],
                    firstLast: true,
                    firstText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    lastText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    prevText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    nextText:
                        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                    labels: {
                        perPage: '{select}',
                    },
                    layout: {
                        top: '{search}',
                        bottom: '{info}{select}{pager}',
                    },
                });
            },
        }));
        let addNewColumn = function() {
        let columnData = MODULE_URL

        fetch(columnData)
        .then(response => response.json())
        .then(data => datatable.columns.add(data))
        }
    });*/
</script>
@endsection