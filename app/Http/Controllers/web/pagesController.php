<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductImages;

class pagesController extends Controller
{
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Home';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        $latestProduct =  $proData->get_latest_product(5);
        $data['letProductData']=$latestProduct;
        $dealProduct =  $proData->get_latest_product(4);
        $data['dealProduct']=$dealProduct;
        return view('web.index', $data);
    }
    public function about()
    {
        $data = array();
        $data['page_title'] = 'About';
        return view('web.about', $data);
    }
    public function products()
    {
        $data = array();
        $data['page_title'] = 'Products';
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        return view('web.products', $data);
    }
    public function contact()
    {
        $data = array();
        $data['page_title'] = 'Contact';
        return view('web.contact', $data);
    }
    public function privacyPolicy()
    {
        $data = array();
        $data['page_title'] = 'Privacy Policy';
        return view('web.privacyPolicy', $data);
    }
    public function termsAndConditions()
    {
        $data = array();
        $data['page_title'] = 'Terms And Conditions';
        return view('web.termsAndConditions', $data);
    }
    public function refundAndCancellationPolicy()
    {
        $data = array();
        $data['page_title'] = 'Refund And Cancellation Policy';
        return view('web.refundAndCancellationPolicy', $data);
    }
    public function deliveryAndShippingPolicy()
    {
        $data = array();
        $data['page_title'] = 'Delivery And Shipping Policy';
        return view('web.deliveryAndShippingPolicy', $data);
    }
    public function categories()
    {
        $data = array();
        $data['page_title'] = 'Categories';
        return view('web.categories', $data);
    }
    public function productDetails($slug)
    {
        $data = array();
        $data['page_title'] = 'Product Details';
        $proData = new Product; 
        $product =  $proData->get_ProductDetail($slug);
        $data['proData']=$product;
        $proreview = new ProductImages; 
        $proimges =  $proreview->get_ProductImages($product->id);
        $data['proimges']=$proimges;
        $proreview = new ProductReview; 
        $prore =  $proreview->get_ProductReview($product->id);
        $data['proReview']=$prore;
        return view('web.productDetails', $data);
    }
    public function productCategory()
    {
        $data = array();
        $data['page_title'] = 'Product Category';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        return view('web.productCategory', $data);
    }
    public function cart()
    {
        $data = array();
        $data['page_title'] = 'Cart';
        return view('web.cart', $data);
    }
    public function checkout()
    {
        $data = array();
        $data['page_title'] = 'Checkout';
        return view('web.checkout', $data);
    }
    public function gallery()
    {
        $data = array();
        $data['page_title'] = 'Gallery';
        return view('web.gallery', $data);
    }
    public function myAccount()
    {
        $data = array();
        $data['page_title'] = 'My Account';
        return view('web.account', $data);
    }
    public function myAddress()
    {
        $data = array();
        $data['page_title'] = 'My Address';
        return view('web.address ', $data);
    }
}
