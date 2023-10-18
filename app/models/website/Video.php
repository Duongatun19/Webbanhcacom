<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "video";
    protected $fillable = ['id','name', 'image', 'status', 'link'];
}
