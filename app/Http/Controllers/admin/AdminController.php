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
use App\Models\Quotation;
use App\Models\Contact;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
    	$data = array();
        $data['page_title'] = 'Dashboard';
        $userData=Auth::user();
        $data['userData'] = $userData;
        $data['ordData'] = [];//Order::getOrderData(\Auth::user()->id);
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
    public function salesOverview()
    {
        $data = array();
        $data['page_title'] = 'Sales Overview';
        return view('adminPanel.salesOverview',$data);
    }
}