<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class TempOrder extends Model
{
    protected $table = 'temp_orders';
    public $timestamps = false;	
}