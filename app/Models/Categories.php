<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Categories extends Model
{
    protected $table = 'product_category';
	public function get_category($id='')
	{
		$cat = DB::table('product_category');
		if($id){
			$cat =$cat->where('id',$id);
		}
		$cat =$cat->get();
    	return $cat;
	}
}