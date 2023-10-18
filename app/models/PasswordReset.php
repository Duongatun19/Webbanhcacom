<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = "password_resets";
    protected $fillable = [
        'email',
        'token',
    ];
}
