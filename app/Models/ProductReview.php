<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class ProductReview extends Model
{
    protected $table = 'product_review';
    public $timestamps = false;
	
	public function get_ProductReview($id='')
	{
		$productReview = DB::table('product_review');
		if($id>0){
			$productReview=$productReview->where("product_id", $id);
		}
		$productReview=$productReview->get();
    	return $productReview;
	}
	public function get_ProductWithReview($product_id=''){
		$productReview = DB::table('product_review')
			->select(['product_review.*', 'users.name'])
			->join('users', "product_review.user_id", "=", "users.id");
			if($product_id){
				$productReview=$productReview->where("product_review.product_id", $product_id);
			}
		$productReview=$productReview->get();
    	return $productReview;
	}
	public function getAvgRating($id='')
	{
		$rates = DB::table('product_review')->where('product_id',$id)->select('review_rate')->get()->toArray();

           $rateArray =[];
           $result=$totalRate=0;
           foreach ($rates as $rate)
           {
               $rateArray[]= $rate->review_rate;
           }

            $sum = array_sum($rateArray);
            $totalRate=count($rateArray);
            if($totalRate>0){
            	$result = $sum/$totalRate;
        	}
            return['avgRate' => $result, 'totalRate' => $totalRate];
		//$query=DB::table('product_review')->where('product_id',$id)->selectRaw('SUM(review_rate)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
		//return round($query);
	}
}