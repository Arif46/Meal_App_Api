<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table ="groups";

    protected $fillable = [
        'group_name','address','cooks_name','shopping_type','meal_type','is_admin'
    ];

    public function group_member()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }
   
    public function admin()
    {
       return $this->hasMany('App\GroupMember','group_id','id');
    }
    public function groupmember()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }

    public function TotalMember()
    {
        return $this->hasMany('App\GroupMember','group_id','id');
    }
   

   
  
  
 
}
