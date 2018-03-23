<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Contributor extends User
{
    //tablename
    protected $table = "contributors";
}
