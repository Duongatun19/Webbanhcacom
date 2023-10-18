<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";
    protected $fillable = ['id', 'image', 'status', 'link','title','description'];
    
}
