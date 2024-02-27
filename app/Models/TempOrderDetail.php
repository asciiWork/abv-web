<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class TempOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'temp_order_details';
    public $timestamps = false;

    public static function getOrders($id){
    	return $tObj = TempOrderDetail::where('temp_order_id',$id)->get();
    }
}