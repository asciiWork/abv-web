<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Categories extends Model
{
    protected $table = 'product_category';
    public $timestamps = false;
	public static function get_Menucategory(){
		$cat = DB::table('product_category')
		->select('product_category.id','product_category.category_name', 'product_category.cat_slug', 'product_category.cat_img', DB::raw('COUNT(product.category_id) AS pro_count'))
	    ->join('product', 'product_category.id', '=', 'product.category_id')
	    ->groupBy('product_category.id')
	    ->groupBy('product_category.category_name')
	    ->groupBy('product_category.cat_img')
	    ->groupBy('product_category.cat_slug')
	    ->get();
	    return $cat;
	}
	public function get_category($id='')
	{
		$cat = DB::table('product_category')
		->select('product_category.*', DB::raw('COUNT(product.id) AS p_count'))
		->leftJoin('product', 'product.category_id', 'product_category.id')
		->where('product_category.status',1);
		if($id){
			$cat =$cat->where('product_category.id',$id);
		}
		$cat =$cat->groupBy('product_category.id')
			->get();
    	return $cat;
	}
	public function get_categoryBy_slug($slug){
		$cat = DB::table('product_category');
		if($slug){
			$cat =$cat->where('cat_slug',$slug);
		}
		$cat =$cat->get();
    	return $cat;
	}
}