<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bazar extends Model
{
    public function allpayables()
    {
        return $this->hasMany('App\Payable','group_id','group_id');
    }
    public function user_meal()
    {
        return $this->hasMany('App\UserMealDate','group_id','group_id');
    }
}
