<!doctype html>
<html lang="en">

<head>
    <title>ABV Tool</title>
    <style>
        .main-tabel-dv td {
            padding: 0px;
            margin: 0px;
        }

        table {
            border-collapse: collapse !important;
            font-size: 16px;
            font-family: sans-serif;
        }

        .main-tabel-dv th {
            border-top: 2px solid blue;
            border-bottom: 2px solid blue;
            padding: 10px 0px;
            text-align: left;

        }

        .main-tabel-dv th:first-of-type,
        .main-tabel-dv td:first-of-type {
            width: 50px;
        }

        .main-tabel-dv tr td {
            border-bottom: 2px solid gray;
            padding: 10px 0px;
            text-align: left;
        }

        .main-tabel-blg td {
            border-bottom: 2px solid blue;
            padding: 10px 0px;

        }

        .border-b-blg {
            border-top: 2px solid gray;
        }

        .total-blg-dv table:first-of-type {
            width: 767px;
        }

        .total-blg-dv table td {
            text-align: right;
        }

        .total-blg-dv .ttl-blg {
            min-width: 200px;
            margin: 5px 0px
        }
    </style>
</head>

<body>
    <table width="991">
        <tbody>
            <tr>
                <td align="left" width="50%">
                    <table width="50%">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <b>
                                    @if($invoice->is_invoice)
                                    <a href="#">I N V O I C E</a>
                                    @else
                                    <a href="#">Q U O T A T I O N</a>
                                    @endif
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    ABV TOOL
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    GSTIN <b>24ATKPV5305Q1Z0</b>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    A-205, Krish Elite Commercial Complex
                                    Nr Vishala Land Mark,B/H Sankalp International School, Ahmedabad
                                    Ahmedabad-382350, Gujarat, India
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td align="right" width="50%" valign="top">
                    <table width="120" height="100">
                        <tr>
                            <td>
                                <img src="{{asset('public/admin-theme/invoiceAssets/images/logo.gif')}}" alt="" width="250" height="auto">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" width="100%">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <b> Mobile</b> 7874427439, 8469555348
                                </td>
                                <td>
                                    <b>Email</b> abvtradesol@gmail.com
                                </td>
                            </tr>
                            <tr>
                                <td width="320">
                                    <b> Website</b> <a href="www.abvtool.in">www.abvtool.in</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <table width="991" class="pad-tb-dv">
                    <td align="left">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        @if($invoice->is_invoice)
                                        <b>Quotation #: {{$invoice->invoice_number}} </b>
                                        @else
                                        <b>Quotation #: {{$invoice->quotation_number}} </b>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td align="left">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        @if($invoice->is_invoice)
                                        <b>Invoice Date : {{date('d-m-Y',strtotime($invoice->invoice_date))}}</b>
                                        @else
                                        <b>Quotation Date : {{date('d-m-Y',strtotime($invoice->quotation_date))}}</b>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td align="left">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        @if(!$invoice->is_invoice)
                                        <b>Due Date: {{date('d-m-Y',strtotime($invoice->quotation_due_date))}}</b>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </table>
            </tr>
            <br>
            <tr>
                <table width="991">
                    <td align="left">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Billing Address:</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>{{$client->company_name}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->bill_address}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->bill_city}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->bill_state}}, {{$invoice->bill_pincode}}, India.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>GSTIN: </b>{{$invoice->client_gstn}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Mo: </b>{{$client->phone_1}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    @if(!empty($invoice->ship_address))
                    <td align="left" valign="top">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Shipping Address:</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->ship_address}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->ship_city}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{$invoice->ship_state}}, {{$invoice->ship_pincode}}, India.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    @endif
                </table>
            </tr>
            <br>
            <br>
            <tr>
                <table width="991px" class="main-tabel-dv">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th align="center">HSN Code</th>
                            <th>Rate / Item</th>
                            <th>Qty</th>
                            <th align="right">Taxable Value</th>
                            <th align="right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($qnItems as $itm)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$itm->item_name}}</td>
                            <td align="center">{{ $itm->product_hsn_code}}</td>
                            <td>{{$itm->product_actual_price}}</td>
                            <td>{{$itm->quantity}}</td>
                            <td align="right">{{ number_format($itm->taxable_value,2)}}</td>
                            <td align="right">{{ number_format($itm->total_amount,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table width="991" class="total-blg-dv">
                    <tr align="right">
                        <td>
                            <table width="450">
                                <tr>
                                    <td>
                                        <b>Total Amount</b>
                                    </td>
                                    <td>
                                        <b>₹{{ number_format($invoice->total_amount_value,2)}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Shipping Charge</b>
                                    </td>
                                    <td>
                                        <b>₹{{ number_format($invoice->shipping_amount,2)}}</b>
                                    </td>
                                </tr>
                                @if($invoice->is_igst)
                                <tr>
                                    <td>
                                        <b>IGST 18.0%</b>
                                    </td>
                                    <td>
                                        <b>₹{{ number_format($invoice->igst_amount,2)}}</b>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        <b>SGST 09.0%</b>
                                    </td>
                                    <td>
                                        <b>₹{{ number_format($invoice->sgst_amount,2)}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>CGST 09.0%</b>
                                    </td>
                                    <td>
                                        <b>₹{{ number_format($invoice->cgst_amount,2)}}</b>
                                    </td>
                                </tr>
                                @endif
                            </table>
                            <table width="320" class="ttl-blg">
                                <tr class="border-b-blg">
                                    <td style="font-size: 25px;">
                                        <b>Total</b>
                                    </td>
                                    <td style="font-size: 25px;">
                                        <b>₹{{ number_format($invoice->final_total_amount,2)}}</b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <br>
                </table>
            </tr>
            <br />
            <tr>
                <table width="991px">
                    <tbody>
                        <tr>
                            <td>
                                <table class="main-tabel-blg" style="border-bottom: 1px solid rgba(23, 23, 172, 0.8);">
                                    <tr>
                                        <td width="320"></td>
                                        <td width="920">Total amount (in words) : {{$invoice->final_total_amount_words}} Only.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <br />
            <br />
            <tr>
                <table width="991px">
                    <tbody>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td><b>Pay useing UPI</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset('public/admin-theme/invoiceAssets/images/code.png')}}" alt="" height="120" width="120">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table>
                                    <tr>
                                        <td><b>Bank Details</b></td>
                                    </tr>
                                    <tr>
                                        <td>Bank</td>
                                        <td><b>HDFC BANK</b></td>
                                    </tr>
                                    <tr>
                                        <td>Acount # :</td>
                                        <td><b>52200068238921</b></td>
                                    </tr>
                                    <tr>
                                        <td>IFSC</td>
                                        <td><b>HDFC0006476</b></td>
                                    </tr>
                                    <tr>
                                        <td>Branch :</td>
                                        <td><b>SP Ring Road</b></td>
                                    </tr>
                                </table>
                            </td>
                            <td align="right">
                                <table>
                                    <tr>
                                        <td align="right">Fro ABV TOOL</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{asset('public/admin-theme/invoiceAssets/images/sign.png')}}" alt="" width="200">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"> Authorized Signatory</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </tr>
            <br />
            <br />
            <tr>
                <table width="991px">
                    <tbody>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td><b>Terms & conditions</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1. Goods once sold will not be taken back.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2. Subject to Ahmedabad jurisdiction
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br /><br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        </tbody>
    </table>
</body>

</html>