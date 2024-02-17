<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class TempOrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'temp_order_details';
    public $timestamps = false;	
}