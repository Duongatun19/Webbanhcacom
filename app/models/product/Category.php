<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use App\models\language\Language;
use App\models\product\Product;
use App\models\product\TypeProduct;

class Category extends Model
{
    protected $table = "product_category";
    public function rule()
    {
        return [
            
        ];
    }
    public function typeCate()
    {
        return $this->hasMany(TypeProduct::class,'cate_id','id');
    }

    public function typeTwoCate()
    {
        return $this->hasMany(TypeProductTwo::class, 'cate_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'category','id');
    }

    public function saveCate($request)
    {
        $id = $request->id;
        if($id != "" ){
            $query = Category::where([
                'id' => $id
             ])->first();
            if ($query) {
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->imagehome = $request->imagehome;
                $query->save();
            }else{
                $query = new Category();
                $query->quiz_id = 0;
                $query->language = 0;
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->imagehome = $request->imagehome;
                $query->save();
            }
            
        }else{
            $query = new Category();
            $query->quiz_id = 0;
            $query->language = 0;
            $query->name = json_encode($request->name);
            $query->slug = to_slug($request->name[0]['content']);
            $query->content = $request->content;
            $query->status = $request->status;
            $query->avatar = $request->avatar;
            $query->imagehome = $request->imagehome;
            $query->save();
            
        }
        return $query;
    }
}
