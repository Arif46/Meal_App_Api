<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
 public function Admininfo()
 {
     return $this->hasMany('App\User','phone_number','phone_number');
 }
  
}
