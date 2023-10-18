<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = "partners";
    protected $fillable = ['id','name', 'image', 'status', 'link','type'];
}
