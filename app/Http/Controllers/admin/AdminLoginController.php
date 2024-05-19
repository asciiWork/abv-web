<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserDevice;
use Illuminate\Support\Facades\Session;
use App\Models\UserSession;


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
            $sessionId = Session::getId();
            $deviceInfo = $request->header('User-Agent');

            $activeSessions = UserSession::where('user_id', \Auth::guard("admins")->user()->id)->count();

            if ($activeSessions >= 2) {
                \Auth::guard("admins")->logout();
                return redirect()->route('login')->withErrors(['email' => 'You may not logIn more then 2 device.']);
            }

            UserSession::create([
                'user_id' => \Auth::guard("admins")->user()->id,
                'session_id' => $sessionId,
                'device_info' => $deviceInfo,
            ]);

            return redirect()->route('admin-dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function getLogout(Request $request)
    {
        $sessionId = Session::getId();
        UserSession::where('session_id', $sessionId)->delete();

        \Auth::guard("admins")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with('success', 'Logged out successfully');
    }
}
