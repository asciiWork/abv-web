<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest_admin', ['except' => 'getLogout']);
    }
    public function getLogin()
    {
        return view('adminPanel-2.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([           
            'email' => 'required|email',
            'password' => 'required|string',      
        ]);  
    
        $credentials = ['email'=>$request->get('email'), 'password'=>$request->get('password'), 'status'=>1];
    
        if (\Auth::guard("admins")->attempt($credentials)) {
            return redirect()->route('admin-dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function getLogout()
    {
        \Auth::guard("admins")->logout();
        return redirect('/admin')->with('success', 'Logged out successfully');
    }
}
