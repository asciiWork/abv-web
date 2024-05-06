@extends('adminPanel.layouts.appNew')
@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
  <div class="col">
    <div class="card radius-10 border-0 border-start border-primary border-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="">
            <p class="mb-1">Today Total</p>
            <h4 class="mb-0 text-primary">{{ $qnStatics['today_total']}}</h4>
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
            <p class="mb-1">Weekly Total</p>
            <h4 class="mb-0 text-success">{{ $qnStatics['week_total']}}</h4>
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
            <p class="mb-1">Monthly Total</p>
            <h4 class="mb-0 text-danger">{{ $qnStatics['monthly_total']}}</h4>
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
            <p class="mb-1">Yearly Total</p>
            <h4 class="mb-0 text-warning">{{ $qnStatics['yearly_total'] }}</h4>
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
<div class="modal fade" id="invoicePaymentModel" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Invoice Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {!! Form::open(['route'=>['admin-invoices.mark-as-paid'],'method' => 'POST','id'=>'module-frm', 'redirect-url' => route($back_url)])!!}
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <label class="form-label">Payment Date<span class="text-danger">*</span></label>
            {!! Form::date('payment_date', null, ['class' => 'form-control', 'data-required' => true]) !!}
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-lg-12">
            <label class="form-label">Payment Type<span class="text-danger">*</span></label>
            {!! Form::select('payment_type', [''=>'Select Type','COD'=>'COD','Cheque'=>'Cheque','Transaction'=>'Transaction'],null, ['class' => 'form-control', 'data-required' => true]) !!}
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-lg-12">
            <label class="form-label">Payment Details/Transaction No</label>
            {!! Form::text('payment_detail', null, ['class' => 'form-control', 'data-required' => true]) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="invoice_id" value="" id="invoicePayment_invoice_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Mark as Paid</button>
      </div>
      {!! Form::close()!!}
    </div>
  </div>
</div>
<div class="modal fade" id="invoicePaymentViewModel" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Invoice Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <strong>Payment Date:</strong>
            <span id="view-payment-date">Payment Date</span>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-lg-12">
            <strong>Payment Type:</strong>
            <span id="view-payment-type">Payment Type</span>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-lg-12">
            <strong>Payment Details:</strong>
            <span id="view-payment-details">Payment Details</span>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
      data: 'invoice_number',
      name: 'invoice_number'
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
      data: 'invoice_date',
      name: 'invoice_date'
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
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?334545') }}"></script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleForm.js?44564566') }}"></script>
@endsection