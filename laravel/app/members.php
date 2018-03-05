<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\MemberResetPasswordNotification;

class members extends User
{
    protected $table = "members";

    protected $fillable = [
        'username', 'email', 'password',
    ];
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }
    public function setPasswordAttribute($password)
    {
    $this->attributes['password'] = bcrypt($password);
    }
}