<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Lab404\Impersonate\Models\Impersonate;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Quotation;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = "admins";
    protected $table = "admin_users";

    protected $fillable = ['name','email', 'password','status','image','phone','user_type_id'];

    public function listData()
    {
        return Admin::select('*');
    }
    public static function getSelling()
    {
        $data = array();
        $users = Admin::where('status',1);
        if (\Auth::guard('admins')->user()->user_type_id != 1) {
            $users = $users->where('id', \Auth::guard('admins')->user()->user_type_id);
        }
        $users = $users->get();
        foreach ($users as $user) {
            $data[$user->id]['name'] = $user->name;
            $data[$user->id]['phone'] = $user->phone;
            $data[$user->id]['image'] = Admin::getAvtar($user->image);
            $data[$user->id]['yearly'] = Quotation::where('invoice_date', 'LIKE', '%' . date('Y') . '%')->where('user_id', $user->id)->sum('final_total_amount');
            $data[$user->id]['monthly'] = Quotation::where('invoice_date', 'LIKE', '%' . date('Y-m') . '%')->where('user_id', $user->id)->sum('final_total_amount');
            $data[$user->id]['today'] = Quotation::where('invoice_date', 'LIKE', '%' . date('Y-m-d') . '%')->where('user_id', $user->id)->sum('final_total_amount');
        }
        return $data;
    }
    public static function getAvtar($image)
    {
        $img = asset("public/uploads/users/default-user.jpg");
        if (!empty($image)) {
            $imge = public_path("uploads/users/". $image);
            if (!file_exists($imge)) {
                $img = asset("public/uploads/users/default-user.jpg");
            } else {
                $img = asset("public/uploads/users/" . $image);
            }
        }
        return $img;
    }
    public static function validationRule($request, $id=0) {
        $status = 1;
        $msg = '';
        $data = array();
        $rules = [
            'name' => 'required|min:2',
            'phone' => 'required',
        ];
        if($id){
            $rules += [
                'email' => 'required|unique:users,email,'.$id,
                'status'=>'required'
            ];
        }else{
            $rules += [
                'email' => 'required|unique:users,email',
                'password' => 'required|min:4|same:password',
            ];
        }
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }

        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
}