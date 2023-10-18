<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use App\models\language\Language;
use App\models\product\Category;
use  App\models\product\TypeProductTwo;

class TypeProduct extends Model
{
    protected $table = "product_type";
    public function category()
    {
        return $this->hasOne(Category::class, 'quiz_id')->where('product_category.language','vi')->select(['name']);
    }

    public function typetwo()
    {
        return $this->hasMany(TypeProductTwo::class,'type_id','id');
    }
    
    public function saveTypeCate($request)
    {
        $cat = Category::where('id',$request->cate_id)->first('slug');
        $id = $request->id;
        if($id != "" ){
             $query = TypeProduct::where([
                'id' => $id
             ])->first();
            if ($query) {
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->status = $request->status;
                $query->home_status = $request->home_status;
                $query->avatar = $request->avatar;
                $query->save();
            }else{
                $query = new TypeProduct();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->status = $request->status;
                $query->home_status = $request->home_status;
                $query->avatar = $request->avatar;
                $query->save();
            }
            
        }else{
                $query = new TypeProduct();
                $query->quiz_id = 0;
                $query->language = 0;
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->save();
            
        }
        return $query;
    }
    public function listCateType($keyword)
    {
        if($keyword == ""){
            $data = $this->with([
                'category',
            ])->orderBy('id','DESC')->where('language','vi')->get();
        }else{
            $data = $this->with([
                'category',
            ])
            ->where('name', 'LIKE', '%'.$keyword.'%')
            ->where('language','vi')
            ->orderBy('id','DESC')
            ->get()
            ->toArray();
        }
        return $data;
    }
}
