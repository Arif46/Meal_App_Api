<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function group_member()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }
    public function groupmember()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }
    public function userinfo()
    {
        return $this->hasMany('App\User','phone_number','phone_number');
    }
 
}
