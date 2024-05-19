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

<body style="background-color: #F8F9FD;">
    <div style="box-sizing: border-box;">
        <div style="max-width: 70%;margin: 0 auto;padding: 30px 30px;background-color: white;">
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
                                            <b>ABV TOOL</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <b>GSTIN: 24ATKPV5305Q1Z0</b>
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
                                            <b>Email </b> abvtradesol@gmail.com
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
                                                <b>Due Date: {{date('d-m-Y',strtotime($invoice->quotation_date))}}</b>
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
                                                {{$invoice->bill_landmark}}
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
                                                {{$invoice->ship_landmark}}
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
                                <tr style="background-color: aliceblue;">
                                    <th>#</th>
                                    <th>Item</th>
                                    <th style="text-align: center;">HSN Code</th>
                                    <th style="text-align: center;">Rate / Item</th>
                                    <th style="text-align: center;" align="right">Qty.</th>
                                    <th style="text-align: right;" align="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($qnItems as $itm)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$itm->item_name}}</td>
                                    <td style="text-align: center;" align="center">{{ $itm->product_hsn_code}}</td>
                                    <td style="text-align: center;">{{$itm->product_actual_price}}</td>
                                    <td style="text-align: center;">{{$itm->quantity}}</td>
                                    <td style="text-align: right;" align="right">{{ number_format($itm->total_amount,2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tr style="border: none;">
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none;"></td>
                                <td style="border-bottom:none; text-align: center;">Total: {{$invoice->total_qnt}}</td>
                                <td style="border-bottom:none;"></td>
                            </tr>
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
                                        @if($invoice->discount)
                                        <tr>
                                            <td>
                                                <b>Discount</b>
                                            </td>
                                            <td>
                                                <b>{{$invoice->discount}} %</b>
                                            </td>
                                        </tr>
                                        @endif
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
                                                    <img src="{{asset('public/admin-theme/invoiceAssets/images/qrcode.png')}}" alt="" height="120" width="120">
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
        </div>
        <div style="display: flex;justify-content: center;align-items: center;border-radius: 26px;background: #FFF;box-shadow: 0px 25px 20px -20px rgba(18, 21, 28, 0.25);width: fit-content;padding: 2px;margin-left: auto;margin-right: auto;margin-bottom: 15px;">
            <div style="display: inline-flex;align-items: center;margin: 0 1px;">
                <a onclick="printInvoice()" style="background: #EF4444;padding: 12px 24px;border-radius: 24px 0px 0px 24px;display: flex;align-items: center;color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_10_61)">
                            <path d="M17 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142C20.7893 16.0391 21 15.5304 21 15V11C21 10.4696 20.7893 9.96086 20.4142 9.58579C20.0391 9.21071 19.5304 9 19 9H5C4.46957 9 3.96086 9.21071 3.58579 9.58579C3.21071 9.96086 3 10.4696 3 11V15C3 15.5304 3.21071 16.0391 3.58579 16.4142C3.96086 16.7893 4.46957 17 5 17H7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17 9V5C17 4.46957 16.7893 3.96086 16.4142 3.58579C16.0391 3.21071 15.5304 3 15 3H9C8.46957 3 7.96086 3.21071 7.58579 3.58579C7.21071 3.96086 7 4.46957 7 5V9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7 15C7 14.4696 7.21071 13.9609 7.58579 13.5858C7.96086 13.2107 8.46957 13 9 13H15C15.5304 13 16.0391 13.2107 16.4142 13.5858C16.7893 13.9609 17 14.4696 17 15V19C17 19.5304 16.7893 20.0391 16.4142 20.4142C16.0391 20.7893 15.5304 21 15 21H9C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19V15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_10_61">
                                <rect width="24" height="24" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    <span style="padding: 5px 5px;">Print</span>
                </a>
            </div>
            <div style="display: inline-flex;align-items: center;margin: 0 1px;">
                <a onclick="pdfInvoice()" style="background: #00D061;padding: 12px 24px;border-radius: 0px 24px 24px 0px;display: -webkit-inline-box;display: -ms-inline-flexbox;display: inline-flex;-webkit-box-align: center; color: white;" id="generatePDF">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_5_246)">
                            <path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7 11L12 16L17 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12 4V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_5_246">
                                <rect width="24" height="24" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                    <span style="padding: 5px 5px;">Download</span>
                </a>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('public/admin-theme/assetsRoksyn/js/jquery.min.js')}}"></script>
<script>
    function printInvoice() {
        $.ajax({
            type: "GET",
            url: window.location.href + '?isPrint=1',
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function(result) {
                var printWindow = window.open('', '', 'width=1000,height=1000');
                printWindow.document.write(result);
                printWindow.document.close();
                printWindow.print();
            }
        })
    }

    function pdfInvoice() {
        setTimeout(function() {
            $url = window.location.href + '?isPdf=1'
            window.location = $url;
        }, 400);
    }
</script>

</html>