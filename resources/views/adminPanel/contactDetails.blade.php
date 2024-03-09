@extends('adminPanel.layouts.app')
@section('adminContent')
<div x-data="basic">    
    <div class="panel mt-6">
        <h5 class="text-lg font-semibold dark:text-white-light">Users</h5>
        <table id="myTable1" class="table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @if($records)
                  @foreach($records as $raw)
                    <tr>
                        <td>{{ $raw->id }}</td>
                        <td>{{ $raw->firstname }} {{ $raw->last_name }} </td>
                        <td>{{ $raw->phone_number }}</td>
                        <td>{{ $raw->email }}</td>
                        <td>{{ $raw->message }}</td>
                        <td>{{ date('d-m-Y',strtotime($raw->created_date)) }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="3" >Data Not Found</td>
                  </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection