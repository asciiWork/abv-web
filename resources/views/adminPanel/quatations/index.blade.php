@extends('adminPanel.layouts.app')
@section('adminContent')
<div>    
    <div class="panel mt-6">
        <h5 class="text-lg font-semibold dark:text-white-light">Quotations</h5>
        <br/>
        <table id="myTable1" class="table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>Quotation</th>
                    <th>Created By</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Status</th><!-- draft|sent|done -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                      	<td>raw->id </td>
	                    <td>raw->name </td>
	                    <td>₹raw->order_tax_amount_total </td>
	                    <td>{{ date('Y-m-d',strtotime($raw->order_date)) </td>
	                    <td>{{ date('Y-m-d',strtotime($raw->ship_date)) </td>
	                    <td>
	                    	<span class="badge badge-outline-success">Placed</span>
	                    </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection