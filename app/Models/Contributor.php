<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ContributorResetPassword;

class Contributor extends User
{
    //tablename
    protected $table = "contributors";

    protected $fillable = [
        'username', 'email', 'password', 'active', 'activation_token'
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new ContributorResetPassword($token));
    }
   
}
