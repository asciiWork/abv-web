<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use App\Models\ProductImages;
 
class Carts extends Model
{
	use HasFactory;
    protected $table = 'carts';
    public $timestamps = false;
    public static $PENDING = 'pending';
    public static $PLACED = 'placed';
    public static $CONFIRM = 'confirm';
    public static $SHIPPED = 'shipped';
    public static $OUTFORDEL = 'outForDelivery';
    public static $DELEVERED = 'delivered';

    public static function cartCounter()
    {
        $count = 0;
        if(\Auth::check()){
            $count = Carts::where('user_id',\Auth::user()->id)->count();
        }else{
            $prds = session()->get('cart');
            $count = (is_array($prds))?count($prds):0;
        }
        return $count;
    }
    public static function getCartData()
    {
    	$data = array();
    	if(\Auth::check()){
            $raw = Carts::select('carts.*', 'product.product_name', 'product.product_slug')
                ->join('product', 'product.id', 'carts.product_id')
                ->where('user_id', \Auth::user()->id)
                ->get();
            if ($raw) {
                $i = 0;
                foreach ($raw as $r) {
                    $pObj = ProductImages::select('product_img_url')->where('pro_main', '1')->where('product_id', $r->product_id)->get();
                    $data[$i]['id'] = $r->product_id;
                    $data[$i]['product_id'] = $r->product_id;
                    $data[$i]['product_img'] = $pObj[0]->product_img_url;
                    $data[$i]['product_name'] = $r->product_name;
                    $data[$i]['prosize'] = $r->prosize;
                    $data[$i]['price'] = $r->price;
                    $data[$i]['qnt'] = $r->quantity;
                    $data[$i]['slug'] = $r->product_slug;
                    $data[$i]['total'] = $r->price * $r->quantity;
                    $i++;
                }
            }
        }
        else{
            $prds = session()->get('cart');
            if (is_array($prds) && !empty($prds)) {
                $i = 0;
                foreach ($prds as $prkey => $p) {
                    $data[$i]['id'] = $p['id'];
                    $data[$i]['product_id'] = $p['id'];
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