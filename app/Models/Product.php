<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Product extends Model
{
    protected $table = 'product';
	public function get_Allproduct()
	{
		$product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1')
            ->get();
    	return $product;
	}
	public function get_latest_product($proNum)
	{
		$product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1')
            ->orderBy('id', 'desc')->take($proNum)->get();
    	return $product;
	}
	public function get_ProductDetail($slug)
	{
		$product = DB::table('product')->where("product.product_slug", $slug)->first();
    	return $product;
	}
	public function get_ProductReview($id)
	{
		$productReview = DB::table('product_review')->where("product_id", $id)->get();
    	return $productReview;
	}
}