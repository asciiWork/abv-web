<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Carts;
use App\Models\User;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use Validator;
use Razorpay\Api\Api;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
    public function store(Request $request)
    {
        $status=0;
        $msg=$key='';
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $neOrderId = 0;
        $newUserId = '';
        $newOrdKey = 0;
        $is_new_user = 0;
        $new_email = '';
        $new_pass = '';

      if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $order_id = session()->get('orderId');
                $tempOrd = TempOrder::where('id', $order_id)->first();
                if($tempOrd){
                    $newOrder = new Order();
                    $newOrder->order_number = Order::getOrderNo();
                    $newOrder->user_id = $tempOrd->user_id;
                    $newOrder->ship_name = $tempOrd->ship_name;
                    $newOrder->ship_phone = $tempOrd->ship_phone;
                    $newOrder->ship_street = $tempOrd->ship_street;
                    $newOrder->ship_company = $tempOrd->ship_company;
                    $newOrder->ship_area = $tempOrd->ship_area;
                    $newOrder->ship_city = $tempOrd->ship_city;
                    $newOrder->ship_state = $tempOrd->ship_state;
                    $newOrder->ship_zipcode = $tempOrd->ship_zipcode;
                    $newOrder->ship_date = date('Y-m-d H:s:i');
                    $newOrder->bil_name = $tempOrd->bil_name;
                    $newOrder->bil_phone = $tempOrd->bil_phone;
                    $newOrder->bil_street = $tempOrd->bil_street;
                    $newOrder->bil_company = $tempOrd->bil_company;
                    $newOrder->bil_area = $tempOrd->bil_area;
                    $newOrder->bil_city = $tempOrd->bil_city;
                    $newOrder->bil_state = $tempOrd->bil_state;
                    $newOrder->bil_zipcode = $tempOrd->bil_zipcode;
                    $newOrder->ordkey = $tempOrd->ordkey;
                    $newOrder->country = $tempOrd->country;
                    $newOrder->gst_number = $tempOrd->gst_number;
                    $newOrder->note = $tempOrd->note;
                    $newOrder->contact_email = $tempOrd->contact_email;
                    $newOrder->order_status = Carts::$PLACED;
                    $newOrder->order_date = date('Y-m-d H:s:i');
                    $newOrder->created_at = date('Y-m-d H:s:i');
                    $newOrder->updated_at = date('Y-m-d H:s:i');
                    $newOrder->discount = 0;
                    $newOrder->tax = $tempOrd->tax;
                    $newOrder->shipping_flat_charge = $tempOrd->shipping_flat_charge;
                    $newOrder->gst_charge = $tempOrd->gst_charge;
                    $newOrder->cod_charge = $tempOrd->cod_charge;
                    $newOrder->shipping_charge = $tempOrd->shipping_charge;
                    $newOrder->total_amount = $tempOrd->total_amount;
                    $newOrder->order_tax_amount_total = $tempOrd->order_tax_amount_total;
                    $newOrder->payment_method = 'razorpay';
                    $newOrder->payment_status = 'paid';
                    $newOrder->save();
                    $neOrderId = $newOrder->id;
                    $newUserId = $newOrder->user_id;
                    $newOrdKey = $newOrder->ordkey;
                    $is_new_user = $tempOrd->is_new_user;
                    $new_email = $tempOrd->is_new_email;
                    $new_pass = $tempOrd->is_new_pass;

                    $tempOrdDetail =  TempOrderDetail::where('order_id', $order_id)->get();
                    foreach ($tempOrdDetail as $tmD) {
                        $dOrder = new OrderDetail;
                        $dOrder->order_id = $neOrderId;
                        $dOrder->product_id = $tmD->product_id;
                        $dOrder->discount = 0;
                        $dOrder->amount = $tmD->amount;
                        $dOrder->quantity = $tmD->quantity;
                        $dOrder->total_amount = $tmD->total_amount;
                        $dOrder->unit_price = $tmD->unit_price;
                        $dOrder->prosize = $tmD->prosize;
                        $dOrder->created_at = date('Y-m-d H:s:i');
                        $dOrder->updated_at = date('Y-m-d H:s:i');
                        $dOrder->save();
                    }
                    TempOrderDetail::where('order_id', $order_id)->delete();
                    TempOrder::where('id', $order_id)->delete();
                    //mail for order
                    $orderData = array();
                    $orderData['id'] = $neOrderId;
                    $orderData['email'] = $new_email;
                    $orderData['password'] = $new_pass;
                    $orderData['is_new'] = $is_new_user;
                    $orderData['is_customer'] = 1;
                    \Mail::send(new \App\Mail\OrderEmail($orderData));

                    $orderData['is_customer'] = 0;
                    $orderData['email'] = env("APP_EMAIL");
                    \Mail::send(new \App\Mail\OrderEmail($orderData));
                }

                $payData = new Payments();
                $payData->user_id= $newUserId;
                $payData->order_id= $neOrderId;
                $payData->r_payment_id=$response['id'];
                $payData->method=$response['method'];
                $payData->currency=$response['currency'];
                $payData->user_email=$response['email'];
                $payData->amount=$response['amount']/100;
                $payData->json_response=json_encode((array)$response);
                $payData->save();
                $status=1;
                $msg = 'Order has been placed!';
                session()->forget('orderId');
                session()->forget('cart');
            } catch (Exception $e) {
                $msg=$e->getMessage();
            }
        }
        return redirect()->route('order-received',['id'=> $neOrderId,'key'=> $newOrdKey]);
    }
}
