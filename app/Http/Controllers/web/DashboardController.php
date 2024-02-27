<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserAddresses;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function myAccount()
    {
        $data = array();
        $data['page_title'] = 'My Account';
        $userData=Auth::user();
        $data['userData'] = $userData;
        return view('web.account', $data);
    }
    public function myAddress(Request $request)
    {
        $id = $request->get('id');
        $data = array();
        $data['page_title'] = 'My Address';
        $data['user'] = \Auth::user();
        $formObj= '';
        if($id){
            $raw = UserAddresses::find($id);
            if($raw){
                $formObj = $raw;
            }
        }
        $data['formObj'] = $formObj;
        $data['addData'] = UserAddresses::getAddData(\Auth::user()->id);
        return view('web.address ', $data);
    }
    public function myOrders()
    {
        $data = array();
        $data['page_title'] = 'My Orders';
        $userData=Auth::user();
        $data['userData'] = $userData;
        $data['ordData'] = Order::getOrderData(\Auth::user()->id);
        // $count = OrderDetail::where('user_id',\Auth::user()->id)->count();

        return view('web.orders ', $data);
    }
    public function viewOrder($id)
    {
        $data = array();
        $data['user'] = \Auth::user();
        $data['page_title'] = 'Orders';
        // $obj = Order::where('id',$id)->where('user_id',\Auth::user()->id)->where('is_confirm',1)->first();
        $obj = Order::where('id',$id)->where('user_id',\Auth::user()->id)->first();
        if(!$obj){
            return abort(404); 
        }
        $data['order'] = Order::find($id);
        $data['orderDet'] = OrderDetail::getOrders($id);
        //$data['orderStatus'] = OrderStatus::getData($id);
        return view('web.viewOrder',$data);
    }
    public function editAccount()
    {
        $data = array();
        $data['page_title'] = 'Update Account';
        $user = \Auth::user();
        $data['userData'] = $user;
        return view('web.editAccount ', $data);
    }
    public function downloads()
    {
        $data = array();
        $data['page_title'] = 'downloads';
        return view('web.downloads ', $data);
    }
    public function UpdateAddress(Request $request)
    {
        $status = 1;
        $msg = 'Address has been updated successfully.';
        $data = array();
        $user = \Auth::user();
        $id = $request->get('id');
        $raw = UserAddresses::where('user_id',$user->id)->where('id',$id)->first();
            
        $vslidateArr = [
            'name' => 'required|min:2',
            'street' => 'required',
            'area' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
        ];
        if($raw->is_ship==0){
            $vslidateArr = $vslidateArr + [
            'contact_email' => 'required|email',            
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
            if($raw){
                $raw->user_id = $user->id;
                $raw->name = $request->get('name');
                $raw->company = $request->get('company');
                $raw->street = $request->get('street');
                $raw->area = $request->get('area');
                $raw->city = $request->get('city');
                $raw->state = $request->get('state');
                $raw->zipcode = $request->get('zipcode');
                $raw->phone = $request->get('phone');
                $raw->country = $request->get('country');
                if($raw->is_ship==0){
                    $raw->contact_email = $request->get('contact_email');
                }
                $raw->save();
            }else{
                $status = 0;
                $msg = 'Something went wrong. Please try again later.';
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function UpdateAccount(Request $request)
    {
        $status = 1;
        $msg = 'Account has been updated successfully.';
        $data = array();
        $user = \Auth::user();
        $id = $user->id;
        $passcng=0;
        $vslidateArr = [
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,'.$id,
            'display_name' => 'required',
        ];
        if($request->get('current_password') ){
            $vslidateArr = $vslidateArr + [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:4',           
            ];
            $user = Auth::user();
            if (!Hash::check($request->current_password, $user->password)) {
                return ['status' => 0, 'msg' => 'The current password is incorrect.', 'data' => $data];
            }else{
                $passcng=1;
            }
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
            
            $user = User::find($id);
            if($user){
                if($passcng==1){
                    $user->password = bcrypt($request->get('password'));
                }
                $user->name = $request->get('name');
                $user->email = trim($request->get('email'));
                $user->display_name = $request->get('display_name');
                $user->save();
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
}
