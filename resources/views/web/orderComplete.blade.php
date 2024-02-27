@extends('web.layout.app')
@section('content')

<!-- Start about section -->
<section class="about__section section--padding mb-95">
    <div class="container">
        <div class="row mx-5">
            <div class="col-lg-12 col-sm-12">
                <div class="about__content my-4">
                    <aside class="checkout__sidebar sidebar border-radius-10" style="border-color: green">
                        <h4 class="checkout__order--summary__title"><i class="bi bi-check-lg" style="color: green;font-size: 2.7rem"></i> Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be processing your order soon.</h4>
                    </aside>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-2 col-sm-6 col-12 m-b-md">
                    <div class="text-center">
                        <p>Order Number</p><b>{{$order->id}}</b>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-12 m-b-md">
                    <div class="text-center">
                        <p>Status</p><p>{{$order->order_status}}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 m-b-md">
                    <div class="text-center">
                        <p>Date</p><b>{{date_format(date_create($order->order_date),"F d, Y")}}</b>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-12 m-b-md">
                    <div class="text-center">
                        <p>Total</p><b>₹{{$order->total_amount}}</b>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 m-b-md">
                    <div class="text-center">
                        <p>Payment method</p><b>Cash on delivery</b>
                    </div>
                </div>
            </div>
            <div class="row">
                <p>Pay with cash upon delivery.</p>
                <aside class="checkout__sidebar sidebar border-radius-10">
                        <h3 class="checkout__order--summary__title">Your Order</h3>
                        <p><h4 class="">Product</h4></p>
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="cart__table--body">
                                    <?php $total = 0; ?>
                                    @foreach($orderDet as $ord)
                                    <tr class="cart__table--body__items">
                                        <td class="">{{$ord->product_name}} - {{$ord->prosize}} <b>× {{$ord->quantity}}</b><br><p>size : {{$ord->prosize}}</p></td>
                                        <td class=" text-right" >₹{{ number_format($ord->total_amount,2) }}</td>
                                    </tr>
                                    <?php $total = $total + $ord->total_amount;  ?>
                                    @endforeach
                                    <tr class="cart__table--body__items">
                                        <td class=""><b>Subtotal : </b></td>
                                        <td class=" text-right">₹{{ number_format($total,2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="checkout__total--body">
                                    <tr class="checkout__total--items">
                                        <td class="text-left"><b>Shipping</b></td>
                                        <td class="text-right">₹{{ number_format($order->shipping_charge,2) }} via Flat rate</td>
                                    </tr>
                                
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left"><b>Payment method: </b></td>
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-right">Cash on delivery</td>
                                    </tr>
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left"><b>Total: </b></td>
                                        <td class=" checkout__total--footer__title checkout__total--footer__list text-right"><h2>₹{{ number_format($order->total_amount,2) }}</h2></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                        
                    </aside>
            </div>
        </div>
    </div>
</section>
<!-- End about section -->
@endsection