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

    public function contrib(){
        return $this->belongsTo('App\Models\Contributor');
    }

    public function bootcamp_category(){
        return $this->hasOne('App\Models\BootcampCategory');
    }

    public function bootcamp_sub_category(){
        return $this->hasOne('App\Models\BootcampSubCategory');
    }
}
