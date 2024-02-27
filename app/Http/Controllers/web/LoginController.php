<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        $data = array();
        $data['page_title'] = 'Login';
        return view('web.login', $data);
    }
    public function checkLogin(Request $request)
    {
        $status = 0;
        $msg = "The credential that you've entered doesn't match any account.";

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        // check validations
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        } else {
            if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
                $user = Auth::user();
                $status = 1;
                $msg = "Logged in successfully.";
                $user->last_login_at = \Carbon\Carbon::now();
                $user->save();

            }
        }
        if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return redirect('login');
        }
    }
    public function register()
    {
        $data = array();
        $data['page_title'] = 'Register';
        return view('web.register', $data);
    }
    public function checkRegister(Request $request)
    {
        $status = 0;
        $msg = "The credential that you've entered doesn't match any account.";

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|same:password',
            'cpassword' => 'required|same:password',
            'term' => 'required',
        ]);

        // check validations
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        } else {
            $user = new User();
            $user->name = $request->get("name");
            $user->email = $request->get("email");
            $user->password = bcrypt($request->get("password"));
            $user->save();

            $status = 1;
            $msg = "Logged in successfully.";
        }
        if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return redirect('login');
        }
    }
    public function getLogout()
    {
        $url = '/';
        session()->forget('note');
        session()->forget('temp_order_id');
        session()->forget('cart');
        Auth::logout();
        return redirect($url);
    }
}
