<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    public $timestamps = false;

    public static function getOrders($id){
    	$data = OrderDetail::select('order_details.*','product.product_name')
                ->join('product','order_details.product_id','product.id')
                ->where('order_id',$id)
                ->get();
        return $data;
    }
}