@extends('adminPanel.layouts.appNew')
@section('adminStyle')
<link href="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<!-- @include($moduleViewName.".search") -->

<div class="row">
    <div class="col-xxl-3 col-sm-6">
        <div class="card radius-10 bg-danger">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1 text-white">Yearly Total</p>
                <h4 class="mb-0 text-white">{{ number_format($qnStatics['yearly_total'],2)}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card radius-10 bg-info">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1 text-white">Monthly Total</p>
                <h4 class="mb-0 text-white">{{ number_format($qnStatics['monthly_total'],2)}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card radius-10 bg-purple">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1 text-white">Today Total</p>
                <h4 class="mb-0 text-white">{{ number_format($qnStatics['today_total'],2)}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-xxl-3 col-sm-6">
        <div class="card radius-10 bg-primary">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="">
                <p class="mb-1 text-white">Pending Quotations</p>
                <h4 class="mb-0 text-white">{{ number_format($qnStatics['total_qns'],2)}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

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
                <table id="example1" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Number</th>
                            <th>Created By</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quaData as $qua)
                            <tr>
                                <td>
                                    <a href="javascript:;">#{{ $qua->id }}</a>
                                </td>
                                <td>
                                    <?php
                                    $html = 'Q: '. $qua->quotation_number;
                                    if($qua->is_invoice){
                                        $html .= '<br/>I: &nbsp;&nbsp;'. $qua->invoice_number;
                                    }
                                    echo $html;                                    
                                    ?>
                                </td>
                                <td>{{ $qua->uname }}</td>
                                <td>{{ $qua->cname }}</td>
                                <td>
                                    <?php
                                    $html = 'Q: '. $qua->quotation_date;
                                    if($qua->is_invoice){
                                        $html .= '<br/>I: &nbsp;&nbsp;'. $qua->invoice_date;
                                    } echo $html;
                                    ?>
                                </td>
                                <td>{{ $qua->quotation_due_date }}</td>
                                <td>₹{{ $qua->final_total_amount }}</td>
                                <td>@if($qua->is_invoice==0)
                                    <a href="{{ route($currentRoute.'.edit',$qua->id) }}"><span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">Edit<i class="bi bi-pencil-square ms-2"></i></span></a>
                                    <a data-id="{{ $qua->id }}" href="{{ route($currentRoute.'.make-invoice', $qua->id) }}" onclick="return confirm('Are you sure you want to make this as invoice?')" title="Make as invoice">
                                        <span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">Invoice<i class="bi bi-check2 ms-2"></i></span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div> <!-- end row-->
@endsection

@section('adminscript')
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script type="text/javascript">
    var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
    $(document).ready(function() {
        $('#example1').DataTable();
    });
    /*var dataColumns = [
        { data: 'id', name: 'id' },
        { data: 'quotation_number', name: 'quotation_number' },
        { data: 'uname', name: 'admin_users.name' },
        { data: 'cname', name: 'clients.name' },
        { data: 'quotation_date', name: 'quotation_date' },
        { data: 'quotation_due_date', name: 'quotation_due_date' },
        { data: 'final_total_amount', name: 'final_total_amount' },
        { data: 'action', orderable: false, searchable: true }
    ];*/
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?456') }}"></script>
@endsection