<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    public function video(){
        return $this->hasMany('App\Models\VideoSection');
    }

    public function project(){
        return $this->belongsTo('App\Models\ProjectSection');
    }
}
