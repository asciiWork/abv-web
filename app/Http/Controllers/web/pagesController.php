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
}
