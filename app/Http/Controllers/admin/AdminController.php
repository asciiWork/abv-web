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
        $data['totalOrdersToday']= Quotation::totalOrdersToday();
        $data['MonthlyOrders']= Quotation::MonthlyOrders();
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