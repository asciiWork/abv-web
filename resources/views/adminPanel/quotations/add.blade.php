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
                                {!! Form::date('quotation_date', date('Y-m-d'), ['class' => 'form-control']) !!}
                            </div>
                            </p>
                            <p class="fs-13">
                            <div class="input-group mb-2">
                                <div class="input-group-text">Quotation Due Date</div>
                                {!! Form::date('quotation_due_date', date('Y-m-d'), ['class' => 'form-control']) !!}
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
                            <select name="client_id" class="form-select" id="client-select-box" data-placeholder="Select Client">
                                <option value="">Select Client</option>
                                @foreach($clients as $clr)
                                <option value="{{$clr->id}}" data-billaddress="{{$clr->address}}" data-billcity="{{$clr->city}}" data-billlandmark="{{$clr->landmark}}" data-shiplandmark="{{$clr->ship_landmark}}" data-billstate="{{$clr->state}}" data-billpincode="{{$clr->pincode}}" data-shipAddress="{{$clr->ship_address}}" data-shipCity="{{$clr->ship_city}}" data-shipState="{{$clr->ship_state}}" data-shipPincode="{{$clr->ship_pincode}}" data-gstn="{{$clr->gstn}}" data-address="{{$clr->address}}" data-city="{{$clr->city}}" data-state="{{$clr->state}}">{{$clr->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <h6 class="fs-14">Billing Address</h6>
                        <div class="input-group"><span class="input-group-text">Street</span>
                            <input name="bill_address" id="bill_address" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">Landmark</span>
                            <input name="bill_landmark" id="bill_landmark" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">City</span>
                            <input name="bill_city" id="bill_city" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">State</span>
                            <input name="bill_state" id="bill_state" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">Pincode</span>
                            <input name="bill_pincode" id="bill_pincode" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <h6 class="fs-14">Shipping Address</h6>
                        <div class="input-group"><span class="input-group-text">Street</span>
                            <input name="ship_address" id="ship_address" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">Landmark</span>
                            <input name="ship_landmark" id="ship_landmark" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">City</span>
                            <input name="ship_city" id="ship_city" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">State</span>
                            <input name="ship_state" id="ship_state" type="text" class="form-control">
                        </div>
                        <div class="input-group"><span class="input-group-text">Pincode</span>
                            <input name="ship_pincode" id="ship_pincode" type="text" class="form-control">
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
                                    <tr id="tr-item-1">
                                        <td class="">1</td>
                                        <td>
                                            <select name="product_size_id[]" data-row="1" id="product-option-1" class="form-select product-items" data-placeholder="Select Product">
                                                <option value="">Select Product</option>
                                                @foreach($products as $prd)
                                                <option value="{{$prd->id}}" data-hsnCode="{{$prd->hsn_code}}" data-sizeproduct="{{$prd->product_size_id}}" data-product="{{$prd->product_id}}" data-price="{{$prd->price}}">{{$prd->product_code}}-{{$prd->product_name}} [{{$prd->product_size}}]</option>
                                                @endforeach
                                            </select>
                                            <input name="item_name[]" type="hidden" value="" id="product-name-1">
                                        </td>
                                        <td>
                                            <div class="col-sm-12">
                                                <input type="text" value="" name="product_hsn_code[]" id="hsn-code-1" class="form-control hsn-code">
                                            </div>
                                        </td>
                                        <td><input name="product_actual_price[]" type="text" data-row="1" class="form-control product_actual_price" value="0" id="product_actual_price-1">
                                            <input name="product_id[]" type="hidden" value="" id="product-size-id-1">
                                            <span id="last-product-price-1"></span>
                                        </td>
                                        <td>
                                            <div class="col-sm-12">
                                                <input type="number" min="0" value="1" data-row="1" name="quantity[]" class="form-control item-qnt" id="item-qnt-1">
                                            </div>
                                        </td>
                                        <td align="center">
                                            <h6 id="total-amount-txt-1">000.00</h6>
                                            <input type="hidden" value="" name="total_amount[]" id="total-amount-1" class="total-amount form-control">
                                        </td>
                                        <td class="float-end">
                                        </td>
                                    </tr>
                                </tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div>Total: &nbsp;<span id="total_qnt">0</span></div>
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
                            <p><b>Total Amount:</b> <span class="float-end final-taxable-total">000.00</span></p>
                            <p>
                            <div class="input-group mb-3"> <span class="input-group-text">Discount</span>
                                <input name="discount" id="discount-value" value="0" type="number" class="form-control text-right" min="0" max="100"><span class="input-group-text">%</span><span class="input-group-text">Shipping Charge</span>
                                <input name="shipping_amount" id="shipping-charge-value" value="0" type="text" class="form-control text-right">
                            </div>
                            </p>
                            <p><b>Sub Total:</b> <span class="float-end sub-final-total">000.00</span></p>
                            <p id="igst_row"><b>IGST (18.0%):</b> <span class="float-end igst-tax_amount">000.00</span></p>
                            <p id="cgst_row"><b>CGST (9.0%):</b> <span class="float-end cgst-tax_amount">000.00</span></p>
                            <p id="sgst_row"><b>SGST (9.0%):</b> <span class="float-end sgst-tax_amount">000.00</span></p>
                            <p><b>Total:</b> <span class="float-end final-total">000.00</span></p>
                            <input type="hidden" name="total_amount_value" id="final-taxable-total-value">
                            <input type="hidden" name="igst_amount" id="igst-tax_amount-value">
                            <input type="hidden" name="cgst_amount" id="cgst-tax_amount-value">
                            <input type="hidden" name="sgst_amount" id="sgst-tax_amount-value">
                            <input type="hidden" name="final_total_amount" id="final-total-value">
                            <input type="hidden" name="sub_final_total_amount" id="sub-final-total-value">
                            <input type="hidden" name="final_total_amount_words" id="final-total-value-words">
                            <input type="hidden" value="0" name="is_igst" id="is_igst">
                            <input type="hidden" value="0" name="is_invoice" id="is_invoice">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p class="text-left" id="final_total_amount_words"></p>
                </div>
                <div class="mt-4">
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="create_qtn">{{ $buttonText}}</button>
                        @if(\Auth::guard('admins')->user()->user_type_id == 1)
                        <button type="button" class="btn btn-warning" id="create_invoice">Make as Invoice</button>
                        @endif
                    </div>
                </div>
                <input value=" 1" id="numRow" type="hidden">
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('adminScript')
<script>
    $(document).ready(function() {
        $(document).on('click', '#create_qtn', function() {
            $('#is_invoice').val(0);
            $('#module-frm').submit();
        });
        $(document).on('click', '#create_invoice', function() {
            $('#is_invoice').val(1);
            $('#module-frm').submit();
        });
        $('#sgst_row').hide();
        $('#cgst_row').hide();
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
                $('#product-size-id-' + rowNo).val(selectedOption.data('sizeproduct'));
                $('#hsn-code-' + rowNo).val(selectedOption.data('hsnCode'));
                $('#total-amount-txt-' + rowNo).html(price);
                $('#total-amount-' + rowNo).val(price);
            }
            allTotalPrices();
            getLastPrice($(this).val(), rowNo);
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

    function getLastPrice(product_size_id, rowNo) {
        var client_id = $('#client-select-box').val();
        if (client_id > 0) {
            $.ajax({
                type: 'GET',
                url: "{{ route('admin-quotations.lastPrices') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "client_id": client_id,
                    "product_size_id": product_size_id,
                },
                success: function(result) {
                    $('#last-product-price-' + rowNo).html('<span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">LP: ' + result + '</span>');
                },
                error: function(error) {
                    alert(error);
                }
            });
        } else {
            /*$.NotificationApp.send("Note!", "Select client if want the last product price!", 'top-right', 'rgba(0,0,0,0.2)', 'info');*/
            Lobibox.notify('info', {
                title: 'Note!',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: 'bi bi-info-circle-fill',
                msg: 'Select client if want the last product price!'
            });
        }
    }

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