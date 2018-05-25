<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    
    public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function videos()
	{
		return $this->hasMany('\App\Models\Video', 'lessons_id');
	}
}
