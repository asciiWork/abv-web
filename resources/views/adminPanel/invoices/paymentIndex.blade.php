@extends('adminPanel.layouts.appNew')
@section('content')

@include($moduleViewName.".paymentSearch")
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <table id="server-side-datatables" class="table" style="width:100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Number</th>
              <th width="20%">Company</th>
              <th>Client</th>
              <th>Date</th>
              <th>Total</th>
              <th>Type</th>
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
  var MODULE_URL = "{!! route($moduleRouteText.'.paymentsData') !!}";
  var dataColumns = [{
      data: 'id',
      name: 'id'
    },
    {
      data: 'invoice_number',
      name: 'quotations.invoice_number'
    },
    {
      data: 'comname',
      name: 'clients.company_name'
    },
    {
      data: 'cname',
      name: 'clients.name'
    },
    {
      data: 'payment_date',
      name: 'payment_date'
    },
    {
      data: 'final_total_amount',
      name: 'quotations.final_total_amount'
    },
    {
      data: 'payment_type',
      name: 'payment_type'
    }
  ];
</script>
<script src="{{ asset('public/admin-theme/assetsNew/modules/moduleList.js?252022') }}"></script>
@endsection