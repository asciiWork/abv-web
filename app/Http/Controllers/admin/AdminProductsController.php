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
    public function index(){
        $data = array();
        $data['page_title'] = 'Products';
        $data['breadcrumb'] = 'Products';
        $data['records'] = Product::select('*')->get();
        return view('adminPanel.products.index',$data);
    }
    public function create(){
    	$data = array();
        $data['formObj'] = new Product();
        $data['page_title'] = 'Add Product';
        $data['breadcrumb'] = 'Products';
        $data['method'] = "POST";
        $data['action_url'] = "admin-products.store";
        $data['action_params'] = 0;
        $data['size_in_mm'] = ['1'=>'Yes','0'=>'No'];
        $data["category"] = \App\Models\Categories::pluck('category_name','id')->all();
    	return view('adminPanel.products.add', $data);
    }
    public function store(Request $request){
    	$status = 0;
        $msg = "";
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:product_category,id', 
            'product_name' => 'required', 
            'product_min_price' => 'required|numeric', 
            'product_max_price' => 'required|numeric', 
            'product_dimension' => 'required', 
            'files.*' => 'required|mimes:jpg,png|max:2048', 
            'size_in_mm' => ['required', Rule::in(['0','1'])],
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }else{
        	//Product
			$proFrm = new Product();
   			$proFrm->category_id = $request->get('category_id');
   			$proFrm->product_name = $request->get('product_name');
   			$proFrm->product_min_price = $request->get('product_min_price');
   			$proFrm->product_max_price = $request->get('product_max_price');
   			$proFrm->product_slug = Str::slug($request->get('product_name') , "-");
   			$proFrm->product_detail = $request->get('product_detail');
   			$proFrm->product_dimension = $request->get('product_dimension');
   			$proFrm->size_in_mm = $request->get('size_in_mm');
   			$proFrm->save();
   			$product_id = $proFrm->id;

   			//Product Images
	    	$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.'main-product';
		    $files = $request->file('files');
		    if(!empty($files)){
        		$i=1;
		    	foreach ($files as $image) {
		    		$pro_main='0';
		    		if($i==1){
		    			$pro_main='1';
		    		}
		   			$image_name =$image->getClientOriginalName();              
					$extension =$image->getClientOriginalExtension();				
					$filePath = $image->store('uploads', 'public');
					$image =$image->move($storepath,$filePath);
				    unlink(storage_path('app\public').DIRECTORY_SEPARATOR.$filePath);
				    $proImg = new ProductImages();
				   	$proImg->product_id = $product_id;
				   	$proImg->product_img_url = basename($image);
				   	$proImg->pro_main=$pro_main;
				   	$proImg->save();
	   				$i++;
		    	}
		    }
		    //Product size
		    $product_code = $request->get('product_code');
		    $product_size = $request->get('product_size');
		    $product_old_price = $request->get('product_old_price');
		    $product_current_price = $request->get('product_current_price');
		    $code=$request->get('product_code');
		    foreach ($code as $key => $cval) {
		    	$psize= new ProductSize();
		    	$psize->product_id = $product_id;
		    	$psize->product_code = $cval;
		    	$psize->product_size = $product_size[$key];
		    	$psize->product_old_price = $product_old_price[$key];
		    	$psize->product_current_price = $product_current_price[$key];
		    	$psize->save();
		    }
            $status = 1;
            $msg = "Product added successfully.";
		}
        return ['status' => $status, 'msg' => $msg];
    }
    public function show($id){
    	$data = array();
        $data['page_title'] = 'Product';
        $data['breadcrumb'] = 'Product';
        $obj = Product::find($id);
        if(!$obj){
            return abort(404); 
        }
        $data['prObj'] = Product::find($id);
        $data['catData'] = Categories::where('id',$id)->first();
        $data['prImg'] = ProductImages::where('product_id',$id)->get();
        $data['prReview'] = ProductReview::where('product_id',$id)->get();
        $data['prSize'] = ProductSize::where('product_id',$id)->get();
        return view('adminPanel.products.view',$data);
    }
    public function edit($pro)
    {
    	$data = array();
        $formObj = Product::select('*')->where('id',$pro)->first();
        $data['formObj'] = $formObj;
        $data['page_title'] = 'Edit Product';
        $data['breadcrumb'] = 'Products';
        $data['method'] = "PUT";
        $data['action_url'] = "admin-products.update";
        $data['action_params'] = $formObj->id;
        $data['size_in_mm'] = ['1'=>'Yes','0'=>'No'];
        $data["category"] = \App\Models\Categories::pluck('category_name','id')->all();
        $data["proImg"] = \App\Models\ProductImages::where('product_id',$pro)->get();
        $data["proSize"] = \App\Models\ProductSize::where('product_id',$pro)->get();

    	return view('adminPanel.products.add', $data);
    }
    public function update(Request $request, $id){
    	$status = 0;
        $msg = "";
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:product_category,id', 
            'product_name' => 'required', 
            'product_min_price' => 'required|numeric', 
            'product_max_price' => 'required|numeric', 
            'product_dimension' => 'required',
            'size_in_mm' => ['required', Rule::in(['0','1'])],
        ]);
        // check validations
        $proFrm = Product::find($id);
        if(!$proFrm)
        {
            $status = 0;
            $msg = "Record not found !";
        }
        else if ($validator->fails()) 
		{
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }else{
    		//Product
   			$proFrm->category_id = $request->get('category_id');
   			$proFrm->product_name = $request->get('product_name');
   			$proFrm->product_min_price = $request->get('product_min_price');
   			$proFrm->product_max_price = $request->get('product_max_price');
   			$proFrm->product_slug = Str::slug($request->get('product_name') , "-");
   			$proFrm->product_detail = $request->get('product_detail');
   			$proFrm->product_dimension = $request->get('product_dimension');
   			$proFrm->size_in_mm = $request->get('size_in_mm');
   			$proFrm->save();
   			$product_id = $id;

   			//Product Images
	    	$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.'main-product';
		    $files = $request->file('files');
		    if(!empty($files)){
        		$i=1;
        		$proimgfnd=ProductImages::where('product_id',$product_id)->where('pro_main','1')->first();
		    	foreach ($files as $image) {
		    		$pro_main='0';
		    		if(!$proimgfnd){
			    		if($i==1){
			    			$pro_main='1';
			    		}
			    	}
		   			$image_name =$image->getClientOriginalName();              
					$extension =$image->getClientOriginalExtension();				
					$filePath = $image->store('uploads', 'public');
					$image =$image->move($storepath,$filePath);
				    unlink(storage_path('app\public').DIRECTORY_SEPARATOR.$filePath);
				    $proImg = new ProductImages();
				   	$proImg->product_id = $product_id;
				   	$proImg->product_img_url = basename($image);
				   	$proImg->pro_main=$pro_main;
				   	$proImg->save();
	   				$i++;
		    	}
		    }
		    //Product size
		    $image_id = $request->get('image_id');
		    $product_code = $request->get('product_code');
		    $product_size = $request->get('product_size');
		    $product_old_price = $request->get('product_old_price');
		    $product_current_price = $request->get('product_current_price');
		    $code=$request->get('product_code');
		    foreach ($code as $key => $cval) {
		    	$psize= new ProductSize();
		    	if($image_id[$key]){
		    		$psize=ProductSize::where('id',$image_id[$key])->first();
		    	}
		    	$psize->product_id = $product_id;
		    	$psize->product_code = $cval;
		    	$psize->product_size = $product_size[$key];
		    	$psize->product_old_price = $product_old_price[$key];
		    	$psize->product_current_price = $product_current_price[$key];
		    	$psize->save();
		    }
            $status = 1;
            $msg = "Product updated successfully.";
        }
        return ['status' => $status, 'msg' => $msg];
    }
    public function destroy($id, Request $request){
    	$status = 0;
    	$msg = '';
    	if($request->get('imgId')){
    		$img_id=$request->get('imgId');
    		$pimg = ProductImages::find($img_id);
    		if($pimg){
    			$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.'main-product';
    			$oldimg=$storepath.DIRECTORY_SEPARATOR.$pimg->product_img_url;
				unlink($oldimg);
				$pimg->delete();
				$status = 1;
    		}
    	}
    	if($request->get('ids')){
    		foreach ($request->get('ids') as $pId) {
    			$proObj = Product::find($pId);
    			if($proObj){
    				//delete product images and size and product
    				$proimg=ProductImages::where('product_id',$pId)->get();
    				if($proimg){
    					foreach ($proimg as $row) {
	    					$storepath=public_path().DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.'main-product';
		            		$oldimg=$storepath.DIRECTORY_SEPARATOR.$row->product_img_url	;
		            		unlink($oldimg);
    					}
    				}
					ProductImages::where('product_id', $proObj->id)->delete();
					ProductSize::where('product_id', $proObj->id)->delete();
					$proObj->delete();
    			}
    			$status = 1;
    			$msg="Products has been deleted successfully!";
    		}
    	}
    	return ['status' => $status, 'msg' => $msg];
    }
    public function contactQuickView(Request $request){
    	$status=0;
    	$msg='Record not found!';
    	$html = '';
        $id=$request->get('id');
        if($id){
	        $conData = Contact::where('id',$id)->first();
	        if($conData){
	        	$status=1;
	        	$html = view('adminPanel.quickViewHtmlContact',['conData' => $conData])->render();
	        }
	    }
	    return ['status' => $status, 'msg' => $msg, 'html' =>$html];
    }
    public function data(Request $request){
    	$cData = Product::select('*');
        return DataTables::eloquent($cData)
        ->addColumn('chkbox', function(Product $row) {               
            return '<input type="checkbox" name="catid" value="'.$row->id.'" class="form-checkbox mt-1" />';
        })
        ->addColumn('action', function(Product $row) {               
            return '<div class="flex gap-4 items-center"><a href="'.route('admin-products.show',['admin_product'=>$row->id]).'" class="hover:text-primary">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
            </svg>
            </a>
            <a href="'.route('admin-products.edit',['admin_product'=>$row->id]).'" class="hover:text-primary">
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