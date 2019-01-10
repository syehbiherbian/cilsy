<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    protected $table = "bootcamp";
    
    public function course(){
        $this->hasMany('App\Models\Course');
    }

    public function lampiran(){
        return $this->hasMany('App\Models\BootcampLampiran');
    }

    public function boot_member(){
        return $this->belongsTo('App\Models\BootcampMember');
    }
}
