<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampSubCategory extends Model
{
    protected $table = 'bootcamp_sub_category';

    public function category(){
        return $this->belongsTo('App\Models\BootcampCategory');
    }
}
