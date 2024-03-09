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
    /*public function show($id)
    {
        $data = array();
        $data['page_title'] = 'User';
        $obj = User::find($id);
        if(!$obj){
            return abort(404); 
        }
        $data['address'] = UserAddresses::getAddress($id);
        return view('adminPanel.users.address',$data);
    }*/
}