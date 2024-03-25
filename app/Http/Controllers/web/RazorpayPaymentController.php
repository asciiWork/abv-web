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
use Validator;
use Razorpay\Api\Api;
use Session;
use Exception;

class RazorpayPaymentController extends Controller
{
    public function store(Request $request)
    {
        $status=0;
        $msg='';
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $order_id = session()->get('orderId');
                $payData = new Payments();
                if($order_id){
                    //Update Order Status
                    $ord=Order::where('id',$order_id)->first();
                    $key=$ord->ordkey;
                    $ord->order_status=Carts::$CONFIRM;
                    $ord->save();

                    $payData->user_id=$ord->user_id;
                    $payData->order_id=$order_id;
                }
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
            } catch (Exception $e) {
                $msg=$e->getMessage();                
            }
        }
        return redirect()->route('order-received',['id'=>$order_id,'key'=>$key]);
    }
}
