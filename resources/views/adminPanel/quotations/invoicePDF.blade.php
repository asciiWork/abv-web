<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

    <style type="text/css">
        body {
            -webkit-text-size-adjust: none !important;
            font-family: 'Poppins', sans-serif;
            font-style: normal;
            font-weight: 100;
            font-size: 10px;
            letter-spacing: 1px;
            margin: 2%;
        }

        table {
            background-color: transparent;
            border-spacing: 0;
            width: 100%;
        }

        th {
            color: #222;
            border: 1px solid #ddd;
            padding: 0.5em;
            background: #eee;
            text-align: left;
        }

        td {
            border: 1px solid #ddd;
            padding: 0.5em;
        }

        .b-0 {
            border: 0;
        }

        .bt-0 {
            border-top: 0;
        }

        .bb-0 {
            border-bottom: 0;
        }

        .bl-0 {
            border-left: 0;
        }

        .br-0 {
            border-right: 0;
        }

        .p-0 {
            padding: 0;
        }

        .stamp {
            width: 17%;
        }

        .sign {
            width: 100px;
            margin-top: -34px;
            margin-left: auto;
        }

        .sign img {
            max-width: 100%;
            height: auto;
        }

        .stamp img {
            max-width: 100%;
            height: auto;
        }

        @media screen and (max-width:600px) {}

        @media screen and (max-width:480px) {}
    </style>
</head>

<body>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="float-start">
                                <p><b>ABV TOOL</b></p>
                                <p class="text-muted fs-13"><b>GSTIN 24ATKPV5305Q1Z0</b> </p>
                                <p class="m-0 p-0">A-205, Krish Elite Commercial Complex</p>
                                <p class="m-0 p-0">Nr Vishala Land Mark,B/H Sankalp International School, Ahmedabad</p>
                                <p class="m-0 p-0">Ahmedabad-382350, Gujarat, India</p>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-2">
                            <div class="float-sm-end">
                                <p class="fs-13">
                                <div class="input-group mb-2">
                                    <div class="input-group-text">{{$formObj->quotation_number}}</div>
                                </div>
                                </p>
                                <p class="fs-13">
                                <div class="input-group mb-2">
                                    <div class="input-group-text">{{$formObj->quotation_date}}</div>
                                </div>
                                </p>
                                <p class="fs-13">
                                <div class="input-group mb-2">
                                    <div class="input-group-text">{{$formObj->quotation_due_date}}</div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <h6 class="fs-14">Customer</h6>
                            <div class="col-sm-6">
                                {{$formObj->client_id}}
                            </div>
                        </div>
                        <div class="col-4">
                            <h6 class="fs-14">Billing Address</h6>
                            <address>
                                {{$formObj->client_address}}
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
                                        <?php $i = 1; ?>
                                        @foreach($qnItems as $item)
                                        <tr id="tr-item-{{$i}}">
                                            <td class="">{{$i}}</td>
                                            <td>
                                                <div class="col-sm-12">
                                                    {{$item['item_name'] }}
                                                </div>
                                            </td>
                                            <td>{{$item['product_actual_price']}}</td>
                                            <td>{{$item['quantity']}}</td>
                                            <td>{{$item['taxable_value']}}</td>
                                            <td>{{$item['tax_amount']}}</td>
                                            <td>{{$item['total_amount']}}</td>
                                        </tr>
                                        </tr>
                                        <?php $i++; ?>
                                        @endforeach
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
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>