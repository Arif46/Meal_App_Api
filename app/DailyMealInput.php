<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyMealInput extends Model
{
    protected $fillable = [
        'group_id','breakfast_date_time', 'lunch_date_time', 'dinner_date_time',
    ];
}
