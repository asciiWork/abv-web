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
    	$data = OrderDetail::select('order_details.*','product.product_name', 'product_size.product_code as product_code')
                ->join('product','order_details.product_id','product.id')
                ->leftJoin('product_size', 'product_size.product_id','product.id')
                ->where('order_details.order_id',$id)
                ->groupBy('order_details.id')
                ->get();
        return $data;
    }
}