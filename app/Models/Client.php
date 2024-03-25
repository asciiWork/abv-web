<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','email', 'phone_1','address','phone_2','phone_3'];

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
            'phone_1' => 'required',
        ];
        if ($id) {
            $rules += [
                'email' => 'required|unique:users,email,' . $id,
            ];
        } else {
            $rules += [
                'email' => 'required|unique:users,email',
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
