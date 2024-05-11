@component('mail::message')

@if($is_customer)
# Hi {{ ($user)?$user->name:'' }}
<p> Just to let you know — we've received your order #{{$order->order_number}}, and it is now being </p>
@if($is_new)
<p><b>Email:</b> {{ $email }} <span> <b>Password:</b> {{ $password }}</span> </p>
@endif
@else
# You’ve received the following order from {{ ($user)?$user->name:'' }}
@endif

<br /><br />
@if($order->payment_status == 'paid')
<p> Paid Order </p>
@else
<p> Pay with cash upon delivery. </p>
@endif
@component('mail::button', ['url' => '/'])
Order #{{$order->order_number}} ( {{date('M d, Y', strtotime($order->order_date))}})
@endcomponent
<br />
<table style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    background-color: #ffffff;
    border-color: #e8e5ef;
    border-radius: 2px;
    border-width: 1px;
    margin: 0 auto;
    padding: 0;
    width: 570px;">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $item)
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;"> {{ $item->product_name }} - ({{ $item->product_code }})
                ({!! htmlentities($item->prosize) !!})
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;"> {{ $item->quantity }}</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($item->amount,2) }} </td>
        </tr>
        @endforeach
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;">
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;">Subtotal</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($order->total_amount,2) }} </td>
        </tr>
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;">
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;">Shipping</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($order->shipping_flat_charge,2) }} </td>
        </tr>
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;">
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;">GST</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($order->gst_charge,2) }} </td>
        </tr>
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;">
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;">COD</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($order->cod_charge,2) }} </td>
        </tr>
        <tr style="display: table-row;
    vertical-align: inherit;
    unicode-bidi: isolate;
    border-color: inherit;">
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;">
            </td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: center;
    border-top: 1px solid #a6acb4;">Total</td>
            <td style="box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0; text-align: right;
    border-top: 1px solid #a6acb4;"> ₹{{ number_format($order->order_tax_amount_total,2) }} </td>
        </tr>
    </tbody>
</table>
<br />

<p><strong>Note:</strong> {{$order->note}}</p>

<h3 style="color: red;">Billing address</h3>
<p>{{$order->bil_name}}<br>{{$order->bil_company}}
    <br>{{$order->bil_street}}, {{$order->bil_area}} {{$order->bil_city}}<br>{{$order->bil_state}}, {{$order->bil_zipcode}}<br>{{$order->country}}<br>{{$order->contact_email}}
    <br>{{$order->bil_phone}}<br>GST No. :{{$order->gst_number}}
</p>

<h3 style="color: red;">Shipping address</h3>
<p>@if($order->ship_name!=''){{$order->ship_name}}@else{{$order->bil_name}}@endif<br>
    @if($order->ship_company!=''){{$order->ship_company}}@else{{$order->bil_company}}@endif<br>
    @if($order->ship_street!=''){{$order->ship_street}}@else{{$order->bil_street}}@endif ,
    @if($order->ship_area!=''){{$order->ship_area}}@else{{$order->bil_area}}@endif ,
    @if($order->ship_city!=''){{$order->ship_city}}@else{{$order->bil_city}}@endif<br>
    @if($order->ship_state!=''){{$order->ship_state}}@else{{$order->bil_state}}@endif ,
    @if($order->ship_zipcode!=''){{$order->ship_zipcode}}@else{{$order->bil_zipcode}}@endif<br>
    {{$order->country}}<br>{{$order->contact_email}}
    <br>{{$order->ship_phone}}
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent