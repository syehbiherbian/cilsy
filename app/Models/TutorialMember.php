<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorialMember extends Model
{
    protected $table = 'tutorial_member';
    protected $fillable = ['member_id', 'lesson_id', 'flag'];
}
