<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;
use App\models\product\Category;
use App\models\product\Product;
use App\models\product\TypeProduct;

class TypeProductTwo extends Model
{
    protected $table = "product_type_two";
    public function cate()
    {
        return $this->hasOne(Category::class,'id','cate_id');
    }
    public function typecate()
    {
        return $this->hasOne(TypeProduct::class,'id','type_id');
    }
    public function saveTypeTwo($request)
    {
        $cat = Category::where('id',$request->cate_id)->first('slug');
        $type = TypeProduct::where('id',$request->type_id)->first('slug');
        $id = $request->id;
        if($id != "" ){
             $query = TypeProductTwo::where([
                'id' => $id
             ])->first();
            if ($query) {
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->type_id = $request->type_id;
                $query->type_slug = $type ? $type->slug : '';
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->save();
            }else{
                $query = new TypeProductTwo();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->type_id = $request->type_id;
                $query->type_slug = $type ? $type->slug : '';
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->save();
            }
            
        }else{
                $query = new TypeProductTwo();
                $query->name = json_encode($request->name);
                $query->slug = to_slug($request->name[0]['content']);
                $query->content = $request->content;
                $query->cate_id = $request->cate_id;
                $query->cate_slug = $cat ? $cat->slug : '';
                $query->type_id = $request->type_id;
                $query->type_slug = $type ? $type->slug : '';
                $query->status = $request->status;
                $query->avatar = $request->avatar;
                $query->save();
            
        }
        return $query;
    }
}
