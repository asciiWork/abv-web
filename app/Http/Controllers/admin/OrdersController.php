<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserAddresses;

class OrdersController extends Controller
{
    public function index()
    {
    	$data = array();
        $data['page_title'] = 'Orders';
        $data['breadcrumb'] = 'Orders';
        $data['records'] = Order::select('orders.*','users.name')->join('users','users.id','orders.user_id')->get();
        return view('adminPanel.orders.index',$data);
    }
    public function show($id)
    {
        $data = array();
        $data['page_title'] = 'Orders';
        $data['breadcrumb'] = 'Orders';
        $obj = Order::find($id);
        if(!$obj){
            return abort(404); 
        }
        $data['order'] = Order::find($id);
        $data['user'] = User::find($obj->user_id);
        $data['orderDetails'] = OrderDetail::getOrders($id);
        return view('adminPanel.orders.view',$data);
    }
}