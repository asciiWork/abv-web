@extends('adminPanel.layout.appNew')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{ asset('public/web/assets/img/abv.png') }}" alt="dark logo" height="22">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                </div>
                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <!-- <p><b>Hello, Thomson</b></p> -->
                            <!-- <p class="fs-13">A-205, Krish Elite Commercial Complex, Nr Vishala Land Mark,B/H Sankalp International School, Ahmedabad-382350, Gujarat, India <br>info@abvtool.in <br>+91 78744 27439  +91 84695 55348</p> -->
                        </div>
                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{date_format(date_create($order->order_date),"d M, Y")}}</p>
                            <p class="fs-13"><strong>Order Status: </strong> 
                                @if($order->order_status==App\Models\Carts::$PLACED)
                                    <span class="badge bg-success float-end">Placed</span></p>
                                @else
                                    <span class="badge bg-danger float-end">Pending</span></p>
                                @endif
                            <p class="fs-13"><strong>Order ID: </strong> <span class="float-end">#{{ $order->order_number}}</span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                <div class="row mt-4">
                    <div class="col-6">
                        <h6 class="fs-14">Billing Address</h6>
                        <address>
                            <?=($order->bil_street)?$order->bil_street:$order->ship_street?>,
                            <?=($order->bil_area)?$order->bil_area.',<br>':$order->ship_area.',<br>'?>
                            <?=($order->bil_city)?$order->bil_city.'-':$order->ship_city.'-'?>
                            <?=($order->bil_zipcode)?$order->bil_zipcode.',<br>':$order->ship_zipcode.',<br>'?>
                            <?=($order->bil_state)?$order->bil_state:$order->ship_state?>,
                            {{$order->country}},<br>
                            <abbr title="Phone">P:</abbr> <?=($order->bil_phone)?$order->bil_phone:$order->ship_phone?>
                        </address>
                    </div> <!-- end col-->
                    <div class="col-6">
                        <h6 class="fs-14">Shipping Address</h6>
                        <address>
                            <?=($order->ship_street)?$order->ship_street:$order->bil_street?>,
                            <?=($order->ship_area)?$order->ship_area.',<br>':$order->bil_area.',<br>'?>
                            <?=($order->ship_city)?$order->ship_city.'-':$order->bil_city.'-'?>
                            <?=($order->ship_zipcode)?$order->ship_zipcode.',<br>':$order->bil_zipcode.',<br>'?>
                            <?=($order->ship_state)?$order->ship_state:$order->bil_state?>,
                            {{$order->country}},<br>
                            <abbr title="Phone">P:</abbr> <?=($order->ship_phone)?$order->ship_phone:$order->bil_phone?>
                        </address>
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr><th>#</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th class="text-end">Total</th>
                                </tr></thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($orderDetails as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><b>{{ $item->product_name }}</b><br>{{ $item->prosize }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->amount,2) }}</td>
                                    <td class="text-end">₹{{ number_format($item->total_amount,2) }}</td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <div class="clearfix pt-3">
                            <h6 class="text-muted fs-14">Notes:</h6>
                            <small>
                                All accounts are to be paid within 7 days from receipt of
                                invoice. To be paid by cheque or credit card or direct payment
                                online. If account is not paid within 7 days the credits details
                                supplied as confirmation of work undertaken will be charged the
                                agreed quoted fee noted above.
                            </small>
                        </div> -->
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>Sub-total:</b> <span class="float-end">₹{{ number_format($order->total_amount,2) }}</span></p>
                            <p><b>Shipping Rate:</b> <span class="float-end">₹{{ number_format($order->shipping_flat_charge,2) }}</span></p>
                            <p><b>GST(18%):</b> <span class="float-end">₹{{ number_format($order->gst_charge,2) }}</span></p>
                            <p><b>COD:</b> <span class="float-end">₹{{ number_format($order->cod_charge,2) }}</span></p>
                            <h3>₹{{ number_format($order->order_tax_amount_total,2) }}</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row-->
                <div class="d-print-none mt-4">
                    <div class="text-center">
                        <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                        <a href="{{ route('admin-orders.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>   
                <!-- end buttons -->
            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>
@endsection