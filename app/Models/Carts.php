<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
 
class Carts extends Model
{
	use HasFactory;
    protected $table = 'carts';
    public $timestamps = false;	
    public static function getCartData()
    {
    	$data = array();
    	if(\Auth::check())
        {
        }else{
        	$temp_order_id = session()->get('temp_order_id');
            $tObj = TempOrder::find($temp_order_id);
            if($temp_order_id > 0 && $tObj){
            }else{
            	$prds = session()->get('cart');
                if(is_array($prds) && !empty($prds))
                {
                    $i = 0;
                    foreach($prds as $p)
                    {
                       $data[$i]['id'] = $p['id']; 
                       $data[$i]['product_img'] = $p['product_img']; 
                       $data[$i]['product_name'] = $p['product_name']; 
                       $data[$i]['prosize'] = $p['prosize']; 
                       $data[$i]['price'] = $p['price']; 
                       $data[$i]['qnt'] = $p['qnt'];
                       $data[$i]['slug'] = $p['slug'];
                       $data[$i]['total'] = $p['qnt'] * $p['price']; 
                       $i++;
                    }
                }
            }
            return $data;
        }
    }
}