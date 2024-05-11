<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductImages;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use App\Models\ProductSize;
use App\Models\Carts;
use App\Models\User;
use App\Models\UserAddresses;
use Validator;

class ProductsController extends Controller
{
    public function addToCart(Request $request)
    {
        $status = 0;
        $msg = 'Please try again later!';
        $data = array();
        $id = $request->get('id');
        $prosize = $request->get('prosize');
        $qnt = $request->get('qnt');
        $prd = Product::find($id);
        if($prosize && $prd){
            $proImg = ProductImages::where('product_id', $id)->where('pro_main', '1')->first();
            $prdSize = ProductSize::where('product_id', $id)->where('product_size', $prosize)->first();
            $cartSlug = $id . $prosize;
            $user_id = (\Auth::check())? \Auth::user()->id:'';
            if(\Auth::check()){
                $existsCart = Carts::where('user_id', $user_id)->where('product_id', $id)->where('prosize', $prosize)->first();
                if($existsCart){
                    $existsCart->quantity = $existsCart->quantity + 1;
                    $existsCart->save();
                }else{
                    $tempCart = new Carts();
                    $tempCart->price = $prdSize->product_current_price;
                    $tempCart->prosize = $prosize;
                    $tempCart->quantity = $qnt;
                    $tempCart->user_id = $user_id;
                    $tempCart->product_id = $id;
                    $tempCart->save();
                }
                $status = 1;
                $msg = 'Product has been added!';
            }else{
                $cart = session()->get('cart');
                if (!$cart) {
                    $cart = [
                        $cartSlug => [
                            'product_img' => $proImg->product_img_url,
                            'product_name' => $prd->product_name,
                            'prosize' => $prosize,
                            'price' => $prdSize->product_current_price,
                            'slug' => $prd->product_slug,
                            'qnt' => $qnt,
                            'product_id' => $id,
                            'id' => $id,
                            'user_id' => $user_id,
                        ]
                    ];
                    session()->put('cart', $cart);
                } else if (isset($cart[$cartSlug])) {
                    $cart[$cartSlug]['qnt']++;
                    session()->put('cart', $cart);
                }else{
                    $sesCart = session()->get('cart');
                    $sesCart = $sesCart + [
                        $cartSlug => [
                            'product_img' => $proImg->product_img_url,
                            'product_name' => $prd->product_name,
                            'prosize' => $prosize,
                            'price' => $prdSize->product_current_price,
                            'slug' => $prd->product_slug,
                            'qnt' => $qnt,
                            'product_id' => $id,
                            'id' => $id,
                            'user_id' => $user_id,
                        ]
                    ];
                    session()->put('cart', $sesCart);
                }
                $status = 1;
                $msg = 'Product has been added!';
            }
        }else{
            $status = 0;
            $msg = 'Please select size';
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function removeCart(Request $request)
    {
        $status = 0;
        $msg = 'Please try again later!';
        $data = array();
        $product_id = $request->get('id');
        $prosize = $request->get('size');
        if(\Auth::check())
        {
            $user_id = \Auth::user()->id;
            Carts::where('user_id', $user_id)->where('product_id', $product_id)->where('prosize', $prosize)->delete();
            $status = 1;
            $msg = 'Product has been removed!';
        }else{
            $cart = session()->get('cart');
            $uniq = $product_id. $prosize;
            if(isset($cart[$uniq])){
                unset($cart[$uniq]);
                session()->put('cart', $cart);
            }
            $status = 1;
            $msg = 'Product has been removed!';
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function incDecCart(Request $request)
    {
        $status = 0;
        $msg = 'Please try again later!';
        $data = array();
        $type = $request->get('ctype');
        $product_id = $request->get('id');
        $prosize = $request->get('size');
        $prd = Product::find($product_id);
        if($prd){
            if(\Auth::check())
            {
                $user_id = \Auth::user()->id;
                $cart = Carts::where('product_id', $product_id)->where('prosize', $prosize)->where('user_id', $user_id)->first();
                if($cart){
                    if($type == 'plus'){
                        $cart->quantity = $cart->quantity + 1;
                        $cart->save();
                    }else{
                        if($cart->quantity > 1){
                            $cart->quantity = $cart->quantity - 1;
                            $cart->save();
                        }else{
                            $cart->delete();
                        }
                    }
                }
                $status = 1;
                $msg = 'Product has been updated!';
            }else{
                $cart = session()->get('cart');
                $unq = $product_id. $prosize;
                if(isset($cart[$unq])){
                    if($type == 'plus'){
                        $cart[$unq]['qnt']++;
                    }else{
                        if($cart[$unq]['qnt'] > 1){
                            $cart[$unq]['qnt']--;
                        }else{
                            unset($cart[$unq]);
                        }
                    }
                    session()->put('cart', $cart);
                }
                $status = 1;
                $msg = 'Product has been updated!';
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function checkout()
    {
        $data = array();
        $data['page_title'] = 'Checkout';
        $data['breadcrumb'] = 'Checkout';
        $data['products'] = Carts::getCartData();
        if(\Auth::check()){
            $authUser = \Auth::user();
            $uAddress=UserAddresses::getAddData($authUser->id);
            $data['uAddress'] = $uAddress;
        }
        if(!empty($data['products'])){
            return view('web.checkout', $data);
        }else{
            return redirect('/cart');
        }
    }
    public function shoppingPostOld(Request $request)
    {
        $status = 0;
        $redirect = url('/checkout');
        $msg = 'Please try again later.';
        $data = array();
        $userId = null;
        $email=$request->get('user_email');
        if(\Auth::check()){
            $authUser = \Auth::user();
            $userId=$authUser->id;
        }else{
            $confUser = User::where('email',$email)->first();
            if($confUser){
                return ['status' => 0, 'msg' => "Email alredy exists, please login first.", 'data' => $data];
            }
        }

        $vslidateArr = [
            'bil_name' => 'required|min:2',
            'country' => 'required|not_in:-1',
            'bil_state' => 'required',
            'bil_city' => 'required',
            'bil_street' => 'required',
            'bil_zipcode' => 'required',
            'bil_phone' => 'required',
            'contact_email' => 'required|email',
            'user_email' => 'required|email'
        ];
        $selState = $request->get('bil_state');
        if($request->get('ship_me')){
            $vslidateArr = $vslidateArr + [
                'ship_name' => 'required|min:2',
                'ship_country'=>'required',
                'ship_state' => 'required',
                'ship_city' => 'required',
                'ship_street' => 'required',
                'ship_area' => 'required',
                'ship_zipcode' => 'required',
                'ship_phone' => 'required',
            ];
            $selState = $request->get('ship_state');
        }
        if(!\Auth::check()){
            $vslidateArr = $vslidateArr + [
                'user_email' => 'required|email|unique:users,email,'
            ];
        }else{
            $userId = \Auth::user()->id;
        }

        $validator = Validator::make($request->all(),$vslidateArr);

        // check validations
        if ($validator->fails()) 
        {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) 
            {
                $msg .= $message . "<br />";
            }
        }
        else
        {
            $is_new = 0;
            $is_new_pass = date('Ymdhis').rand(8,2);
            $products = Carts::getCartData();
            if(is_array($products) && !empty($products))
            {
                $order_id = session()->get('order_id');
                $obj = Order::find($order_id);
                if($request->get("ship_name")!=''){
                    $name=$request->get("ship_name");
                }else{
                    $name=$request->get("bil_name");
                }
                $nusr = User::where('email',$email)->first();
                if(empty($nusr)){
                    $is_new = 1;
                    $user = new User();
                    $user->name = $name;
                    $user->email = $email;
                    $user->password = bcrypt($is_new_pass);
                    $user->save();
                    $userId = $user->id;
                    //mail to user for password
                }
                if($order_id > 0 && $obj){
                    if(\Auth::check()){
                        $obj = Order::where('id',$order_id)->where('user_id',\Auth::user()->id)->first();
                    }else{
                    }
                }else{
                    $nusr = User::where('email',$email)->first();
                    if(empty($nusr)){
                        $user = new User();
                        $user->name = $name;
                        $user->email = $email;
                        $user->password = bcrypt($is_new_pass);
                        $user->save();
                        $userId = $user->id;
                        //mail to user for password
                        $is_new = 1;
                    }
                    $obj = new Order();
                }
                if($obj){
                    $obj->order_number = Order::getOrderNo();
                    $obj->user_id = $userId;
                    $obj->ship_name = $request->get('ship_name');
                    $obj->ship_phone = $request->get('ship_phone');
                    $obj->ship_street = $request->get('ship_street');
                    $obj->ship_company = $request->get('ship_company');
                    $obj->ship_area = $request->get('ship_area');
                    $obj->ship_city = $request->get('ship_city');
                    $obj->ship_state = $request->get('ship_state');
                    $obj->ship_zipcode = $request->get('ship_zipcode');
                    $obj->ship_date = date('Y-m-d H:s:i');//date('Y-m-d H:s:i',strtotime('+6 days'));

                    $obj->bil_name = $request->get('bil_name');
                    $obj->bil_phone = $request->get('bil_phone');
                    $obj->bil_street = $request->get('bil_street');
                    $obj->bil_company = $request->get('bil_company');
                    $obj->bil_area = $request->get('bil_area');
                    $obj->bil_city = $request->get('bil_city');
                    $obj->bil_state = $request->get('bil_state');
                    $obj->bil_zipcode = $request->get('bil_zipcode');

                    $obj->country = $request->get('country');
                    $obj->gst_number = $request->get('gst_number');
                    $obj->note = $request->get('note');
                    $obj->contact_email = $request->get('contact_email');
                    $obj->order_status = Carts::$PLACED;
                    $obj->order_date = date('Y-m-d H:s:i');
                    $obj->created_at = date('Y-m-d H:s:i');
                    $obj->updated_at = date('Y-m-d H:s:i');
                    $obj->payment_method = $request->get('payment_method');
                    $obj->save();
                    $orderId = $obj->id;
                    $obj->ordkey = $orderId.'_rp_order_'.md5(date('Y-m-d H:s:i'));
                    $obj->save();
                    
                    $total_price = 0;
                    $total_qnt = 0;

                    foreach($products as $p)
                    {
                        $qnt = $p['qnt'];
                        $total_qnt += $p['qnt'];
                        $slug = $p['slug'];
                        $product_id = $p['product_id'];
                        $amount = $p['price'];
                        $prosize = $p['prosize'];
                        $prdcutObj = Product::where('product_slug',$slug)->first();

                        if($prdcutObj && $qnt > 0){
                            $tObj = OrderDetail::where('product_id',$p['product_id'])->where('order_id',$orderId)->where('prosize',$prosize)->first();
                            if(!$tObj){
                                $tObj = new OrderDetail;
                            }
                            $tObj->order_id = $orderId;
                            $tObj->product_id = $product_id;
                            $tObj->discount = 0;
                            $tObj->amount = $amount;
                            $tObj->quantity = $qnt;
                            $tObj->total_amount = $qnt * $amount;
                            $tObj->unit_price = $amount;
                            $tObj->prosize = $prosize;
                            $tObj->created_at = date('Y-m-d H:s:i');
                            $tObj->updated_at = date('Y-m-d H:s:i');
                            $tObj->save();

                            $total_price = $total_price + $tObj->total_amount;
                        }
                    }

                    $shipping_flat_charge = 0;
                    if ($selState != 'Gujarat') {
                        $shipping_flat_charge = ($total_qnt < 50)? 130:260;
                    } else {
                        $shipping_flat_charge = ($total_qnt < 50)? 100:200;
                    }
                    if ($request->get('payment_method') == 'razorpay') {
                        $cod_charge = 0;
                    }else{
                        $cod_charge = ($total_price + $shipping_flat_charge) * 0.02;
                    }
                    $gst_charge = ($total_price + $shipping_flat_charge + $cod_charge) * 0.18;
                    $order_tax_amount_total = $gst_charge + $total_price + $shipping_flat_charge + $cod_charge;
                    $orderTexes = 0;//Product::$orderTexes;
                    $obj->discount = 0;
                    $obj->tax = $gst_charge;
                    $obj->shipping_flat_charge = $shipping_flat_charge;
                    $obj->gst_charge = $gst_charge;
                    $obj->cod_charge = $cod_charge;
                    $obj->shipping_charge = $shipping_flat_charge;
                    $obj->total_amount = $total_price;
                    $obj->order_tax_amount_total = $order_tax_amount_total;
                    $obj->save();

                    if($total_price > 0){
                        //session()->put('order_id',$orderId);
                    }
                    if(\Auth::check()){
                        $authUser = \Auth::user();
                        Carts::where('user_id',$authUser->id)->delete();
                        $userId=$authUser->id;
                    }
                        UserAddresses::addOrderAddress($orderId,$userId);
                    $status = 1;
                    $msg = 'Order has been placed!';
                    session()->forget('cart');
                    //mail for order
                    $orderData = array();
                    $orderData['id'] = $obj->id;
                    $orderData['email'] = $email;
                    $orderData['password'] = $is_new_pass;
                    $orderData['is_new'] = $is_new;
                    $orderData['is_customer'] = 1;
                   \Mail::send(new \App\Mail\OrderEmail($orderData));

                    $orderData['is_customer'] = 0;
                    $orderData['email'] = env("APP_EMAIL");
                   \Mail::send(new \App\Mail\OrderEmail($orderData));
                    if($request->get('payment_method')=='razorpay'){
                        $redirect='order-pay/'.$orderId.'/'. $obj->ordkey;
                        $redirect = url($redirect);
                        session()->put('orderId',$orderId);
                    }
                }
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data, 'redirect' => $redirect];
    }
    public function shoppingPost(Request $request)
    {
        $status = 0;
        $redirect = url('/checkout');
        $msg = 'Please try again later.';
        $data = array();
        $userId = (\Auth::check())? \Auth::user()->id:'';
        $email = $request->get('user_email');
        if (!$userId) {
            $confUser = User::where('email', $email)->first();
            if ($confUser) {
                return ['status' => 0, 'msg' => "Email alredy exists, please login first.", 'data' => $data];
            }
        }
        $vslidateArr = [
            'bil_name' => 'required|min:2',
            'country' => 'required|not_in:-1',
            'bil_state' => 'required',
            'bil_city' => 'required',
            'bil_street' => 'required',
            'bil_zipcode' => 'required',
            'bil_phone' => 'required',
            'contact_email' => 'required|email',
            'user_email' => 'required|email',
            'payment_method' => 'required'
        ];
        $selState = $request->get('bil_state');
        if ($request->get('ship_me')) {
            $vslidateArr = $vslidateArr + [
                'ship_name' => 'required|min:2',
                'ship_country' => 'required',
                'ship_state' => 'required',
                'ship_city' => 'required',
                'ship_street' => 'required',
                'ship_area' => 'required',
                'ship_zipcode' => 'required',
                'ship_phone' => 'required',
            ];
            $selState = $request->get('ship_state');
        }
        if (!$userId) {
            $vslidateArr = $vslidateArr + [
                'user_email' => 'required|email|unique:users,email,'
            ];
        }
        $validator = Validator::make($request->all(), $vslidateArr);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        } else {
            $is_new = 0;
            $is_new_pass = date('Ymdhis') . rand(8, 2);
            $products = Carts::getCartData();
            $payment_method = $request->get('payment_method');
            $username = (!empty($request->get("ship_name"))) ? $request->get("ship_name") : $request->get("bil_name");
            if (!$userId) {
                $is_new = 1;
                $user = new User();
                $user->name = $username;
                $user->email = $email;
                $user->password = bcrypt($is_new_pass);
                $user->save();
                $userId = $user->id;
            }
            if($payment_method == 'razorpay'){
                $orderUniqueKey = 'rp_order_' . md5(date('Y-m-d H:s:i'));
                $temp = new TempOrder();
                $temp->order_number = $orderUniqueKey;
                $temp->user_id = $userId;
                $temp->ship_name = $request->get('ship_name');
                $temp->ship_phone = $request->get('ship_phone');
                $temp->ship_street = $request->get('ship_street');
                $temp->ship_company = $request->get('ship_company');
                $temp->ship_area = $request->get('ship_area');
                $temp->ship_city = $request->get('ship_city');
                $temp->ship_state = $request->get('ship_state');
                $temp->ship_zipcode = $request->get('ship_zipcode');
                $temp->ship_date = date('Y-m-d H:s:i');
                $temp->bil_name = $request->get('bil_name');
                $temp->bil_phone = $request->get('bil_phone');
                $temp->bil_street = $request->get('bil_street');
                $temp->bil_company = $request->get('bil_company');
                $temp->bil_area = $request->get('bil_area');
                $temp->bil_city = $request->get('bil_city');
                $temp->bil_state = $request->get('bil_state');
                $temp->bil_zipcode = $request->get('bil_zipcode');
                $temp->country = $request->get('country');
                $temp->gst_number = $request->get('gst_number');
                $temp->note = $request->get('note');
                $temp->is_new_user = $is_new;
                $temp->is_new_pass = $is_new_pass;
                $temp->is_new_email = $email;
                $temp->contact_email = $request->get('contact_email');
                $temp->order_status = Carts::$PLACED;
                $temp->order_date = date('Y-m-d H:s:i');
                $temp->created_at = date('Y-m-d H:s:i');
                $temp->updated_at = date('Y-m-d H:s:i');
                $temp->payment_method = 'razorpay';
                $temp->save();
                $orderId = $temp->id;
                $temp->ordkey = $orderId .'_'. $orderUniqueKey;
                $temp->save();

                $total_price = 0;
                $total_qnt = 0;
                $shipping_flat_charge = 0;
                $cod_charge = 0;
                foreach ($products as $p) {
                    $qnt = $p['qnt'];
                    $slug = $p['slug'];
                    $product_id = $p['product_id'];
                    $amount = $p['price'];
                    $prosize = $p['prosize'];
                    $total_qnt += $p['qnt'];
                    $prdcutObj = Product::where('product_slug', $slug)->first();
                    if ($prdcutObj && $qnt > 0) {
                        $tObj = new TempOrderDetail();
                        $tObj->order_id = $orderId;
                        $tObj->product_id = $product_id;
                        $tObj->discount = 0;
                        $tObj->amount = $amount;
                        $tObj->quantity = $qnt;
                        $tObj->total_amount = $qnt * $amount;
                        $tObj->unit_price = $amount;
                        $tObj->prosize = $prosize;
                        $tObj->created_at = date('Y-m-d H:s:i');
                        $tObj->updated_at = date('Y-m-d H:s:i');
                        $tObj->save();
                        $total_price = $total_price + $tObj->total_amount;
                    }
                }
                if ($selState != 'Gujarat') {
                    $shipping_flat_charge = ($total_qnt < 50) ? 130 : 260;
                } else {
                    $shipping_flat_charge = ($total_qnt < 50) ? 100 : 200;
                }
                $gst_charge = ($total_price + $shipping_flat_charge + $cod_charge) * 0.18;
                $order_tax_amount_total = $gst_charge + $total_price + $shipping_flat_charge + $cod_charge;
                $temp->discount = 0;
                $temp->tax = $gst_charge;
                $temp->shipping_flat_charge = $shipping_flat_charge;
                $temp->gst_charge = $gst_charge;
                $temp->cod_charge = $cod_charge;
                $temp->shipping_charge = $shipping_flat_charge;
                $temp->total_amount = $total_price;
                $temp->order_tax_amount_total = $order_tax_amount_total;
                $temp->save();

                $redirect = 'order-pay/' . $orderId . '/' . $temp->ordkey;
                $redirect = url($redirect);
                session()->put('orderId', $orderId);
                return ['status' => 1, 'msg' => 'Pay Order', 'data' => $data, 'redirect' => $redirect];
            }else{
                $newOrder = new Order();
                $newOrder->order_number = Order::getOrderNo();
                $newOrder->user_id = $userId;
                $newOrder->ship_name = $request->get('ship_name');
                $newOrder->ship_phone = $request->get('ship_phone');
                $newOrder->ship_street = $request->get('ship_street');
                $newOrder->ship_company = $request->get('ship_company');
                $newOrder->ship_area = $request->get('ship_area');
                $newOrder->ship_city = $request->get('ship_city');
                $newOrder->ship_state = $request->get('ship_state');
                $newOrder->ship_zipcode = $request->get('ship_zipcode');
                $newOrder->ship_date = date('Y-m-d H:s:i');
                $newOrder->bil_name = $request->get('bil_name');
                $newOrder->bil_phone = $request->get('bil_phone');
                $newOrder->bil_street = $request->get('bil_street');
                $newOrder->bil_company = $request->get('bil_company');
                $newOrder->bil_area = $request->get('bil_area');
                $newOrder->bil_city = $request->get('bil_city');
                $newOrder->bil_state = $request->get('bil_state');
                $newOrder->bil_zipcode = $request->get('bil_zipcode');
                $newOrder->country = $request->get('country');
                $newOrder->gst_number = $request->get('gst_number');
                $newOrder->note = $request->get('note');
                $newOrder->contact_email = $request->get('contact_email');
                $newOrder->order_status = Carts::$PLACED;
                $newOrder->order_date = date('Y-m-d H:s:i');
                $newOrder->created_at = date('Y-m-d H:s:i');
                $newOrder->updated_at = date('Y-m-d H:s:i');
                $newOrder->payment_method = 'cod';
                $newOrder->save();
                $orderId = $newOrder->id;
                $newOrder->ordkey = $orderId . '_rp_order_' . md5(date('Y-m-d H:s:i'));
                $newOrder->save();

                $total_price = 0;
                $total_qnt = 0;
                $shipping_flat_charge = 0;
                foreach ($products as $p) {
                    $qnt = $p['qnt'];
                    $slug = $p['slug'];
                    $product_id = $p['product_id'];
                    $amount = $p['price'];
                    $prosize = $p['prosize'];
                    $total_qnt += $p['qnt'];
                    $prdcutObj = Product::where('product_slug', $slug)->first();
                    if ($prdcutObj && $qnt > 0) {
                        $dOrder = new OrderDetail;
                        $dOrder->order_id = $orderId;
                        $dOrder->product_id = $product_id;
                        $dOrder->discount = 0;
                        $dOrder->amount = $amount;
                        $dOrder->quantity = $qnt;
                        $dOrder->total_amount = $qnt * $amount;
                        $dOrder->unit_price = $amount;
                        $dOrder->prosize = $prosize;
                        $dOrder->created_at = date('Y-m-d H:s:i');
                        $dOrder->updated_at = date('Y-m-d H:s:i');
                        $dOrder->save();
                        $total_price = $total_price + $dOrder->total_amount;
                    }
                }
                if ($selState != 'Gujarat') {
                    $shipping_flat_charge = ($total_qnt < 50) ? 130 : 260;
                } else {
                    $shipping_flat_charge = ($total_qnt < 50) ? 100 : 200;
                }
                $cod_charge = ($total_price + $shipping_flat_charge) * 0.02;
                $gst_charge = ($total_price + $shipping_flat_charge + $cod_charge) * 0.18;
                $order_tax_amount_total = $gst_charge + $total_price + $shipping_flat_charge + $cod_charge;
                $newOrder->discount = 0;
                $newOrder->tax = $gst_charge;
                $newOrder->shipping_flat_charge = $shipping_flat_charge;
                $newOrder->gst_charge = $gst_charge;
                $newOrder->cod_charge = $cod_charge;
                $newOrder->shipping_charge = $shipping_flat_charge;
                $newOrder->total_amount = $total_price;
                $newOrder->order_tax_amount_total = $order_tax_amount_total;
                $newOrder->save();

                if (\Auth::check()) {
                    Carts::where('user_id', \Auth::user()->id)->delete();
                }
                UserAddresses::addOrderAddress($orderId, $userId);
                $status = 1;
                $msg = 'Order has been placed!';
                session()->forget('cart');
                //mail for order
                $orderData = array();
                $orderData['id'] = $orderId;
                $orderData['email'] = $email;
                $orderData['password'] = $is_new_pass;
                $orderData['is_new'] = $is_new;
                $orderData['is_customer'] = 1;
                \Mail::send(new \App\Mail\OrderEmail($orderData));

                $orderData['is_customer'] = 0;
                $orderData['email'] = env("APP_EMAIL");
                \Mail::send(new \App\Mail\OrderEmail($orderData));
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data, 'redirect' => $redirect];
    }
    public function openQuickView(Request $request)
    {
        $html = 'Empty Cart';
        $product_id=$request->get('id');
        $proData = new Product;
        $proData = $proData->productWithSize($product_id);
        $proreview = new ProductReview;
        $avgRate =  $proreview->getAvgRating($product_id);
        $catquery = new Categories;
        $productCategory = $catquery->get_category($proData->category_id);
        $proimgs = new ProductImages; 
        $proimges =  $proimgs->get_ProductImages($product_id);
        $html = view('web.quickViewHtml',['proData' => $proData,'avgRate'=>$avgRate,'productCategory'=>$productCategory,'proimges'=>$proimges])->render();
        return $html;
    }
}
