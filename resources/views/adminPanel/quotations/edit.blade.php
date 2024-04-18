@extends('adminPanel.layouts.appNew')
@section('adminStyle')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style type="text/css">
    .select2-selection__rendered{
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
                    <div class="col-6">
                        <h6 class="fs-14">Customer</h6>
                        <div class="col-sm-6">
                            <select name="client_id" id="client-select-box" class="form-select" data-placeholder="Select Client">
                                <option value="">Select Client</option>
                                @foreach($clients as $clr)
                                <option value="{{$clr->id}}" {{$formObj->client_id == $clr->id ? 'selected' : ''}} data-address="{{$clr->address}}">{{$clr->cname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <h6 class="fs-14">Billing Address</h6>
                        {!! Form::textarea('client_address', null, ['id' => 'client-address', 'class' => 'form-control', 'rows'=>3]) !!}
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
                                        <th class="float-end"><a id="add_tr" class="btn btn-primary"><i class="bi bi-plus-lg"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyTr">
                                    @if($qnItems)
                                    <?php $i = 1; ?>
                                    @foreach($qnItems as $item)
                                    <tr id="tr-item-{{$i}}">
                                        <td class="">{{$i}}</td>
                                        <td>
                                            <select name="product_id[]" data-row="{{$i}}" id="product-option-{{$i}}" class="form-select product-items">
                                                <option value="">Select Product</option>
                                                @foreach($products as $prd)
                                                <option value="{{$prd->id}}" {{$prd->id == $item['product_id'] ? 'selected' : ''}} data-product="{{$prd->product_id}}" data-price="{{$prd->price}}">{{$prd->product_code}}-{{$prd->product_name}} [{{$prd->product_size}}]</option>
                                                @endforeach
                                            </select>
                                            <span id="last-product-price-{{$i}}"></span>
                                        </td>
                                        <td><input name="product_actual_price[]" type="text" class="form-control product_actual_price" value="{{$item['product_actual_price']}}" id="product_actual_price-{{$i}}">
                                            <input name="product_size_id[]" type="hidden" value="{{$item['product_size_id']}}" id="product-size-id-{{$i}}">
                                            <input name="item_name[]" type="hidden" value="{{$item['item_name']}}" id="product-name-{{$i}}">
                                        </td>
                                        <td>
                                            <div class="col-sm-8">
                                                <input type="number" min="0" value="{{$item['quantity']}}" data-row="{{$i}}" name="quantity[]" class="form-control item-qnt">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{$item['taxable_value']}}" name="taxable_value[]" id="taxable-value-{{$i}}" class="form-control taxable-value">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{$item['tax_amount']}}" name="tax_amount[]" id="tax-amount-{{$i}}" class="form-control tax_amount">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{$item['total_amount']}}" name="total_amount[]" id="total-amount-{{$i}}" class="total-amount form-control">
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
                            <p><b>Taxable Amount:</b> <span class="float-end final-taxable-total">{{$formObj->total_taxable_value}}</span></p>
                            <p><b>GST (18.0%):</b> <span class="float-end final-tax_amount">{{$formObj->gst_amount}}</span></p>
                            <p><b>Total:</b> <span class="float-end final-total">{{$formObj->final_total_amount}}</span></p>
                            <input type="hidden" value="{{$formObj->total_taxable_value}}" name="total_taxable_value" id="final-taxable-total-value">
                            <input type="hidden" value="{{$formObj->gst_amount}}" name="gst_amount" id="final-tax_amount-value">
                            <input type="hidden" value="{{$formObj->final_total_amount}}" name="final_total_amount" id="final-total-value">
                        </div>
                        <div class="clearfix"></div>
                    </div>
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
        $('#add_tr').click(function() {
            let num = parseInt($('#numRow').val()) + 1;
            var html = '<tr id="tr-item-' + num + '"><td> ' + (num) + ' </td>';
            html += '<td><div class = "col-sm-12" ><select name="product_id[]" class="form-select product-items" data-placeholder="Select Product" data-row="' + num + '" id="product-option-' + num + '"><option value = "" > Select Product</option></select> </div> </td>';
            html += '<input name="product_name[]" type="hidden" value="" id="product-name-' + num + '">';
            html += '<input name="product_size_id[]" type="hidden" value="" id="product-size-id-' + num + '">';
            html += '<td><input name="product_actual_price[]" type="text" class="form-control product_actual_price" value="" id="product_actual_price-' + num + '"></td>';
            html += '<td><div class="col-sm-8"><input type="number" min="0" value="1" data-row="' + num + '" name="quantity[]" class="item-qnt form-control"></div ></td>';
            html += '<td ><div class = "col-sm-10" ><input type="text" value="" name="taxable_value[]" id="taxable-value-' + num + '" class="form-control taxable-value" ></div ></td>';
            html += '<td ><div class="col-sm-10"><input type="text" value="" name="tax_amount[]" id="tax-amount-' + num + '" class="form-control tax_amount" ></div ></td>';
            html += '<td ><div class="col-sm-10"><input type="text" value="" name="total_amount[]" id="total-amount-' + num + '" class="form-control total-amount"></div></td>';
            html += '<td class="float-end" ><a class="btn btn-danger delete-item-tr"><i class="bi bi-trash"></i></a></td ></tr>';
            $('.tbodyTr').append(html);
            $('#numRow').val(num);
            $('#product-option-1 option').each(function() {
                $('#product-option-' + num).append($(this).clone());
            });
            $( '.form-select' ).select2( {
                allowClear: true,
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
            } );
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
                $('#product-name-' + rowNo).val(selectedOption.text());
                $('#product-size-id-' + rowNo).val(selectedOption.data('product'));
                $('#product_actual_price-' + rowNo).val(price);
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
                var totl = parseFloat($('#product_actual_price-' + rowNo).val()) * parseFloat($(this).val());
                $('#taxable-value-' + rowNo).val(totl);
                var result = parseFloat(totl) * 0.18;
                $('#tax-amount-' + rowNo).val(result);
                $('#total-amount-' + rowNo).val(parseFloat($('#tax-amount-' + rowNo).val()) + parseFloat($('#taxable-value-' + rowNo).val()));
            }
            allTotalPrices();
        });
        $(document).on("change", "#client-select-box", function() {
            if ($(this).val() > 0) {
                var selectedOption = $(this).find('option:selected');
                var address = selectedOption.data('address');
                $('#client-address').val(address);
            }
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
        $('#final-total-value').val(parseFloat(amounts));

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
        $('#final-taxable-total-value').val(parseFloat(tamounts));

        var gtamounts = 0;
        var texts = document.getElementsByClassName("tax_amount");
        for (var i = 0; i < texts.length; i++) {
            var aa = parseFloat(texts[i].value);
            if (aa == "NaN" || aa == null || aa == "") {
                aa = parseFloat("0");
            }
            gtamounts = parseFloat(gtamounts) + parseFloat(aa);
        }
        $('.final-tax_amount').html(parseFloat(gtamounts));
        $('#final-tax_amount-value').val(parseFloat(gtamounts));
    }
</script>
<script src=" {{ asset('public/admin-theme/assetsNew/modules/moduleForm.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('public/admin-theme/assetsRoksyn/plugins/select2/js/select2-custom.js')}}"></script>
@endsection