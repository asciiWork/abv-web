<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class TempOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'temp_order_details';

    public static function getOrders($id)
    {
        $data = TempOrderDetail::select('temp_order_details.*', 'product.product_name')
        ->join('product', 'temp_order_details.product_id', 'product.id')
        ->where('order_id', $id)
        ->get();
        return $data;
    }
}