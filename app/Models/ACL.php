<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ACL extends Model
{
    use HasFactory;

    public static function isAccess()
    {
        $authRole = \Auth::guard("admins")->user()->user_type_id;
        return ($authRole == 1)?1:0;
    }
    
}
