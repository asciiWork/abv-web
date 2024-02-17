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
                            $tmpOrd->quantity = $tmpOrd->quantity + 1;
                            $tmpOrd->save();
                            $tmpOrd->total_amount = $tmpOrd->amount * $tmpOrd->quantity;
                            $tmpOrd->save();
                        }
                    }else{
                        $authUser = \Auth::user();
                        $cart = Cart::where('product_id',$id)->where('user_id',$authUser->id)->first();
                        if($cart){
                            $cart->quantity = $cart->quantity + 1;
                            $cart->save();
                        }else{
                            $cart = new Cart();
                            $cart->user_id = $authUser->id;
                            $cart->product_id = $id;
                            $cart->quantity = 1;
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
                            $tmpOrd->quantity = $tmpOrd->quantity + 1;
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
                                    'qnt' => 1,
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
                                    'qnt' => 1,
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
                    Cart::where('product_id',$id)->where('user_id',$authUser->id)->delete();
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
                    $cart = Cart::where('product_id',$id)->where('user_id',$authUser->id)->first();
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
        return view('web.checkout', $data);
    }
}
