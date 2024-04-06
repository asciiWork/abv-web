@extends('web.layout.app')
@section('content')
<link rel="stylesheet" type="text/css" href="">
<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <p class="account__welcome--text">Hello, Admin welcome to your dashboard!</p>
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title mb-20">My Profile</h2>
                <ul class="account__menu">
                    <li class="account__menu--list"><a href="{{ route('web.my-account') }}">Dashboard</a></li>
                    <li class="account__menu--list active"><a href="{{ route('web.my-orders') }}">Orders</a></li>
                    <li class="account__menu--list"><a href="{{ route('web.my-address') }}">Addresses</a></li>
                    <li class="account__menu--list"><a href="{{ route('web.my-address') }}">Account details</a></li>
                    <li class="account__menu--list"><a href="{{ route('logout') }}">Log Out</a></li>
                </ul>
            </div>
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h2 mb-20"><i class="bi bi-dropbox text-secondary"></i> Order #{{$order->order_number}}</h2>
                </div>
                <div class="row py-4">
                    <div class="col-md-2 col-sm-6 col-12 m-b-md">
                        <div class="text-center">
                            <p>Order Number</p>
                            <p>#{{$order->order_number}}</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-12 m-b-md">
                        <div class="text-center">
                            <p>Status</p>
                            <p><a class="primary__btn">{{$order->order_status}}</a></p>
                        </div>
                    </div>
                    <div class=" col-md-3 col-sm-6 col-12 m-b-md">
                        <div class="text-center">
                            <p>Date</p>
                            <p>{{date_format(date_create($order->order_date),"F d, Y")}}</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-12 m-b-md">
                        <div class="text-center">
                            <p>Total</p>
                            <p>₹{{number_format($order->order_tax_amount_total,2)}}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 m-b-md">
                        <div class="text-center">
                            <p>Payment method</p>
                            <p>{{ ($order->payment_status != 'paid')?'Cash on delivery':'Paid' }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <aside class="checkout__sidebar sidebar border-radius-10">
                        <h3 class="checkout__order--summary__title">Your Order</h3>
                        <p>
                        <h4 class="">Product</h4>
                        </p>
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="cart__table--body">
                                    <?php $total = 0; ?>
                                    @foreach($orderDet as $ord)
                                    <tr class="cart__table--body__items">
                                        <td class="">{{$ord->product_name}} - {{$ord->prosize}} <b>× {{$ord->quantity}}</b><br>
                                            <p>size : {{$ord->prosize}}</p>
                                        </td>
                                        <td class=" text-right">₹{{ number_format($ord->total_amount,2) }}</td>
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
                                        <td class="text-right">₹{{ number_format($order->shipping_flat_charge,2) }}</td>
                                    </tr>
                                    <tr class="checkout__total--items">
                                        <td class="text-left"><b>GST</b></td>
                                        <td class="text-right">₹{{ number_format($order->gst_charge,2) }}</td>
                                    </tr>
                                    <tr class="checkout__total--items">
                                        <td class="text-left"><b>COD</b></td>
                                        <td class="text-right">₹{{ number_format($order->cod_charge,2) }}</td>
                                    </tr>
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left"><b>Total: </b></td>
                                        <td class=" checkout__total--footer__title checkout__total--footer__list text-right">
                                            <h2>₹{{ number_format($order->order_tax_amount_total,2) }}</h2>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </aside>
                </div>
                <div class="row py-5">
                    <div class="col-sm-6">
                        <h2>Billing Address</h2>
                        <p class="account__details--desc">{{$order->bil_name}}<br>
                            {{$order->bil_street}} , {{$order->bil_area}}<br>
                            {{$order->bil_city}} {{$order->bil_zipcode}}<br>
                            {{$order->bil_state}}<br>
                            {{$order->bil_phone}}<br>
                        </p>
                        <p>{{$order->contact_email}}</p>
                    </div>
                    <div class="col-sm-6">
                        <h2>Shipping Address</h2>
                        <p class="account__details--desc">
                            @if($order->ship_name) {{$order->ship_name}} @else {{$order->bil_name}} @endif <br>
                            @if($order->ship_street) {{$order->ship_street}} @else {{$order->bil_street}} @endif ,
                            @if($order->ship_area) {{$order->ship_area}} @else {{$order->bil_area}} @endif <br>
                            @if($order->ship_city) {{$order->ship_city}} @else {{$order->bil_city}} @endif ,
                            @if($order->ship_zipcode) {{$order->ship_zipcode}} @else {{$order->bil_zipcode}} @endif <br>
                            @if($order->ship_state) {{$order->ship_state}} @else {{$order->bil_state}} @endif <br>
                            @if($order->ship_phone) {{$order->ship_phone}} @else {{$order->bil_phone}} @endif <br>
                        </p>
                    </div>
                </div>
                <div>
                    <a class="primary__btn " href="{{ route('web.my-orders') }}">BACK TO LIST</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->
@endsection