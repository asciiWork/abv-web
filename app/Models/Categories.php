<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Categories extends Model
{
    protected $table = 'product_category';
	public function get_category()
	{
		$cat = DB::table('product_category')->get();
    	return $cat;
	}
}