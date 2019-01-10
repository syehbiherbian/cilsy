<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    public function boot(){
        return $this->belongsTo('App\Models\Bootcamp');
    }

    public function section(){
        return $this->hasMany('App\Models\Section');
    }
}
