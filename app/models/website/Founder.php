<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $table = "founders";
    protected $fillable = ['id', 'image', 'status','name','position'];
}
