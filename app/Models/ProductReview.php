<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class ProductReview extends Model
{
    protected $table = 'product_review';
	
	public function get_ProductReview($id)
	{
		$productReview = DB::table('product_review')->where("product_id", $id)->get();
    	return $productReview;
	}
}