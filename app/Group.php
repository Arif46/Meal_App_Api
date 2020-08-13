<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function group_member()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }
}
