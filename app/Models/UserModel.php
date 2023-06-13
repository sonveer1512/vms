<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'user'; 

    public static  function scopeCheckLogin($query,$email){
        return $query->where('email',$email);
    }

}
