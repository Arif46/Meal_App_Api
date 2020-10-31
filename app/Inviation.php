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
}
