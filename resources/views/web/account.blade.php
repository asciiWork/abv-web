@extends('web.layout.app')
@section('content')
<link rel="stylesheet" type="text/css" href="">
<!-- my account section start -->
<section class="my__account--section section--padding">
    <div class="container">
        <div class="my__account--section__inner border-radius-10 d-flex">
            <div class="account__left--sidebar">
                <h2 class="account__content--title mb-20">My Profile</h2>
                @include('web.includes.profileList')
            </div>
            <div class="account__wrapper">
                <div class="account__content">
                    <h2 class="account__content--title h3 mb-20">Orders History</h2>
                    <div class="account__table--area">
                        <table class="account__table">
                            <thead class="account__table--header">
                                <tr class="account__table--header__child">
                                    <th class="account__table--header__child--items">Order</th>
                                    <th class="account__table--header__child--items">Date</th>
                                    <th class="account__table--header__child--items">Status</th>
                                    <th class="account__table--header__child--items">Total</th>
                                </tr>
                            </thead>
                            <tbody class="account__table--body mobile__none">
                                @foreach($ordData as $ord)
                                <tr class="account__table--body__child">
                                    <td class="account__table--body__child--items">#{{ $ord->order_number}}</td>
                                    <td class="account__table--body__child--items">{{date_format(date_create($ord->order_date),"d-M-Y")}}</td>
                                    <td class="account__table--body__child--items">{{$ord->order_status}}</td>
                                    <td class="account__table--body__child--items">₹{{number_format($ord->order_tax_amount_total,2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody class="account__table--body mobile__block">
                                @foreach($ordData as $ord)
                                <tr class="account__table--body__child">
                                    <td class="account__table--body__child--items">
                                        <strong>Order</strong>
                                        <span>#{{ $ord->order_number}}</span>
                                    </td>
                                    <td class="account__table--body__child--items">
                                        <strong>Date</strong>
                                        <span>{{date_format(date_create($ord->order_date),"d-M-Y")}}</span>
                                    </td>
                                    <td class="account__table--body__child--items">
                                        <strong>Status</strong>
                                        <span>{{$ord->order_status}}</span>
                                    </td>
                                    <td class="account__table--body__child--items">
                                        <strong>Total</strong>
                                        <span>₹{{number_format($ord->order_tax_amount_total,2)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- my account section end -->
@endsection