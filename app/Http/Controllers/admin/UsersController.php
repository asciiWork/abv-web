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

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $data['page_title'] = 'Users';
        $data['breadcrumb'] = 'Users';
        $data['records'] = User::select('*')->get();
        return view('adminPanel.users.index',$data);
    }
    public function data(Request $request){
        $user = User::query();
        return Datatables::eloquent($user)->make(true);
    }
}