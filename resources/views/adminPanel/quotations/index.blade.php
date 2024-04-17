@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
  <div class="col">
    <div class="card radius-10 border-0 border-start border-primary border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Yearly Total</p>
            <h4 class="mb-0 text-primary">{{ number_format($qnStatics['yearly_total'],2)}}</h4>
          </div>
          <div class="ms-auto widget-icon bg-primary text-white">
            <i class="bi bi-currency-dollar"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10 border-0 border-start border-success border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Monthly Total</p>
            <h4 class="mb-0 text-success">{{ number_format($qnStatics['monthly_total'],2)}}</h4>
          </div>
          <div class="ms-auto widget-icon bg-success text-white">
            <i class="bi bi-currency-dollar"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10 border-0 border-start border-danger border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Today Total</p>
            <h4 class="mb-0 text-danger">{{ number_format($qnStatics['today_total'],2)}}</h4>
          </div>
          <div class="ms-auto widget-icon bg-danger text-white">
            <i class="bi bi-currency-dollar"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar  bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card radius-10 border-0 border-start border-warning border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Pending Quotations</p>
            <h4 class="mb-0 text-warning">{{ $qnStatics['total_qns'] }}</h4>
          </div>
          <div class="ms-auto widget-icon bg-warning text-white">
            <i class="bi bi-basket2-fill"></i>
          </div>
        </div>
        <div class="progress mt-3" style="height: 4.5px;">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@include($moduleViewName.".search")
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div>
          <a href="{{$add_url}}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Add New </a>
        </div>
      </div>
      <div class="card-body">
        <table id="server-side-datatables" class="table" style="width:100%">
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('adminScript')
<script type="text/javascript">
  var MODULE_URL = "{!! route($moduleRouteText.'.data') !!}";
  var dataColumns = [{
      data: 'id',
      name: 'id'
    },
    {
      data: 'quotation_number',
      name: 'quotation_number'
    },
    {
      data: 'user_id',
      name: 'admin_users.name'
    },
    {
      data: 'cname',
      name: 'clients.name'
    },
    {
      data: 'quotation_date',
      name: 'quotation_date'
    },
    {
      data: 'quotation_due_date',
      name: 'quotation_due_date'
    },
    {
      data: 'final_total_amount',
      name: 'final_total_amount'
    },
    {
      data: 'action',
      orderable: false,
      searchable: true
    }
  ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?35645') }}"></script>
@endsection