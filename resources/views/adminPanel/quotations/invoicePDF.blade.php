<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ABVTOOL - Digital Invoica</title>
    <link href="assets/images/favicon/icon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/invoiceAssets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin-theme/invoiceAssets/css/media-query.css')}}">
</head>

<body>
    <!--Invoice wrap start here -->
    <div class="invoice_wrap coffee-invoice">
        <div class="invoice-container">
            <div class="invoice-content-wrap" id="download_section">
                <!--Header start here -->
                <header class="coffee_header" id="invo_header">
                    <div class="header-top-coffee width-70">
                        @if($invoice->is_invoice)
                        <h1 class="coffee-txt">INVOICE</h1>
                        @else
                        <h1 class="coffee-txt">QUOTATION</h1>
                        @endif
                    </div>
                    <div class="invoice-logo-content-coffee ">
                        <div class="coffee-black">
                            <div class="brown-bg"></div>
                        </div>
                        <div class="invoice-logo-coffee">
                            <a href="/"><img src="{{ asset('public/web/assets/img/abv.png') }}" alt="logo"></a>
                        </div>
                        <div class="invo-head-content-coffee">
                            <div class="invo-head-wrap">
                                @if($invoice->is_invoice)
                                <div class="font-sm-700 color-white">Invoice # </div>
                                <div class="font-sm color-white"> {{$invoice->invoice_number}}</div>
                                @else
                                <div class="font-sm-700 color-white">Quotation # </div>
                                <div class="font-sm color-white"> {{$invoice->quotation_number}}</div>
                                @endif
                            </div>
                            <div class="invo-head-wrap">
                                @if($invoice->is_invoice)
                                <div class="font-sm-700 color-white">Date: &nbsp;</div>
                                <div class="font-sm color-white"> {{$invoice->invoice_date}}</div>
                                @else
                                <div class="font-sm-700 color-white">Date: &nbsp;</div>
                                <div class="font-sm color-white"> {{$invoice->quotation_date}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="coffee-triangle-image">
                        </div>
                    </div>
                </header>
                <!--Header end here -->
                <!--Invoice content start here -->
                <section class="agency-service-content ecommerce-invoice-content" id="coffee_shop_invoice">
                    <div class="coffee-shop-back-img-one">
                    </div>
                    <div class="container">
                        <!--Invoice owner name start here -->
                        <div class="invoice-owner-conte-wrap pt-40">
                            <div class="invo-to-wrap">
                                <div class="invoice-to-content">
                                    <p class="font-md color-light-black">To:</p>
                                    <h2 class="font-lg color-coffe pt-10">{{$client->name}}</h2>
                                    <p class="font-md-grey color-grey pt-10">{!! $client->address !!}</p>
                                    <p class="font-md-grey color-grey pt-10">{{ $client->phone }}</p>
                                </div>
                            </div>
                            <div class="invo-pay-to-wrap">
                                <div class="invoice-pay-content">
                                    <p class="font-md color-light-black">Pay To:</p>
                                    <h2 class="font-lg color-coffe pt-10">ABV TOOL</h2>
                                    <p class="font-md-grey color-grey pt-10">GSTIN: 24ATKPV5305Q1Z0</p>
                                    <p class="font-md-grey color-grey pt-10">Ahmedabad-382350, Gujarat, India</p>
                                </div>
                            </div>
                        </div>
                        <!--Invoice owner name end here -->
                        <!--Coffee table data start here -->
                        <div class="table-wrapper pt-40">
                            <table class="invoice-table coffee-table">
                                <thead>
                                    <tr class="invo-tb-header">
                                        <th class="font-md color-grey">Item</th>
                                        <th class="font-md color-grey">Rate</th>
                                        <th class="font-md color-grey">Qty</th>
                                        <th class="font-md color-grey">Taxable Value</th>
                                        <th class="font-md color-grey">Tax Amount(18%)</th>
                                        <th class="font-md color-grey">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="invo-tb-body">
                                    @foreach($qnItems as $itm)
                                    <tr class="invo-tb-row">
                                        <td class="font-sm">{{$itm->item_name}}</td>
                                        <td class="font-sm text-center">{{$itm->product_actual_price}}</td>
                                        <td class="font-sm text-center">{{$itm->quantity}}</td>
                                        <td class="font-sm text-center">{{ number_format($itm->taxable_value,2)}}</td>
                                        <td class="font-sm text-center">{{ number_format($itm->tax_amount,2)}}</td>
                                        <td class="font-sm">{{ number_format($itm->total_amount,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--Coffee table data end here -->
                        <!--Invoice additional info start here -->
                        <div class="invo-addition-wrap pt-20">
                            <div class="invo-add-info-content">
                                <h3 class="font-md color-light-black">Terms & Conditions:</h3>
                                <p class="font-sm pt-10">Your use of the Website shall be deemed to constitute your understanding and approval of, and agreementto be bound by, the Privacy Policy and you consent to the collection.</p>
                            </div>
                            <div class="invo-bill-total width-30">
                                <table class="invo-total-table">
                                    <tbody>
                                        <tr>
                                            <td class="font-md color-light-black ">Taxable Amount:</td>
                                            <td class="font-md-grey color-grey text-right">₹{{ number_format($invoice->total_taxable_value,2)}}</td>
                                        </tr>
                                        <tr class="tax-row bottom-border">
                                            <td class="font-md color-light-black ">Tax <span class="">(18%)</span></td>
                                            <td class="font-md-grey color-grey text-right">₹{{ number_format($invoice->gst_amount,2)}}</td>
                                        </tr>
                                        <tr class="invo-grand-total">
                                            <td class="font-18-700 color-coffe">Total:</td>
                                            <td class="font-18-500 color-light-black text-right">₹{{ number_format($invoice->final_total_amount,2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Invoice additional info end here -->
                        <!--Coffee payment detail table start here -->
                        <div class="rest-payment-bill">
                            <div class="payment-wrap payment-wrap-car">
                                <table class="res-pay-table">
                                    <tbody>
                                        <tr class="pay-data">
                                            <td class="font-md color-light-black pay-type">Bank:</td>
                                            <td class="font-md-grey color-grey pay-type">HDFC BANK</td>
                                        </tr>
                                        <tr class="pay-data">
                                            <td class="font-md color-light-black pay-type">Account:</td>
                                            <td class="font-md-grey color-grey pay-type">50200068238921</td>
                                        </tr>
                                        <tr class="pay-data">
                                            <td class="font-md color-light-black pay-type">IFSC:</td>
                                            <td class="font-md-grey color-grey pay-type">HDFC0006476</td>
                                        </tr>
                                        <tr class="pay-data">
                                            <td class="font-md color-light-black pay-type">Branch:</td>
                                            <td class="font-md-grey color-grey pay-type">SP Ring Road</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="signature-wrap">
                                <div class="sign-img">
                                    <img src="{{ asset('public/admin-theme/invoiceAssets/images/coffee-shop/sign.svg') }}" alt="this is signature image">
                                </div>
                                <p class="font-sm-500">ABV TOOL</p>
                                <h3 class="font-md-grey color-light-black">Authorized Signatory</h3>
                            </div>
                        </div>
                        <!-- Coffee payment detail table end here -->

                    </div>
                    <!--Coffee shop contact us detail start here -->
                    <div class="coffee-bottom-sec-footer">
                        <div class="coffee-bottom-sec">
                            <div class="coffee-triangle-image coffee-triangle-image-footer">
                            </div>
                        </div>
                        <div class="coffee-bottom-contact">
                            <div class="bus-conta-mail-wrap coffee-conta-mail-wrap">
                                <div class="bus-invo-num coffee-contact">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_6_94)">
                                            <path d="M5 4H9L11 9L8.5 10.5C9.57096 12.6715 11.3285 14.429 13.5 15.5L15 13L20 15V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21C14.0993 20.763 10.4202 19.1065 7.65683 16.3432C4.8935 13.5798 3.23705 9.90074 3 6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 7C15.5304 7 16.0391 7.21071 16.4142 7.58579C16.7893 7.96086 17 8.46957 17 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 3C16.5913 3 18.1174 3.63214 19.2426 4.75736C20.3679 5.88258 21 7.4087 21 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_6_94">
                                                <rect width="24" height="24" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <a class="font-18 " href="tel:+917874427439">+91 78744 27439 | +91 84695 55348</a>
                                </div>
                                <div class="bus-invo-date coffee-mail">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_6_108)">
                                            <path d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3 7L12 13L21 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_6_108">
                                                <rect width="24" height="24" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <a class="font-18" href="mailto:info@abvtool.in">abvtradesol@gmail.com</a>
                                </div>
                            </div>
                            <div class="coffee-thank-txt">
                                <p class="font-sm color-light-black coffee-txt-bottom"> A-205, Krish Elite Commercial Complex, Nr Vishala Land Mark, B/H Sankalp International School, Ahmedabad-382350, Gujarat, India</p>
                            </div>
                        </div>
                    </div>
                    <!--Coffee shop contact us detail end here -->
                </section>
                <!--Invoice content end here -->
            </div>
            <!--Bottom content start here -->
            <section class="agency-bottom-content d-print-none" id="agency_bottom">
                <!--Print-download content start here -->
                <div class="invo-buttons-wrap">
                    <div class="invo-print-btn invo-btns">
                        <a href="javascript:window.print()" class="print-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <g clip-path="url(#clip0_10_61)">
                                    <path d="M17 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142C20.7893 16.0391 21 15.5304 21 15V11C21 10.4696 20.7893 9.96086 20.4142 9.58579C20.0391 9.21071 19.5304 9 19 9H5C4.46957 9 3.96086 9.21071 3.58579 9.58579C3.21071 9.96086 3 10.4696 3 11V15C3 15.5304 3.21071 16.0391 3.58579 16.4142C3.96086 16.7893 4.46957 17 5 17H7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17 9V5C17 4.46957 16.7893 3.96086 16.4142 3.58579C16.0391 3.21071 15.5304 3 15 3H9C8.46957 3 7.96086 3.21071 7.58579 3.58579C7.21071 3.96086 7 4.46957 7 5V9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 15C7 14.4696 7.21071 13.9609 7.58579 13.5858C7.96086 13.2107 8.46957 13 9 13H15C15.5304 13 16.0391 13.2107 16.4142 13.5858C16.7893 13.9609 17 14.4696 17 15V19C17 19.5304 16.7893 20.0391 16.4142 20.4142C16.0391 20.7893 15.5304 21 15 21H9C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19V15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_10_61">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="inter-700 medium-font">Print</span>
                        </a>
                    </div>
                    <div class="invo-down-btn invo-btns">
                        <a class="download-btn" id="generatePDF">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_5_246)">
                                    <path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M7 11L12 16L17 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 4V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_5_246">
                                        <rect width="24" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span class="inter-700 medium-font">Download</span>
                        </a>
                    </div>
                </div>
                <!--Print-download content end here -->
                <!--Note content start -->
                <div class="invo-note-wrap">
                    <div class="note-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_8_240)">
                                <path d="M14 3V7C14 7.26522 14.1054 7.51957 14.2929 7.70711C14.4804 7.89464 14.7348 8 15 8H19" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M17 21H7C6.46957 21 5.96086 20.7893 5.58579 20.4142C5.21071 20.0391 5 19.5304 5 19V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H14L19 8V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21Z" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 7H10" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 13H15" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 17H15" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_8_240">
                                    <rect width="24" height="24" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="font-md color-light-black">Note:</span>
                    </div>
                    <h3 class="font-md-grey color-grey note-desc">This is computer generated receipt and does not require physical signature.</h3>
                </div>
                <!--Note content end -->
            </section>
            <!--Bottom content end here -->
        </div>
    </div>
    <!--Invoice wrap end here -->
    <script src="{{ asset('public/admin-theme/invoiceAssets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/invoiceAssets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/invoiceAssets/js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('public/admin-theme/invoiceAssets/js/custom.js') }}"></script>
</body>

</html>