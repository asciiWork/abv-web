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
use DataTables;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-orders";
        $this->moduleViewName = "adminPanel.orders";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Orders";
        $this->module = $module;

        $this->modelObj = new Order();
        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }
    public function index()
    {
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/
    	$data = array();
        $data['page_title'] = 'Manage Orders';
        $data['breadcrumb'] = array('Admin Orders' => '');
        $data['add_url'] = route($this->moduleRouteText . '.create');
        $data['records'] = Order::select('orders.*','users.name')->join('users','users.id','orders.user_id')->get();
        return view($this->moduleViewName . ".index", $data);
    }
    public function show($id)
    {
        $data = array();
        $data['page_title'] = 'Orders';
        $data['breadcrumb'] = array('Admin Orders' => '');
        $obj = Order::find($id);
        if(!$obj){
            return abort(404); 
        }
        $data['order'] = Order::find($id);
        $data['user'] = User::find($obj->user_id);
        $data['orderDetails'] = OrderDetail::getOrders($id);
        return view('adminPanel.orders.view',$data);
    }
    public function data(Request $request){
        $odata = Order::select('orders.*','users.name')->join('users','users.id','orders.user_id');
        return DataTables::eloquent($odata)
        ->editColumn('order_number', function($row) {                
            return '#'.$row['order_number'];
        })
        ->editColumn('order_tax_amount_total', function($row) {                
            return '₹'.$row['order_tax_amount_total'];
        })
        ->editColumn('order_date', function($row) {                
            return date('Y-m-d',strtotime($row['order_date']));
        })
        ->editColumn('ship_date', function($row) {                
            return date('Y-m-d',strtotime($row['ship_date']));
        })
        ->editColumn('order_status', function($row) {
            if($row->order_status == 'placed'){              
                return '<span class="badge badge-outline-success">Placed</span>';
            }else{
                return '<span class="badge badge-outline-danger">Pending</span>';
            }
        })
        ->addColumn('action', function(Order $row) {               
            return '<a href="'.route('admin-orders.show',['admin_order'=>$row->id]).'" class="hover:text-primary">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
            </svg>
            </a>';
        })
        ->rawColumns(['action','order_number','order_tax_amount_total','order_date','ship_date','order_status'])
        ->make(true);
    }
}