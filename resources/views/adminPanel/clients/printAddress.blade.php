@extends('adminPanel.layout.appNew')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Print {{$page_title}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <select name="client_id" data-toggle="select2" id="client-select-box" class="select2 form-control">
                            <option value="">Select Client</option>
                            @foreach($clients as $clr)
                            <option value="{{$clr->id}}" data-address="{{$clr->address}}" data-name="{{$clr->name}}" data-phone="{{$clr->phone_1}}">{{$clr->name}} - {{$clr->phone_1}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div><br /><br /></div>
                <div class="row text-center">
                    <div class="col-lg-12" id="printableText">
                        <b><span id="client-name"></span></b>
                        <address id="client-address">
                        </address>
                        <span id="client-phone"></span>
                    </div>
                </div>
                <br />
                <div class="mb-3 text-center">
                    <button type="button" onclick="printText()" class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on("change", "#client-select-box", function() {
            if ($(this).val() > 0) {
                var selectedOption = $(this).find('option:selected');
                $('#client-address').html(selectedOption.data('address'));
                $('#client-name').html(selectedOption.data('name'));
                $('#client-phone').html(selectedOption.data('phone'));
            }
        });
    });

    function printText() {
        var printContent = document.getElementById("printableText").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
@endsection