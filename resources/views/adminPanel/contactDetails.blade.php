@extends('adminPanel.layouts.app')
@section('adminContent')
<div >    
    <div class="panel mt-6">
        <h5 class="text-lg font-semibold dark:text-white-light">{{$page_title}}</h5>
        <table id="myTable1" class="table-hover whitespace-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @if($records)
                  @foreach($records as $raw)
                    <tr>
                        <td>{{ $raw->id }}</td>
                        <td>{{ $raw->firstname }} {{ $raw->lastname }} </td>
                        <td>{{ $raw->phone_number }}</td>
                        <td>{{ $raw->email }}</td>
                        <td>{{ substr($raw->message,0,20) }}...</td>
                        <td>{{ date('d-m-Y',strtotime($raw->created_date)) }}</td>
                        <td><a href="javascript:void(0);" class="mymodal" data-id="{{ $raw->id }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                        </svg></a></td>
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
    <!-- modal --> 
    <div class="fixed inset-0 z-[999] bg-[black]/60 overflow-y-auto" id="mymodal1" tabindex="-1" style="display:none;">
        <div class="flex min-h-screen items-start justify-center px-4">
        <div class="panel my-8 w-full max-w-xl overflow-hidden rounded-lg border-0 p-0" >
            <div class="flex items-center justify-between bg-[#fbfbfb] px-5 py-3 dark:bg-[#121c2c]">
                <h5 class="text-lg font-bold">Modal Title</h5>
                <button type="button" class="text-white-dark hover:text-dark close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6" >
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="p-5">
                <div class="text-base font-medium text-[#1f2937] dark:text-white-dark/70 innerhtml">
                    
                </div>
                <div class="mt-8 flex items-center justify-end">
                    <button type="button" class="btn btn-outline-danger close">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
@section('adminscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        var url="{{route('contact-quick-view')}}";
        $(".mymodal").click(function(){
            id=this.getAttribute("data-id");
            $.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            url: url,
            data: { id : id},        
            success: function (result)
            {
                if (result.status == 1) {
                    $(".innerhtml").empty(result.html);
                    $(".innerhtml").append(result.html);
                    $("#mymodal1").show();
                }else{
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
            },
            error: function (error)
            {
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
            }
        });
        });
        $(".close").click(function(){
            $("#mymodal1").hide();
        });        
    });
</script>
@endsection