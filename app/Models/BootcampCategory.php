<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampCategory extends Model
{
    protected $table = 'bootcamp_category';

    public function sub(){
        return $this->hasMany('App\Models\BootcampSubCategory');
    }

}
