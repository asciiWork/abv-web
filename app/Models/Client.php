<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','email', 'user_id', 'phone_1','is_lock','address','phone_2','phone_3','pincode','city','state','company_name', 'ship_address','gstn','ship_pincode', 'ship_city', 'ship_state', 'ship_landmark', 'landmark'];

    public function listData()
    {
        if(\Auth::guard('admins')->user()->user_type_id == 1){
            return Client::select('*');
        }else{
            return Client::select('*')->where('user_id', \Auth::guard('admins')->user()->id);
        }
    }
    public static function validationRule($request, $id = 0)
    {
        $status = 1;
        $msg = '';
        $data = array();
        $rules = [
            'name' => 'required|min:2',
            'state' => 'required|min:2',
            'phone_1' => 'required|numeric|digits_between:10,15',
        ];
        /*if ($id) {
            $rules += [
                'email' => 'required|unique:users,email,' . $id,
            ];
        } else {
            $rules += [
                'email' => 'required|unique:users,email',
            ];
        }*/
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }
        $search_phone = $request->get('phone_1');
        $phoneC = Client::where(function ($qry) use ($search_phone) {
            $qry = $qry->where('phone_1', 'LIKE', '%' . $search_phone . '%')
                ->orWhere('phone_3', 'LIKE', '%' . $search_phone . '%')
                ->orWhere('phone_2', 'LIKE', '%' . $search_phone . '%');
        });
        if($id){
            $phoneC = $phoneC->where('id','!=',$id);
        }
        $phoneC = $phoneC->first();
        if($phoneC){
            $msg = 'Client Already exists!';
            return ['status' => 1, 'msg' => $msg, 'data' => $data];
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public static function allClients()
    {
        if (\Auth::guard('admins')->user()->user_type_id == 1){
            return Client::select(\DB::raw("CONCAT(company_name,' - ',phone_1,' ',name) as cname"),'id', 'address','city','state', 'pincode','gstn',"ship_address", "ship_city", "ship_state", "ship_pincode", "landmark","ship_landmark")->get();
        }else{
            return Client::select(\DB::raw("CONCAT(company_name,' - ',phone_1,' ',name) as cname"),'id', 'address','city','state', 'pincode','gstn',"ship_address", "ship_city", "ship_state", "ship_pincode", "landmark","ship_landmark")->where('user_id', \Auth::guard('admins')->user()->id)->get();
        }
    }
    public static function stateList()
    {
        return [
            "Andaman and Nicobar Islands" => "Andaman and Nicobar Islands",
            "Andhra Pradesh" => "Andhra Pradesh",
            "Arunachal Pradesh" => "Arunachal Pradesh",
            "Assam" => "Assam",
            "Bihar" => "Bihar",
            "Chandigarh" => "Chandigarh",
            "Chhattisgarh" => "Chhattisgarh",
            "Dadra and Nagar Haveli" => "Dadra and Nagar Haveli",
            "Daman and Diu" => "Daman and Diu",
            "Delhi" => "Delhi",
            "Goa" => "Goa",
            "Gujarat" => "Gujarat",
            "Haryana" => "Haryana",
            "Himachal Pradesh" => "Himachal Pradesh",
            "Jammu and Kashmir" => "Jammu and Kashmir",
            "Jharkhand" => "Jharkhand",
            "Karnataka" => "Karnataka",
            "Kerala" => "Kerala",
            "Lakshadweep" => "Lakshadweep",
            "Madhya Pradesh" => "Madhya Pradesh",
            "Maharashtra" => "Maharashtra",
            "Manipur" => "Manipur",
            "Meghalaya" => "Meghalaya",
            "Mizoram" => "Mizoram",
            "Nagaland" => "Nagaland",
            "Orissa" => "Orissa",
            "Pondicherry" => "Pondicherry",
            "Punjab" => "Punjab",
            "Rajasthan" => "Rajasthan",
            "Sikkim" => "Sikkim",
            "Tamil Nadu" => "Tamil Nadu",
            "Tripura" => "Tripura",
            "Uttar Pradesh" => "Uttar Pradesh",
            "Uttaranchal" => "Uttaranchal",
            "West Bengal" => "West Bengal",
        ];
    }
}
