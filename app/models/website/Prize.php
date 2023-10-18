<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = "prizes";
    protected $fillable = ['id','name', 'image', 'status', 'link','type'];
}
