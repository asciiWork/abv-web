<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductImages;
use App\Models\Contact;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use App\Models\ProductSize;
use App\Models\Carts;
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
                    $temp_order_id = session()->get('temp_order_id');
                    $obj = TempOrder::where('id',$temp_order_id)->where('user_id',\Auth::user()->id)->first();
                    if($obj && $temp_order_id > 0){
                        $tmpOrd = TempOrderDetail::where('temp_order_id',$temp_order_id)->where('product_id',$id)
                        ->first();
                        if($tmpOrd){
                            $tmpOrd->quantity = $tmpOrd->quantity + $qnt;
                            $tmpOrd->save();
                            $tmpOrd->total_amount = $tmpOrd->amount * $tmpOrd->quantity;
                            $tmpOrd->save();
                        }
                    }else{
                        $authUser = \Auth::user();
                        $cart = Carts::where('product_id',$id)->where('user_id',$authUser->id)->first();
                        if($cart){
                            $cart->quantity = $cart->quantity + $qnt;
                            $cart->save();
                        }else{
                            $cart = new Carts();
                            $cart->user_id = $authUser->id;
                            $cart->product_id = $id;
                            $cart->quantity = $qnt;
                            $cart->save();
                        }
                    }

                    $status = 1;
                    $msg = 'Product has been added!';
                }else{
                    $temp_order_id = session()->get('temp_order_id');
                    $obj = TempOrder::where('id',$temp_order_id)->first();
                    if($obj && $temp_order_id > 0){
                        $tmpOrd = TempOrderDetail::where('temp_order_id',$temp_order_id)->where('product_id',$id)
                        ->first();
                        if($tmpOrd){
                            $tmpOrd->quantity = $tmpOrd->quantity + $qnt;
                            $tmpOrd->save();
                            $tmpOrd->total_amount = $tmpOrd->amount * $tmpOrd->quantity;
                            $tmpOrd->save();
                        }
                    }else{
                        $proImg = ProductImages::where('product_id',$id)->where('pro_main','1')->first();
                        $proSize = ProductSize::where('product_id',$id)->where('product_size',$prosize)->first();
                        $cart = session()->get('cart');
                        if(!$cart) {
                            $cart = [
                                $id => [
                                    'product_img' => $proImg->product_img_url,
                                    'product_name' => $prd->product_name,
                                    'prosize' => $prosize,
                                    'price' => $proSize->product_current_price,
                                    'slug' => $prd->product_slug,
                                    'qnt' => $qnt,
                                    'id' => $id,
                                ]
                            ];
                            session()->put('cart', $cart);
                        }
                        else if(isset($cart[$id])){
                            $cart[$id]['qnt']++;
                            session()->put('cart', $cart);
                        }
                        else{
                            $proImg = ProductImages::where('product_id',$id)->where('pro_main','1')->first();
                            $proSize = ProductSize::where('product_id',$id)->where('product_size',$prosize)->first();
                            $sesCart = session()->get('cart');
                            $sesCart = $sesCart + [
                                $id => [
                                    'product_img' => $proImg->product_img_url,
                                    'product_name' => $prd->product_name,
                                    'prosize' => $prosize,
                                    'price' => $proSize->product_current_price,
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
        $prd = Product::find($id);
        if($prd){
            if(\Auth::check())
            {
                $authUser = \Auth::user();
                $temp_order_id = session()->get('temp_order_id');
                $obj = TempOrder::where('id',$temp_order_id)->where('user_id',$authUser->id)->first();
                if($obj && $temp_order_id > 0){
                    TempOrderDetail::where('temp_order_id',$temp_order_id)->delete();
                    TempOrder::where('id',$temp_order_id)->where('user_id',$authUser->id)->delete();
                }else{
                    Carts::where('product_id',$id)->where('user_id',$authUser->id)->delete();
                }
                $status = 1;
                $msg = 'Product has been removed!';
            }else{
                $cart = session()->get('cart');
                if(isset($cart[$id])){
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
                $status = 1;
                $msg = 'Product has been removed!';
            }
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
        $prd = Product::find($id);
        if($prd){
            if(\Auth::check())
            {
                $authUser = \Auth::user();
                $temp_order_id = session()->get('temp_order_id');
                $obj = TempOrder::where('id',$temp_order_id)->where('user_id',$authUser->id)->first();
                if($obj && $temp_order_id > 0){
                    $tmobj = TempOrderDetail::where('temp_order_id',$temp_order_id)->where('product_id',$id)->first();
                    if($tmobj){
                        if($type == 'plus'){
                            $tmobj->quantity = $tmobj->quantity + 1;
                            $tmobj->save();
                        }else{
                            if($tmobj->quantity > 1){
                                $tmobj->quantity = $tmobj->quantity - 1;
                                $tmobj->save();
                            }else{
                                $tmobj->delete();
                            }
                        }
                    }
                }else{
                    $cart = Carts::where('product_id',$id)->where('user_id',$authUser->id)->first();
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
                if(isset($cart[$id])){
                    if($type == 'plus'){
                        $cart[$id]['qnt']++;
                    }else{
                        if($cart[$id]['qnt'] > 1){
                            $cart[$id]['qnt']--;
                        }else{
                            unset($cart[$id]);
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
        $data['products'] = Carts::getCartData();
        if(!empty($data['products'])){
            return view('web.checkout', $data);
        }else{
            return redirect('/cart');
        }
    }
    public function shoppingPost(Request $request)
    {
        $status = 0;
        $msg = 'Please try again later.';
        $data = array();
        $userId = null;

        $vslidateArr = [
            'bil_name' => 'required|min:2',
            'country' => 'required|not_in:-1',
            'bil_state' => 'required',
            'bil_city' => 'required',
            'bil_street' => 'required',
            'bil_area' => 'required',
            'bil_zipcode' => 'required',
            'bil_phone' => 'required',
            'contact_email' => 'required|email'
        ];
        if($request->get('create_acc')=='on'){
            $vslidateArr = $vslidateArr + ['contact_email' => 'required|email|unique:users,email'];
        }
        if($request->get('ship_me')=='on'){
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
        }
        if(\Auth::check()){
            $authUser = \Auth::user();
            $userId = $authUser->id; 
            $vslidateArr = $vslidateArr + [
                'contact_email' => 'required|email|unique:users,email,'.$userId,
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
            $is_new = 0;
            $products = Carts::getCartData();
            if(is_array($products) && !empty($products))
            {
                $temp_order_id = session()->get('temp_order_id');
                $obj = TempOrder::find($temp_order_id);
                if($temp_order_id > 0 && $obj){
                    if(\Auth::check()){
                        $obj = TempOrder::where('id',$temp_order_id)->where('user_id',\Auth::user()->id)->first();
                    }else{
                       if($request->get('create_acc')=='on'){
                            $user = new User();
                            $user->name = bcrypt($request->get("ship_name"));
                            $user->email = bcrypt($request->get("contact_email"));
                            $user->password = bcrypt($request->get("ship_name"));
                            $user->save();
                            //mail to user for password
                        } 
                    }
                }else{
                    if($request->get('create_acc')=='on'){
                        $user = new User();
                        $user->name = bcrypt($request->get("ship_name"));
                        $user->email = bcrypt($request->get("contact_email"));
                        $user->password = bcrypt($request->get("ship_name"));
                        $user->save();
                        //mail to user for password
                    }
                    $is_new = 1;
                    $obj = new TempOrder();
                }
                if($obj){
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
                    $obj->order_status = Carts::$PENDING;
                    $obj->order_date = date('Y-m-d H:s:i');
                    $obj->created_at = date('Y-m-d H:s:i');
                    $obj->updated_at = date('Y-m-d H:s:i');
                    $obj->save();

                    $tempOrderId = $obj->id;
                    $total_price = 0;

                    foreach($products as $p)
                    {
                        $qnt = $p['qnt'];
                        $slug = $p['slug'];
                        $product_id = $p['id'];
                        $amount = $p['price'];
                        $prdcutObj = Product::where('product_slug',$slug)->first();

                        if($prdcutObj && $qnt > 0){
                            $tObj = TempOrderDetail::where('product_id',$p['id'])->where('temp_order_id',$tempOrderId)->first();
                            if(!$tObj){
                                $tObj = new TempOrderDetail;
                            }
                            $tObj->temp_order_id = $tempOrderId;
                            $tObj->product_id = $product_id;
                            $tObj->discount = 0;
                            $tObj->amount = $amount;
                            $tObj->quantity = $qnt;
                            $tObj->total_amount = $qnt * $amount;
                            $tObj->created_at = date('Y-m-d H:s:i');
                            $tObj->updated_at = date('Y-m-d H:s:i');
                            $tObj->save();

                            $total_price = $total_price + $tObj->total_amount; 
                        }
                    }
                    $orderTexes = 0;//Product::$orderTexes;
                    $obj->discount = 0;
                    $obj->tax = $orderTexes;
                    $obj->shipping_charge = 100;
                    $obj->total_amount = $total_price+100;
                    $obj->order_tax_amount_total = $orderTexes + $total_price;
                    $obj->save();

                    if($total_price > 0){
                        session()->put('temp_order_id',$tempOrderId);
                    }
                    if(\Auth::check()){
                        Carts::where('user_id',$authUser->id)->delete();
                    }
                    $status = 1;
                    $msg = 'Order has been placed!';
                    session()->forget('cart');
                }
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];        
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
