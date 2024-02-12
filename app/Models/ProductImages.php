<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class ProductImages extends Model
{
    protected $table = 'product_img';
	
	public function get_ProductImages($id)
	{
		$productimg = DB::table('product_img')->where("product_id", $id)->get();
    	return $productimg;
	}
}