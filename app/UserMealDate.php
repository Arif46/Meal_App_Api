<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMealDate extends Model
{
    protected $fillable = ['is_breakfast', 'is_lunch','is_dinner'];
    
}
