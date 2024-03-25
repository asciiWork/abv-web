<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $guarded = ['id'];
}