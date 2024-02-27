<?php $rName = \Request::route()->getName();?>
<ul class="account__menu">
    <li class="{{ ($rName == 'web.my-account')?'active':'' }} account__menu--list">
    	<a href="{{ route('web.my-account') }}">Dashboard</a>
    </li>
    <li class="{{ ($rName == 'web.my-orders')?'active':'' }} account__menu--list">
    	<a href="{{ route('web.my-orders') }}">Orders</a>
    </li>
    <li class="{{ ($rName == 'web.downloads')?'active':'' }} account__menu--list">
    	<a href="{{ route('web.downloads') }}">Downloads</a>
    </li>
    <li class="{{ ($rName == 'web.my-address')?'active':'' }} account__menu--list">
    	<a href="{{ route('web.my-address') }}">Addresses</a>
    </li>
    <li class="{{ ($rName == 'web.edit-account')?'active':'' }} account__menu--list">
    	<a href="{{ route('web.edit-account') }}">Account details</a>
    </li>
    <li class="account__menu--list"><a href="{{ route('logout') }}">Log Out</a></li>
</ul>