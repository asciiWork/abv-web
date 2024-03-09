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
use App\Models\ProductReview;
use App\Models\ProductImages;
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
}