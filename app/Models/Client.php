<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','email', 'phone_1','address','phone_2','phone_3','pincode','city','state','company_name', 'ship_address','gstn','ship_pincode', 'ship_city', 'ship_state',];

    public function listData()
    {
        return Client::select('*');
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

        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public static function allClients()
    {
        return Client::select(\DB::raw("CONCAT(name,' - ',phone_1,' ',company_name) as cname"),'id', 'address','city','state', 'pincode','gstn',"ship_address", "ship_city", "ship_state", "ship_pincode")->get();
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
