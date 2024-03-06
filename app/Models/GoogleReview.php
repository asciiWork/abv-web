<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class GoogleReview extends Model
{
    protected $table = 'google_review';
    public $timestamps = false;

    public static function getReviewData(){
      return $tObj = GoogleReview::where('is_site','1')->get();
    }
}