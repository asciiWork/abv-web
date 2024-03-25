<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
 
class Contact extends Model
{
    protected $table = 'contact';
    public $timestamps = false;

    public static function generatePassword($length = 8)
    { 
        // inicializa variables 
        $password = ""; 
        $i = 0; 
        $possible = "0123456789abcdfghjkmnpqrstvwxyz";

        // agrega random 
        while ($i < $length){ 
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1); 
            if (!strstr($password, $char)) {  
                $password .= $char; 
                $i++; 
            }
        } 
        return $password; 
    }
}