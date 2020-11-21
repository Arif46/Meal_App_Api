<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inviation extends Model
{
    protected $table="invitations";

    public function group()
    {
        return $this->hasMany('App\Group','id','group_id');
    }
    public function groupinfo()
    {
        return $this->hasMany('App\Group','id','group_id');
    }
    public function SenderInfo()
    {
        return $this->hasMany('App\User','id','sender_id');
    }
    public function ReceiverInfo()
    {
        return $this->hasMany('App\User','id','receiver_id');
    }
}
