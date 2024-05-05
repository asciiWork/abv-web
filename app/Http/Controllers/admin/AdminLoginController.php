<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserDevice;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest_admin', ['except' => 'getLogout']);
    }
    public function getLogin()
    {
        return view('adminPanel.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([           
            'email' => 'required|email',
            'password' => 'required|string',      
        ]);  
    
        $credentials = ['email'=>$request->get('email'), 'password'=>$request->get('password'), 'status'=>1];
    
        if (\Auth::guard("admins")->attempt($credentials)) {

            $user_agent = $request->userAgent();
            $ip = Admin::GetUserIp();
            UserDevice::updateOrCreate(
                ['user_id' => \Auth::guard("admins")->user()->id, 'user_agent' => $user_agent],
                ['user_agent' => $user_agent, 'ip_address'=> $ip, 'last_logged_at'=>date('Y-m-d H:i:s')]
            );

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
