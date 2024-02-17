<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class ProductSize extends Model
{
    protected $table = 'product_size';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}