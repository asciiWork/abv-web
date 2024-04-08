<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Http\UploadedFile;
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
use DataTables;
use Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->moduleRouteText = "admin-category";
        $this->moduleViewName = "adminPanel.category";
        $this->list_url = route($this->moduleRouteText . ".index");

        $module = "Category";
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
        $data['page_title'] = 'Manage Category';
        $data['breadcrumb'] = array('Admin Category' => '');
        $data['records'] = Categories::select('*')->get();
        return view('adminPanel.category.index',$data);
    }
    public function create()
    {
    	
    }
    public function store(Request $request){
    	
    }
    public function show($id)
    {
        $obj = Categories::find($id);
        if(!$obj){
            return abort(404); 
        }
        $status=0;
        $msg= $html = '';
        if($id){
            $catData = Categories::where('id',$id)->first();
            if($catData){
                $status=1;
                $url = url('/public/web/assets/img/categories/'.$catData->cat_img);
                $html = "<img src='{$url}'>";
                $catName=$catData->category_name;
            }
        }else{
            $msg='Record not found!';
        }
        return ['status' => $status, 'msg' => $msg, 'html' =>$html, 'catName' => $catName];
    }
    public function edit($cat)
    {
    	
    }
    public function update(Request $request, $id)
    {
    	
    }
    public function destroy($id, Request $request)
    {
    	
    }
    public function data(Request $request){
    	$cData = Categories::select('*');
        return DataTables::eloquent($cData)
        ->addColumn('action', function(Categories $row) {               
            return '<a href="javascript:void(0);" data-action="'.route('admin-category.show',['admin_category'=>$row->id]).'" data-id="'.$row->id.'" class="hover:text-primary viewCat">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
            </svg>
            </a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}