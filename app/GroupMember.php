<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
//  public function Admininfo()
//  {
//      return $this->hasMany('App\User','phone_number','phone_number');
//  }
 public function group()
 {
    return $this->hasMany('App\Group','id','group_id'); 
 }
 public function Userinfo()
 {
    return $this->hasMany('App\User','phone_number','phone_number');
 }
 public function GroupUser()
 {
    return $this->hasMany('App\Group','id','group_id');
 }
 public function ActiveGroup()
 {
    return $this->belongsTo('App\Group','group_id','id');
 }


  
}
