<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserAddresses;
use App\Models\Quotation;
use App\Models\Contact;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
    	$data = array();
        $data['page_title'] = 'Dashboard';
        $userData=Auth::guard('admins')->user();
        $data['userData'] = $userData;
        $data['totalOrdersToday']= Quotation::totalOrdersToday();
        $data['totalOrderWeekly']= Quotation::totalOrderWeekly();
        $data['MonthlyOrders']= Quotation::MonthlyOrders();
        $data['yearOrders']= Quotation::yearOrders();
        $data['totalOrders']= Quotation::totalOrders();
        $data['totalSale']= Quotation::totalSale();
        $data['totalSaleToday']= Quotation::totalSaleToday();
        $data['totalSaleWeekly']= Quotation::totalSaleWeekly();
        $data['monthlySale']= Quotation::monthlySale();
        $data['yearSale']= Quotation::yearSale();
        $data['dailySalesOverview']= Quotation::dailySalesOverview();
        $data['weeklySalesOverview']= Quotation::weeklySalesOverview();
        $data['monthlySalesOverview']= Quotation::monthlySalesOverview();
        $data['yearlySalesOverview']= Quotation::yearlySalesOverview();
        $data['sellingPrices'] = Admin::getSelling();

        return view('adminPanel.dashboard',$data);
    }
    public function contact()
    {
        $data = array();
        $data['page_title'] = 'Contacts';
        $data['records'] = Contact::get();
        return view('adminPanel.contactDetails',$data);
    }
    public function adminProfile()
    {
        $data = array();
        $userData=Auth::guard('admins')->user();
        $data['userimg'] = Admin::getAvtar($userData->image);
        $data['userData'] = $userData;
        $data['page_title'] = 'Profile';
        $data['back_url'] = "admin-profile";
        return view('adminPanel.adminProfile',$data);
    }
    public function UpdateAdminAccount(Request $request){
        $status = 1;
        $msg = 'Account has been updated successfully.';
        $data = array();
        $user = Auth::guard('admins')->user();
        $id = $user->id;
        $passcng=0;
        $vslidateArr = [
            'name' => 'required|min:2',
            'email' => 'required|unique:admin_users,email,'.$id,
            'phone' => 'required',
        ];
        if($request->get('current_password') ){
            $vslidateArr = $vslidateArr + [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:4',           
            ];
            $user = Auth::guard('admins')->user();
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
            
            $user = Admin::find($id);
            if($user){
                if($passcng==1){
                    $user->password = bcrypt($request->get('password'));
                }
                $user->name = $request->get('name');
                $user->email = trim($request->get('email'));
                $user->phone = trim($request->get('phone'));
                $user->save();
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function salesOverview($id)
    {
        $data = array();
        $data['page_title'] = 'Sales Overview';
        $userData=Admin::find($id);
        if(!$userData){
            return abort(404); 
        }
        $data['userData'] = $userData;
        $data['totalOrders']= Quotation::totalOrders($id);
        $data['totalOrdersToday']= Quotation::totalOrdersToday($id);
        $data['MonthlyOrders']= Quotation::MonthlyOrders($id);
        $data['totalSale']= Quotation::totalSale($id);
        $data['totalSaleToday']= Quotation::totalSaleToday($id);
        $data['totalSaleWeekly']= Quotation::totalSaleWeekly($id);
        $data['monthlySale']= Quotation::monthlySale($id);
        $data['yearSale']= Quotation::yearSale($id);
        $data['dailySalesOverview']= Quotation::dailySalesOverview($id);
        $data['weeklySalesOverview']= Quotation::weeklySalesOverview($id);
        $data['monthlySalesOverview']= Quotation::monthlySalesOverview($id);
        $data['yearlySalesOverview']= Quotation::yearlySalesOverview($id);
        return view('adminPanel.salesOverview',$data);
    }
}