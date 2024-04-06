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
        if($prosize){
            if($prd){
                if(\Auth::check())
                {
                    $order_id = session()->get('order_id');
                    $obj = Order::where('id',$order_id)->where('user_id',\Auth::user()->id)->first();
                    if($obj && $order_id > 0){
                        $tmpOrd = OrderDetail::where('order_id',$order_id)->where('product_id',$id)->where('prosize',$prosize)
                        ->first();
                        if($tmpOrd){
                            $tmpOrd->quantity = $tmpOrd->quantity + $qnt;
                            $tmpOrd->save();
                            $tmpOrd->total_amount = $tmpOrd->amount * $tmpOrd->quantity;
                            $tmpOrd->save();
                        }
                    }else{
                        $authUser = \Auth::user();
                        $cart = Carts::where('product_id',$id)->where('user_id',$authUser->id)->where('prosize',$prosize)->first();
                        if($cart){
                            $cart->quantity = $cart->quantity + $qnt;
                            $cart->save();
                        }else{
                            $proSize = ProductSize::where('product_id',$id)->where('product_size',$prosize)->first();
                            $cart = new Carts();
                            $cart->user_id = $authUser->id;
                            $cart->product_id = $id;
                            $cart->quantity = $qnt;
                            $cart->prosize = $proSize->product_size;
                            $cart->price = $proSize->product_current_price;
                            $cart->created_at = \Carbon\Carbon::now();
                            $cart->updated_at = \Carbon\Carbon::now();
                            $cart->save();
                        }
                    }

                    $status = 1;
                    $msg = 'Product has been added!';
                }else{
                    $order_id = session()->get('order_id');
                    $obj = Order::where('id',$order_id)->first();
                    if($obj && $order_id > 0){
                        $tmpOrd = OrderDetail::where('order_id',$order_id)->where('product_id',$id)->where('prosize',$prosize)
                        ->first();
                        if($tmpOrd){
                            $tmpOrd->quantity = $tmpOrd->quantity + $qnt;
                            $tmpOrd->save();
                            $tmpOrd->total_amount = $tmpOrd->amount * $tmpOrd->quantity;
                            $tmpOrd->save();
                        }
                    }else{
                        $proImg = ProductImages::where('product_id',$id)->where('pro_main','1')->first();
                        $prdSize = ProductSize::where('product_id',$id)->where('product_size',$prosize)->first();
                        $cart = session()->get('cart');
                        $cartSlug = $id. $prosize;
                        if(!$cart) {
                            $cart = [
                                $cartSlug => [
                                    'product_img' => $proImg->product_img_url,
                                    'product_name' => $prd->product_name,
                                    'prosize' => $prosize,
                                    'price' => $prdSize->product_current_price,
                                    'slug' => $prd->product_slug,
                                    'qnt' => $qnt,
                                    'id' => $id,
                                ]
                            ];
                            session()->put('cart', $cart);
                        }
                        else if(isset($cart[$cartSlug])){
                            $cart[$cartSlug]['qnt']++;
                            session()->put('cart', $cart);
                        }
                        else{
                            $proImg = ProductImages::where('product_id',$id)->where('pro_main','1')->first();
                            $prdSize = ProductSize::where('product_id',$id)->where('product_size',$prosize)->first();
                            $sesCart = session()->get('cart');
                            $sesCart = $sesCart + [
                                $cartSlug => [
                                    'product_img' => $proImg->product_img_url,
                                    'product_name' => $prd->product_name,
                                    'prosize' => $prosize,
                                    'price' => $prdSize->product_current_price,
                                    'slug' => $prd->product_slug,
                                    'qnt' => $qnt,
                                    'id' => $id,
                                ]
                            ];
                            session()->put('cart', $sesCart);
                        }
                    }
                    $status = 1;
                    $msg = 'Product has been added!';
                }
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
        $id = $request->get('id');
        $psize = $request->get('size');
        // $prd = Product::find($id);
        if(\Auth::check())
        {
            $authUser = \Auth::user();
            $order_id = session()->get('order_id');
            $obj = Order::where('id',$order_id)->where('user_id',$authUser->id)->first();
            if($obj && $order_id > 0){
                OrderDetail::where('order_id',$order_id)->delete();
                Order::where('id',$order_id)->where('user_id',$authUser->id)->delete();
            }else{
                Carts::where('id',$id)->where('user_id',$authUser->id)->delete();
            }
            $status = 1;
            $msg = 'Product has been removed!';
        }else{
            $cart = session()->get('cart');
            $uniq = $id.$psize;
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
        $id = $request->get('id');
        $type = $request->get('ctype');
        $psize = $request->get('size');
        $prd = Product::find($id);
        if($prd){
            if(\Auth::check())
            {
                $authUser = \Auth::user();
                $order_id = session()->get('order_id');
                $obj = Order::where('id',$order_id)->where('user_id',$authUser->id)->first();
                if($obj && $order_id > 0){
                    $tmobj = OrderDetail::where('order_id',$order_id)->where('id',$id)->first();
                    if($tmobj){
                        if($type == 'plus'){
                            $qnt=$tmobj->quantity + 1;
                            $tmobj->quantity = $tmobj->quantity + 1;
                            $tmobj->total_amount = $qnt *$tmobj->amount;
                            $tmobj->save();

                            $totOrdamt = OrderDetail::where('order_id', $order_id)->sum('total_amount');
                            $obj->order_tax_amount_total =$totOrdamt;
                            $obj->total_amount=$totOrdamt+$obj->shipping_charge;
                            $obj->save();
                        }else{
                            if($tmobj->quantity > 1){
                                $qnt=$tmobj->quantity - 1;
                                $tmobj->quantity = $tmobj->quantity - 1;
                                $tmobj->total_amount = $qnt *$tmobj->amount;
                                $tmobj->save();

                                $totOrdamt = OrderDetail::where('order_id', $order_id)->sum('total_amount');
                                $obj->order_tax_amount_total =$totOrdamt;
                                $obj->total_amount=$totOrdamt+$obj->shipping_charge;
                                $obj->save();
                            }else{
                                $tmobj->delete();
                            }
                        }
                    }
                }else{
                    $cart = Carts::where('id',$id)->where('user_id',$authUser->id)->first();
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
                }

                $status = 1;
                $msg = 'Product has been updated!';
            }else{
                $cart = session()->get('cart');
                $unq = $id.$psize;
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
    public function shoppingPost(Request $request)
    {
        $status = 0;
        $redirect = '';
        $msg = 'Please try again later.';
        $data = array();
        $userId = null;
        $email=$request->get('contact_email');
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
            'contact_email' => 'required|email'
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
        if(!\Auth::user()){
            $vslidateArr = $vslidateArr + [
                'contact_email' => 'required|email|unique:users,email,'
            ];
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
            $email = $request->get('news_email');
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
                if($order_id > 0 && $obj){
                    if(\Auth::check()){
                        $obj = Order::where('id',$order_id)->where('user_id',\Auth::user()->id)->first();
                    }else{
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
                    }
                    $is_new = 1;
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
                    $cod_charge = ($total_price + $shipping_flat_charge) * 0.02;
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
                    }
                }
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
