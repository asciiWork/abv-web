@extends('adminPanel.layouts.appNew')
@section('content')
 
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