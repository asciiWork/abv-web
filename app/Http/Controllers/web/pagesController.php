<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Home';
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
}
