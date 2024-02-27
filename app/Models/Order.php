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
      return $tObj = Order::where('user_id',$id)->get();
    }
}