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
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductReview;
use App\Models\ProductImages;
use App\Models\Contact;
use DataTables;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProductsController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-products";
        $this->moduleViewName = "adminPanel.products";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Product";
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
    public function index(){
        /*------------ACL-----------------*/
        if (!\App\Models\ACL::isAccess()) {
            return abort(404);
        }
        /*--------------------------------*/
        $data = array();
        $data['page_title'] = 'Manage Product';
        $data['breadcrumb'] = array('Admin Product' => '');
        $data['records'] = Product::select('*')->get();
        return view('adminPanel.products.index',$data);
    }
    public function create(){
    	
    }
    public function store(Request $request){
    }
    public function show($id){
    	
    }
    public function edit($pro)
    {
    }
    public function update(Request $request, $id){
    }
    public function destroy($id, Request $request){
    }
    public function contactQuickView(Request $request){
    }
    public function data(Request $request){
    	$cData = Product::select('*');
        return DataTables::eloquent($cData)
        ->addColumn('price', function(Product $row) {               
            return '₹'.$row->product_min_price.' - ₹'.$row->product_max_price;
        })
        ->rawColumns(['price'])
        ->make(true);
    }
}