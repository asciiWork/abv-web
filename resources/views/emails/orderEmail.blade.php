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

<p> Pay with cash upon delivery. </p>

@component('mail::button', ['url' => '/'])
Order #{{$order->order_number}} ( {{date('M d, Y', strtotime($order->order_date))}})
@endcomponent
<br />
@component('mail::table')
| Product | Quantity | Price |
|:-------------:|:-----------:|:-----------:|
@foreach($orderItems as $item)
| {{ $item->product_name }} ({{ $item->prosize }}) | {{ $item->quantity }} | ₹{{ number_format($item->amount,2) }} |
@endforeach
|||-----------|
| |Subtotal| ₹{{ number_format($order->total_amount,2) }} |
| |Shipping| ₹{{ number_format($order->shipping_flat_charge,2) }} |
| |GST| ₹{{ number_format($order->gst_charge,2) }} |
| |COD| ₹{{ number_format($order->cod_charge,2) }} |
| |Total| ₹{{ number_format($order->order_tax_amount_total,2) }} |
@endcomponent

<p><strong>Payment method:</strong> Cash on delivery</p>
<p><strong>Note:</strong> {{$order->note}}</p>

<h3 style="color: red;">Billing address</h3>
<p>{{$order->bil_name}}<br>{{$order->bil_company}}
    <br>{{$order->bil_area}}, {{$order->bil_city}}<br>{{$order->bill_state}}, {{$order->bil_zipcode}}<br>{{$order->country}}<br>{{$order->contact_email}}
    <br>{{$order->bil_phone}}
</p>

<h3 style="color: red;">Shipping address</h3>
<p>{{$order->ship_name}}<br>{{$order->ship_company}}
    <br>{{$order->ship_area}}, {{$order->ship_city}}<br>{{$order->ship_state}}, {{$order->ship_zipcode}}<br>{{$order->country}}<br>{{$order->contact_email}}
    <br>{{$order->ship_phone}}
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent