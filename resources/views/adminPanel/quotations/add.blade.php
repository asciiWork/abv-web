@extends('adminPanel.layout.appNew')
@section('styles')
<link href="{{ asset('public/admin-theme/assetsNew/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{$page_title}}</h4>
            </div>
            {!! Form::model($formObj,['method' => $method,'files' => true, 'route' => [$action_url,$action_params],'class' => '', 'id' => 'module-frm', 'redirect-url' => route($back_url)]) !!}
            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{asset('public/web/assets/img/abv.png')}}" alt="dark logo">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Quotation</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-start">
                            <p><b>ABV TOOL</b></p>
                            <p class="text-muted fs-13"><b>GSTIN 24ATKPV5305Q1Z0</b> </p>
                            <p class="m-0 p-0">A-205, Krish Elite Commercial Complex</p>
                            <p class="m-0 p-0">Nr Vishala Land Mark,B/H Sankalp International School, Ahmedabad</p>
                            <p class="m-0 p-0">Ahmedabad-382350, Gujarat, India</p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="float-sm-end">
                            <p class="fs-13">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Quotation No</div>
                                {!! Form::text('quotation_number', $quotation_number, ['class' => 'form-control','placeholder'=>$quotation_number]) !!}
                            </div>
                            </p>
                            <p class="fs-13">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Quotation Date</div>
                                {!! Form::date('quotation_date', null, ['class' => 'form-control']) !!}
                            </div>
                            </p>
                            <p class="fs-13">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Quotation Due Date</div>
                                {!! Form::date('quotation_due_date', null, ['class' => 'form-control']) !!}
                            </div>
                            </p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="fs-14">Customer</h6>
                        <div class="col-sm-6">
                            {!! Form::select('client_id', [''=>'Select client'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="fs-14">Billing Address</h6>
                        <address>
                        </address>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>#</th>
                                        <th width="25%">Item</th>
                                        <th>Rate/Item</th>
                                        <th>Qnt</th>
                                        <th>Taxable Value</th>
                                        <th>Tax Amount(18%)</th>
                                        <th>Amount</th>
                                        <th class="float-end"><a id="add_tr" class="btn btn-primary"><i class=" ri-file-add-line"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyTr">
                                    <tr id="tr-item-1">
                                        <td class="">1</td>
                                        <td>
                                            <div class="col-sm-12">
                                                <select name="product_id[]" data-row="1" id="product-option-1" data-toggle="select2" class="select2 form-control product-items">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $prd)
                                                    <option value="{{$prd->id}}" data-price="{{$prd->price}}">{{$prd->product_name}} [{{$prd->product_size}}]</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td><span id="product-amount-text-1">000.00</span>
                                            <input type="hidden" value="0" id="product-amount-1">
                                        </td>
                                        <td>
                                            <div class="col-sm-8">
                                                <input type="number" min="0" value="1" data-row="1" name="quantity[]" class="form-control item-qnt">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="" name="taxable_value[]" id="taxable-value-1" class="form-control taxable-value">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="" name="tax_amount[]" id="tax-amount-1" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="" name="total_amount[]" id="total-amount-1" class="total-amount form-control">
                                            </div>
                                        </td>
                                        <td class="float-end">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                </div>
                <!-- end row -->
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-3">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>Taxable Amount:</b> <span class="float-end final-taxable-total">000.00</span></p>
                            <p><b>IGST (18.0%):</b> <span class="float-end final-gst-total">000.00</span></p>
                            <p><b>Total:</b> <span class="float-end final-total">000.00</span></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit_btn">{{ $buttonText}}</button>
                    </div>
                </div>
                <input value=" 1" id="numRow" type="hidden">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#add_tr').click(function() {
            let num = parseInt($('#numRow').val()) + 1;
            var html = '<tr id="tr-item-' + num + '"><td> ' + (num) + ' </td>';
            html += '<td><div class = "col-sm-12" ><select name="product_id[]" data-toggle="select2" class="select2 form-control product-items" data-row="' + num + '" id="product-option-' + num + '"><option value = "" > Select Product</option></select> </div> </td>';
            html += '<td> <span id="product-amount-text-' + num + '">000.00</span> <input type = "hidden" value = "0" id="product-amount-' + num + '" ></td>';
            html += '<td><div class="col-sm-8"><input type="number" min="0" value="1" data-row="' + num + '" name="quantity[]" class="item-qnt form-control"></div ></td>';
            html += '<td ><div class = "col-sm-10" ><input type="text" value="" name="taxable_value[]" id="taxable-value-' + num + '" class="form-control taxable-value" ></div ></td>';
            html += '<td ><div class="col-sm-10"><input type="text" value="" name="tax_amount[]" id="tax-amount-' + num + '" class="form-control" ></div ></td>';
            html += '<td ><div class="col-sm-10"><input type="text" value="" name="total_amount[]" id="total-amount-' + num + '" class="form-control total-amount"></div></td> <td class="float-end" ><a class="btn btn-danger delete-item-tr"><i class="ri-file-reduce-line"></i ></a></td ></tr>';
            $('.tbodyTr').append(html);
            $('#numRow').val(num);
            $('#product-option-1 option').each(function() {
                $('#product-option-' + num).append($(this).clone());
            });
            $(".select2").select2({
                placeholder: "Search Client",
                allowClear: true,
                width: null
            });
        });
        $(document).on("click", ".delete-item-tr", function() {
            $(this).closest('tr').remove();
            allTotalPrices();
            return false;
        });
        $(document).on("change", ".product-items", function() {
            if ($(this).val() > 0) {
                var rowNo = $(this).attr('data-row');
                var selectedOption = $(this).find('option:selected');
                var price = selectedOption.data('price');
                $('#product-amount-text-' + rowNo).html(price);
                $('#product-amount' + rowNo).val(price);
                $('#taxable-value-' + rowNo).val(price);
                var result = parseFloat(price) * 0.18;
                $('#tax-amount-' + rowNo).val(result);
                $('#total-amount-' + rowNo).val(parseFloat($('#tax-amount-' + rowNo).val()) + parseFloat($('#taxable-value-' + rowNo).val()));
            }
            allTotalPrices();
        });
        $(document).on("change", ".item-qnt", function() {
            if ($(this).val() > 0) {
                var rowNo = $(this).attr('data-row');
                var totl = parseFloat($('#product-amount' + rowNo).val()) * parseFloat($(this).val());
                $('#taxable-value-' + rowNo).val(totl);
                var result = parseFloat(totl) * 0.18;
                $('#tax-amount-' + rowNo).val(result);
                $('#total-amount-' + rowNo).val(parseFloat($('#tax-amount-' + rowNo).val()) + parseFloat($('#taxable-value-' + rowNo).val()));
            }
            allTotalPrices();
        });
    });

    function allTotalPrices() {
        var texts = document.getElementsByClassName("total-amount");
        var amounts = 0;
        for (var i = 0; i < texts.length; i++) {
            var aa = parseFloat(texts[i].value);
            if (aa == "NaN" || aa == null || aa == "") {
                aa = parseFloat("0");
            }
            amounts = parseFloat(amounts) + parseFloat(aa);
        }
        $('.final-total').html(parseFloat(amounts));

        var tamounts = 0;
        var texts = document.getElementsByClassName("taxable-value");
        for (var i = 0; i < texts.length; i++) {
            var aa = parseFloat(texts[i].value);
            if (aa == "NaN" || aa == null || aa == "") {
                aa = parseFloat("0");
            }
            tamounts = parseFloat(tamounts) + parseFloat(aa);
        }
        $('.final-taxable-total').html(parseFloat(tamounts));

    }
</script>
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js') }}"></script>
<script src=" {{ asset('public/admin-theme/assetsNew/vendor/select2/js/select2.min.js') }}"></script>
@endsection