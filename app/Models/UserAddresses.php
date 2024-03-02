<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
 
class UserAddresses extends Model
{
    protected $table = 'user_addresses';
    public $timestamps = false;

    public static function getAddData($id){
      return $tObj = UserAddresses::where('user_id',$id)->orderBy('id', 'desc')->take(2)->get();
    }
    public static function addOrderAddress($ordr_id,$id)
    {
        $order = Order::find($ordr_id);
        if($order){

            $obj = new UserAddresses;
            $obj->user_id = $id;
            $obj->name = $order->bil_name;
            $obj->phone = $order->bil_phone;
            $obj->street = $order->bil_street;
            $obj->company = $order->bil_company;
            $obj->area = $order->bil_area;
            $obj->city = $order->bil_city;
            $obj->state = $order->bil_state;
            $obj->zipcode = $order->bil_zipcode;
            $obj->country = $order->country;
            $obj->contact_email = $order->contact_email;
            $obj->is_default = 0;
            $obj->save();

            if($order->ship_name!=''){
                $obj = new UserAddresses;
                $obj->user_id = $id;
                $obj->name = $order->ship_name;
                $obj->phone = $order->ship_phone;
                $obj->street = $order->ship_street;
                $obj->company = $order->ship_company;
                $obj->area = $order->ship_area;
                $obj->city = $order->ship_city;
                $obj->state = $order->ship_state;
                $obj->zipcode = $order->ship_zipcode;
                $obj->country = $order->country;
                $obj->is_ship = 1;
                $obj->is_default = 0;
                $obj->save();
            }
        }
    }
}