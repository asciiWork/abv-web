@extends('adminPanel.layouts.appNew')
@section('adminStyle')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style type="text/css">
    .select2-selection__rendered {
        color: #ffffff !important;
    }
</style>
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
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{asset('public/web/assets/img/logo/ABV-logo.png')}}" width="100" alt="dark logo">
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
                    <div class="col-4">
                        <h6 class="fs-14">Customer</h6>
                        <div class="col-sm-10">
                            <select name="client_id" id="client-select-box" class="form-select" data-placeholder="Select Client">
                                <option value="">Select Client</option>
                                @foreach($clients as $clr)
                                <option value="{{$clr->id}}" {{$formObj->client_id == $clr->id ? 'selected' : ''}} data-billlandmark="{{$clr->landmark}}" data-shiplandmark="{{$clr->ship_landmark}}" data-shipAddress="{{$clr->ship_address}}" data-shipCity="{{$clr->ship_city}}" data-shipState="{{$clr->ship_state}}" data-shipPincode="{{$clr->ship_pincode}}" data-gstn="{{$clr->gstn}}" data-address="{{$clr->address}}" data-city="{{$clr->city}}" data-state="{{$clr->state}}">{{$clr->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <h6 class="fs-14">Billing Address</h6>
                        <div class="input-group"><span class="input-group-text">Street</span>
                            {!! Form::text('bill_address', null, ['class' => 'form-control','id'=>'bill_address']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">Landmark</span>
                            {!! Form::text('bill_landmark', null, ['class' => 'form-control','id'=>'bill_landmark']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">City</span>
                            {!! Form::text('bill_city', null, ['class' => 'form-control','id'=>'bill_city']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">State</span>
                            {!! Form::text('bill_state', null, ['class' => 'form-control','id'=>'bill_state']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">Pincode</span>
                            {!! Form::text('bill_pincode', null, ['class' => 'form-control','id'=>'bill_pincode']) !!}
                        </div>
                    </div>
                    <div class="col-3">
                        <h6 class="fs-14">Shipping Address</h6>
                        <div class="input-group"><span class="input-group-text">Street</span>
                            {!! Form::text('ship_address', null, ['class' => 'form-control','id'=>'ship_address']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">Landmark</span>
                            {!! Form::text('ship_landmark', null, ['class' => 'form-control','id'=>'ship_landmark']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">City</span>
                            {!! Form::text('ship_city', null, ['class' => 'form-control','id'=>'ship_city']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">State</span>
                            {!! Form::text('ship_state', null, ['class' => 'form-control','id'=>'ship_state']) !!}
                        </div>
                        <div class="input-group"><span class="input-group-text">Pincode</span>
                            {!! Form::text('ship_pincode', null, ['class' => 'form-control','id'=>'ship_pincode']) !!}
                        </div>
                    </div>
                    <div class="col-2">
                        <h6 class="fs-14">GSTIN</h6>
                        {!! Form::text('client_gstn', null, ['class' => 'form-control','id'=>'client_gstn']) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>#</th>
                                        <th width="35%">Item</th>
                                        <th width="17%">HSN Code</th>
                                        <th width="17%">Rate/Item</th>
                                        <th width="17%">Qty.</th>
                                        <th width="17%" style="text-align: center;">Amount</th>
                                        <th class="float-end"><a id="add_tr" class="btn btn-primary"><i class="bi bi-plus-lg"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyTr">
                                    @if($qnItems)
                                    <?php $i = 1; ?>
                                    @foreach($qnItems as $item)
                                    <tr id="tr-item-{{$i}}">
                                        <td class="">{{$i}}</td>
                                        @if($item['product_size_id']>0)
                                        <td>
                                            <select name="product_size_id[]" data-row="{{$i}}" id="product-option-{{$i}}" class="form-select product-items">
                                                <option value="">Select Product</option>
                                                @foreach($products as $prd)
                                                <option value="{{$prd->id}}" data-hsnCode="{{$prd->hsn_code}}" {{$prd->id == $item['product_size_id'] ? 'selected' : ''}} data-sizeproduct="{{$prd->product_size_id}}" data-product="{{$prd->product_id}}" data-price="{{$prd->price}}">{{$prd->product_code}}-{{$prd->product_name}} [{{$prd->product_size}}]</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @else
                                        <td>
                                            <input name="product_size_id[]" type="text" data-row="{{$i}}" value="{{$item['item_name']}}" id="product-option-{{$i}}" class="form-control">
                                        </td>
                                        @endif
                                        <td>
                                            <input type="text" value="{{$item['product_hsn_code']}}" data-row="{{$i}}" name="product_hsn_code[]" id="hsn-code-{{$i}}" class="form-control hsn-code">
                                        </td>
                                        <td><input name="product_actual_price[]" data-row="{{$i}}" type="text" class="form-control product_actual_price" value="{{$item['product_actual_price']}}" id="product_actual_price-{{$i}}">
                                            <input name="product_id[]" type="hidden" value="{{$item['product_size_id']}}" id="product-size-id-{{$i}}">
                                            <input name="item_name[]" type="hidden" value="{{$item['item_name']}}" id="product-name-{{$i}}">
                                            <span id="last-product-price-{{$i}}"></span>
                                        </td>
                                        <td>
                                            <div class="col-sm-12">
                                                <input type="number" min="0" value="{{$item['quantity']}}" id="item-qnt-{{$i}}" data-row="{{$i}}" name="quantity[]" class="form-control item-qnt">
                                            </div>
                                        </td>
                                        <td class="" align="center">
                                            <div class="col-sm-12">
                                                <h6 id="total-amount-txt-{{$i}}">{{$item['total_amount']}}</h6>
                                                <input type="hidden" value="{{$item['total_amount']}}" name="total_amount[]" id="total-amount-{{$i}}" class="total-amount form-control">
                                            </div>
                                        </td>
                                        <td class="float-end">
                                            <a class="btn btn-danger delete-item-tr"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div>Total: &nbsp;<span id="total_qnt">{{$formObj->total_qnt}}</span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a id="add_new_product_tr" class="btn btn-success btn-sm">New Product</a></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-3">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>Total Amount:</b> <span class="float-end final-taxable-total">{{$formObj->total_amount_value}}</span></p>
                            <p>
                            <div class="input-group mb-3"><span class="input-group-text">Discount</span>
                                <input name="discount" id="discount-value" value="{{$formObj->discount}}" type="number" class="form-control text-right" min="0" max="100"><span class="input-group-text">%</span> <span class="input-group-text">Shipping Charge</span>
                                <input name="shipping_amount" id="shipping-charge-value" value="{{$formObj->shipping_amount}}" type="text" class="form-control text-right">
                            </div>
                            </p>
                            <p><b>Sub Total:</b> <span class="float-end sub-final-total">{{$formObj->sub_final_total_amount}}</span></p>
                            <p id="igst_row"><b>IGST (18.0%):</b> <span class="float-end igst-tax_amount">{{$formObj->igst_amount}}</span></p>
                            <p id="cgst_row"><b>CGST (9.0%):</b> <span class="float-end cgst-tax_amount">{{$formObj->cgst_amount}}</span></p>
                            <p id="sgst_row"><b>SGST (9.0%):</b> <span class="float-end sgst-tax_amount">{{$formObj->sgst_amount}}</span></p>
                            <p><b>Total:</b> <span class="float-end final-total">{{$formObj->final_total_amount}}</span></p>
                            {!! Form::hidden('total_amount_value', null, ['class' => 'form-control','id'=>'final-taxable-total-value']) !!}
                            {!! Form::hidden('igst_amount', null, ['class' => 'form-control','id'=>'igst-tax_amount-value']) !!}
                            {!! Form::hidden('cgst_amount', null, ['class' => 'form-control','id'=>'cgst-tax_amount-value']) !!}
                            {!! Form::hidden('sgst_amount', null, ['class' => 'form-control','id'=>'sgst-tax_amount-value']) !!}
                            {!! Form::hidden('final_total_amount', null, ['class' => 'form-control','id'=>'final-total-value']) !!}
                            {!! Form::hidden('sub_final_total_amount', null, ['class' => 'form-control','id'=>'sub-final-total-value']) !!}
                            {!! Form::hidden('is_igst', null, ['class' => 'form-control','id'=>'is_igst']) !!}
                            {!! Form::hidden('final_total_amount_words', null, ['class' => 'form-control','id'=>'final-total-value-words']) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p class="text-left" id="final_total_amount_words"></p>
                </div>
                <div class="mt-4">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="submit_btn">{{ $buttonText}}</button>
                    </div>
                </div>
                <input value="{{count($qnItems)}}" id="numRow" type="hidden">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('adminScript')
<script>
    $(document).ready(function() {
        shoGST();
        $('#add_tr').click(function() {
            let num = parseInt($('#numRow').val()) + 1;
            var html = '<tr id="tr-item-' + num + '"><td> ' + (num) + ' </td>';
            html += '<td><select name="product_size_id[]" class="form-select product-items" data-placeholder="Select Product" data-row="' + num + '" id="product-option-' + num + '"><option value = "" >Select Product</option></select></td>';
            html += '<input name="item_name[]" type="hidden" value="" id="product-name-' + num + '">';
            html += '<input name="product_id[]" type="hidden" value="" id="product-size-id-' + num + '">';
            html += '<td ><div class="col-sm-12"><input type="text" value="" name="product_hsn_code[]" id="hsn-code-' + num + '" class="form-control hsn-code"></div ></td>';
            html += '<td><input name="product_actual_price[]" data-row="' + num + '" class="form-control product_actual_price" type="text" value="0" id="product_actual_price-' + num + '"><span id="last-product-price-' + num + '"></span></td>';
            html += '<td><div class="col-sm-12"><input type="number" min="0" value="1" data-row="' + num + '" name="quantity[]" class="item-qnt form-control" id="item-qnt-' + num + '"></div ></td>';
            html += '<td class="" align="center"><h6 id="total-amount-txt-' + num + '">000.00</h6><input type="hidden" value="" name="total_amount[]" id="total-amount-' + num + '" class="form-control total-amount"></td> <td class="float-end" ><a class="btn btn-danger delete-item-tr"><i class="bi bi-trash"></i></a></td ></tr>';
            $('.tbodyTr').append(html);
            $('#numRow').val(num);
            $('#product-option-1 option').each(function() {
                $('#product-option-' + num).append($(this).clone());
            });
            $('.form-select').select2({
                allowClear: true,
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });
        });
        $('#add_new_product_tr').click(function() {
            let num = parseInt($('#numRow').val()) + 1;
            var html = '<tr id="tr-item-' + num + '"><td> ' + (num) + ' </td>';
            html += '<td><input name="product_size_id[]" type="text" data-row="' + num + '" value="" id="product-option-' + num + '" class="form-control"></td>';
            html += '<input name="item_name[]" type="hidden" value="" id="product-name-' + num + '">';
            html += '<input name="product_id[]" type="hidden" value="" id="product-size-id-' + num + '">';
            html += '<td ><div class="col-sm-12"><input type="text" value="" name="product_hsn_code[]" id="hsn-code-' + num + '" class="form-control hsn-code"></div ></td>';
            html += '<td><input name="product_actual_price[]" data-row="' + num + '" class="form-control product_actual_price" type="text" value="0" id="product_actual_price-' + num + '"><span id="last-product-price-' + num + '"></span></td>';
            html += '<td><div class="col-sm-12"><input type="number" min="0" value="1" data-row="' + num + '" name="quantity[]" class="item-qnt form-control" id="item-qnt-' + num + '"></div ></td>';
            html += '<td class="" align="center"><h6 id="total-amount-txt-' + num + '">000.00</h6><input type="hidden" value="" name="total_amount[]" id="total-amount-' + num + '" class="form-control total-amount"></td> <td class="float-end" ><a class="btn btn-danger delete-item-tr"><i class="bi bi-trash"></i></a></td ></tr>';
            $('.tbodyTr').append(html);
            $('#numRow').val(num);
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
                $('#product_actual_price-' + rowNo).val(price);
                $('#product-name-' + rowNo).val(selectedOption.text());
                $('#product-size-id-' + rowNo).val(selectedOption.data('product'));
                $('#hsn-code-' + rowNo).val(selectedOption.data('hsnCode'));
                $('#total-amount-txt-' + rowNo).html(price);
                $('#total-amount-' + rowNo).val(price);
            }
            allTotalPrices();
            getLastPrice(selectedOption.data('product'), rowNo);
        });
        $(document).on("change", ".product_actual_price", function() {
            if ($(this).val() > 0) {
                var rowNo = $(this).attr('data-row');
                var price = $(this).val();
                $('#product_actual_price-' + rowNo).val(price);
                var totl = parseFloat(price) * parseFloat($('#item-qnt-' + rowNo).val());
                $('#total-amount-' + rowNo).val(totl);
                $('#total-amount-txt-' + rowNo).html(totl);
                allTotalPrices();
            }
        });
        $(document).on("change", ".item-qnt", function() {
            if ($(this).val() > 0) {
                var rowNo = $(this).attr('data-row');
                var totl = parseFloat($('#product_actual_price-' + rowNo).val()) * parseFloat($(this).val());
                $('#total-amount-' + rowNo).val(totl);
                $('#total-amount-txt-' + rowNo).html(totl);
            }
            allTotalPrices();
        });
        $(document).on("change", "#shipping-charge-value", function() {
            allTotalPrices();
        });
        $(document).on("change", "#discount-value", function() {
            allTotalPrices();
        });
        $(document).on("change", "#client-select-box", function() {
            $('#is_igst').val(0);
            $('#igst_row').hide();
            $('#sgst_row').hide();
            $('#cgst_row').hide();
            if ($(this).val() > 0) {
                var selectedOption = $(this).find('option:selected');
                var address = selectedOption.data('address');
                var state = selectedOption.data('state');
                if (state != 'Gujarat') {
                    $('#is_igst').val(1);
                    $('#igst_row').show();
                } else {
                    $('#sgst_row').show();
                    $('#cgst_row').show();
                }
                $('#client_gstn').val(selectedOption.data('gstn'));
                $('#ship_address').val(selectedOption.data('shipaddress'));
                $('#ship_city').val(selectedOption.data('shipcity'));
                $('#ship_state').val(selectedOption.data('shipstate'));
                $('#ship_pincode').val(selectedOption.data('shippincode'));
                $('#bill_address').val(selectedOption.data('billaddress'));
                $('#bill_city').val(selectedOption.data('billcity'));
                $('#bill_state').val(selectedOption.data('billstate'));
                $('#bill_pincode').val(selectedOption.data('billpincode'));
                $('#ship_landmark').val(selectedOption.data('shiplandmark'));
                $('#bill_landmark').val(selectedOption.data('billlandmark'));
            }
        });
    });

    function allTotalPrices() {
        var tamounts = 0;
        var texts = document.getElementsByClassName("total-amount");
        for (var i = 0; i < texts.length; i++) {
            var aa = parseFloat(texts[i].value);
            if (aa == "NaN" || aa == null || aa == "") {
                aa = parseFloat("0");
            }
            tamounts = parseFloat(tamounts) + parseFloat(aa);
        }
        $('.final-taxable-total').html(amountFormat(tamounts));
        $('#final-taxable-total-value').val(amountFormat(tamounts));

        var discountValue = $('#discount-value').val();
        if (discountValue == "NaN" || discountValue == null || discountValue == "") {
            discountValue = parseFloat("0");
        }
        var withDiscout = parseFloat(tamounts) * (parseInt(discountValue) / 100);
        var finalWithDiscount = parseFloat(tamounts) - parseFloat(withDiscout);

        var shippingChargeValue = $('#shipping-charge-value').val();
        if (shippingChargeValue == "NaN" || shippingChargeValue == null || shippingChargeValue == "") {
            shippingChargeValue = parseFloat("0");
        }
        var countGst = parseFloat(finalWithDiscount) + parseFloat(shippingChargeValue);

        $('.sub-final-total').html(amountFormat(countGst));
        $('#sub-final-total-value').val(amountFormat(countGst));

        var is_igst = $('#is_igst').val();
        var iResult = 0;
        if (is_igst == 1) {
            var iResult = amountFormat(parseFloat(countGst) * 0.18);
            $('.igst-tax_amount').html(iResult);
            $('#igst-tax_amount-value').val(iResult);
        } else {
            var iResult = amountFormat(parseFloat(countGst) * 0.09);
            $('.sgst-tax_amount').html(iResult);
            $('#sgst-tax_amount-value').val(iResult);
            $('.cgst-tax_amount').html(iResult);
            $('#cgst-tax_amount-value').val(iResult);
            iResult = iResult + iResult;
        }
        amounts = parseFloat(countGst) + parseFloat(iResult);
        $('.final-total').html(amountFormat(amounts));
        $('#final-total-value').val(amountFormat(amounts));

        var quantityInputs = document.querySelectorAll('.item-qnt');
        var totalQ = 0;
        for (var i = 0; i < quantityInputs.length; i++) {
            var value = parseInt(quantityInputs[i].value);
            if (!isNaN(value)) {
                totalQ += value;
            }
        }
        $('#total_qnt').html(parseInt(totalQ));
        convertAmountToIndianWords(amountFormat(amounts));
    }

    function amountFormat(amount) {
        return parseFloat(amount.toFixed(2));
    }

    function shoGST() {
        $('#igst_row').hide();
        $('#sgst_row').hide();
        $('#cgst_row').hide();
        var is_igst = $('#is_igst').val();
        if (is_igst == 1) {
            $('#igst_row').show();
        } else {
            $('#sgst_row').show();
            $('#cgst_row').show();
        }
    }

    function convertAmountToIndianWords(amount) {
        var totalAmount = parseInt(amount);
        var decimalPart = Math.round((amount - Math.floor(amount)) * 100);
        var rupees = inWords(totalAmount);
        var paise = inWords(decimalPart);
        var wordsAmount = rupees + ' Rupees and ' + paise + ' Paise';
        $('#final-total-value-words').val(wordsAmount);
        $('#final_total_amount_words').html(wordsAmount);
    }

    function inWords(total_amount) {
        var num = total_amount;
        var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
        var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return;
        var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? '' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
        str = str.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
        return str;
    }
</script>
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/select2/js/select2-custom.js')}}"></script>
@endsection