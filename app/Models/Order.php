<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    public static function getOrderData($id){
      return $tObj = Order::where('user_id',$id)->orderBy('id','Desc')->get();
    }
    public static function getOrderNo(){
      $tObj = Order::orderBy('id','desc')->first();
      $or = ($tObj)? $tObj->order_number: 0;
      $or = $or + 1;
      return $or = str_pad($or, 5, '0', STR_PAD_LEFT);
    }
}