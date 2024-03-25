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
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Category';
        $data['breadcrumb'] = 'Category';
        $data['records'] = Categories::select('*')->get();
        return view('adminPanel.category.index',$data);
    }
    public function create()
    {
    	$data = array();
        $data['formObj'] = new Categories();
        $data['page_title'] = 'Add Category';
        $data['method'] = "POST";
        $data['action_url'] = "admin-category.store";
        $data['action_params'] = 0;
    	return view('adminPanel.category.add', $data);
    }
    public function store(Request $request){
    	$status = 0;
        $msg = "";
    	$validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'files' => 'required|mimes:jpg,png|max:2048',
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }else{
	    	$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'categories';
	    	$image = $request->file('files');
    		$image_name =$image->getClientOriginalName();              
			$extension =$image->getClientOriginalExtension();
			
			$filePath = $image->store('uploads', 'public');
			$image =$image->move($storepath,$filePath);
			$catFrm = new Categories();
   			$catFrm->category_name = $request->get('category_name');
   			$catFrm->cat_img = basename($image);
   			$catFrm->cat_slug = Str::slug($request->get('category_name') , "-");
   			$catFrm->save();
            $status = 1;
            $msg = "Category added successfully.";

            unlink(storage_path('app\public').DIRECTORY_SEPARATOR.$filePath);

		}
		if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return ['status' => $status, 'msg' => $msg];
            //return redirect(route("admin-category.index"));
        }
    }
    public function show($id)
    {
        $data = array();
        $data['page_title'] = 'Category';
        $data['breadcrumb'] = 'Category';
        $obj = Categories::find($id);
        if(!$obj){
            return abort(404); 
        }
        $data['catData'] = Categories::where('id',$id)->first();
        return view('adminPanel.category.view',$data);
    }
    public function edit($cat)
    {
    	$formObj = Categories::select('*')->where('id',$cat)->first();
    	$data = array();
        $data['formObj'] =$formObj;
        $data['page_title'] = 'Add Category';
        $data['breadcrumb'] = 'Category';
        $data['method'] = "PUT";
        $data['action_url'] = "admin-category.update";
        $data['action_params'] = $formObj->id;
    	return view('adminPanel.category.add', $data);
    }
    public function update(Request $request, $id)
    {
    	$model = Categories::find($id);
    	$status = 0;
        $msg = "";
    	$validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);
        if(!$model)
        {
            $status = 0;
            $msg = "Record not found !";
        }
        else if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }else{
        	if($request->hasFile('files')){
		    	$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'categories';
            	$oldimg=$storepath.DIRECTORY_SEPARATOR.$model->cat_img;
		    	$image = $request->file('files');
	    		$image_name =$image->getClientOriginalName();              
				$extension =$image->getClientOriginalExtension();
				$filePath = $image->store('uploads', 'public');
				$image =$image->move($storepath,$filePath);
				
   				$model->cat_img = basename($image);
			}
   			$model->category_name = $request->get('category_name');
   			$model->cat_slug = Str::slug($request->get('category_name') , "-");
   			$model->save();
            $status = 1;
            $msg = "Category added successfully.";
            unlink(storage_path('app\public').DIRECTORY_SEPARATOR.$filePath);
            unlink($oldimg);

		}
		if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return ['status' => $status, 'msg' => $msg];
        }
    }
    public function destroy($id, Request $request)
    {
    	$status = 0;
        $msg = "";
    	if($request->get('ids')){
    		foreach ($request->get('ids') as $cId) {
    			$cat = Categories::find($cId);
    			if($cat){    				
    				$proObj=Product::where('category_id',$cId)->first();
    				//delete product images and size
    				$proimg=ProductImages::where('product_id',$proObj->id)->get();
    				if($proimg){
    					foreach ($proimg as $row) {
	    					$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.'main-product';
		            		$oldimg=$storepath.DIRECTORY_SEPARATOR.$row->product_img_url	;
		            		unlink($oldimg);
    					}
    				}
					ProductImages::where('product_id', $proObj->id)->delete();
					ProductSize::where('product_id', $proObj->id)->delete();
    				
    				//Delete product
    				if($proObj){
    					Product::where('category_id', $cId)->delete();
    				}
    				//Delete Category and image
    				$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'categories';
            		$oldimg=$storepath.DIRECTORY_SEPARATOR.$cat->cat_img;
					unlink($oldimg);
    				$cat->delete();
    			}
    		}
    		$status = 1;
    		$msg="Category has been deleted successfully!";
    	}
    	return ['status' => $status, 'msg' => $msg];
    }
    public function data(Request $request){
    	$cData = Categories::select('*');
        return DataTables::eloquent($cData)
        ->addColumn('chkbox', function(Categories $row) {               
            return '<input type="checkbox" name="catid" value="'.$row->id.'" class="form-checkbox mt-1" />';
        })
        ->addColumn('action', function(Categories $row) {               
            return '<div class="flex gap-4 items-center"><a href="'.route('admin-category.show',['admin_category'=>$row->id]).'" class="hover:text-primary">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
            </svg>
            </a>
            <a href="'.route('admin-category.edit',['admin_category'=>$row->id]).'" class="hover:text-primary">
	            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5">
	            <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
	            <path d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z" stroke="currentColor" stroke-width="1.5"></path>
	            <path opacity="0.5" d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9" stroke="currentColor" stroke-width="1.5"></path>
	        	</svg>
            </a></div>';
        })
        ->rawColumns(['chkbox','action'])
        ->make(true);
    }
}