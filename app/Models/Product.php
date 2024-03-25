<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Product extends Model
{
    protected $table = 'product';
    public function product_size()
    {
        return $this->hasMany(ProductSize::class);
    }
	public static function get_Allproduct()
	{
		$product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->leftJoin('product_category', 'product_category.id', '=', 'product.category_id')
            ->where('product_img.pro_main', '1')
            ->where('product_category.status', '1')
            ->get();
    	return $product;
	}
    public function get_NewArrivals()
    {
        $product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1')
            ->orderBy('product.id', 'desc')
            ->get();
        return $product;
    }
    public function get_BestSellerOrRecent($var)
    {
        $product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1');
        if($var=='best_seller'){
            $product=$product->where('best_seller','1');
        }
        if($var=='recent'){
            $product=$product->where('recent_product','1');
        }
        $product=$product->orderBy('product.id', 'ASC')->get();
        return $product;
    }
	public function productWithSize($id='')
	{
		$productWithSize = Product::with('product_size')
        ->join('product_img', "product.id", "=", "product_img.product_id")
        ->where('product_img.pro_main', '1')
        ->find($id);
        return $productWithSize;
	}
    public function productSize($id=''){
        $productWithSize = Product::with('product_size')->find($id);
        return $productWithSize;
    }
	public function get_latest_product($proNum)
	{
        $product = Product::select('product.id','product.product_name',
        	'product.product_min_price',
        	'product.product_max_price',
        	'product.product_offer_per',
        	'product.product_slug',
        	'product.product_detail',
        	'product_img.product_img_url',
        	DB::raw('SUM(product_review.review_rate)/COUNT(product_review.user_id) AS avg_rating'),
        	DB::raw('COUNT(product_review.id) as total_reviews'),
        	DB::raw('COALESCE(SUM(product_review.review_rate), 0) as total_rating'))        
		->leftjoin('product_review', "product.id", "=", "product_review.product_id")
		->leftjoin('product_img', "product.id", "=", "product_img.product_id")
		->where('product_img.pro_main', '1')
		->groupBy('product.id','product.product_name','product.product_min_price','product.product_max_price','product.product_offer_per','product.product_slug','product.product_detail','product_img.product_img_url');
        if($proNum==1){
            $product =$product->where('product.id',1);
        }else{
		  $product =$product->orderBy('product.id', 'desc');
        }
		if($proNum){
			$product =$product->take($proNum);
		}
		$product =$product->get();
    	return $product;
	}
	public function get_random_product()
	{
		$product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1')
            ->orderBy('id', 'desc')
            ->inRandomOrder()->limit(5)
            ->get();
    	return $product;
	}
	public function get_ProductDetail($slug)
	{
		$product = DB::table('product')
		->select(['product.*', 'product_category.category_name'])
		->leftjoin('product_category', "product.category_id", "=", "product_category.id")
		->where("product.product_slug", $slug)->first();
    	return $product;
	}
	public function get_catProduct($id)
	{
        $product = DB::table('product')
            ->select(['product.*', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->where('product_img.pro_main', '1')
            ->where("product.category_id", $id)
            ->get();
    	return $product;
	}
}