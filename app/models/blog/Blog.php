<?php

namespace App\models\blog;

use Illuminate\Database\Eloquent\Model;
use App\models\language\Language;
use Auth;
use App\models\blog\BlogCategory;
use App\models\blog\BlogTypeCate;

class Blog extends Model
{
    protected $table = "blogs";
    public function cate()
    {
        return $this->hasOne(BlogCategory::class,'slug','category');
    }
    public function typeCate()
    {
        return $this->hasOne(BlogTypeCate::class,'slug','type_cate');
    }
    public function saveBlog($request)
    {
    	$id = $request->id;
        if($id != ""){
            $query = Blog::where([
                'id' => $id
             ])->first();
            if ($query) {
                $file= $query->image;
                // $filename = public_path().$file;
                // if(file_exists( public_path().$file ) ){
                //     \File::delete($filename);
                // }
                $query->title = json_encode($request->title);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->category = $request->category;
                $query->type_cate = $request->type_cate;
                $query->cate_product = $request->cate_product;
                $query->status = $request->status;
                $query->type_news = $request->type_news;
                $query->home_status = $request->home_status;
                $query->image = $request->image;
                $query->slug = to_slug($request->title[0]['content']);
                $query->author = Auth::user()->name;
                $query->save();
            }else{
                $query = new Blog();
                $query->title = json_encode($request->title);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->image = $request->image;
                $query->category = $request->category;
                $query->type_cate = $request->type_cate;
                $query->cate_product = $request->cate_product;
                $query->status = $request->status;
                $query->type_news = $request->type_news;
                $query->home_status = $request->home_status;
                $query->slug = to_slug($request->title[0]['content']);
                $query->author = Auth::user()->name;
                $query->save();
            }
            
        }else{
                $query = new Blog();
                $query->title = json_encode($request->title);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->image = $request->image;
                $query->category = $request->category;
                $query->type_cate = $request->type_cate;
                $query->type_news = $request->type_news;
                $query->cate_product = $request->cate_product;
                $query->status = $request->status;
                $query->home_status = $request->home_status;
                $query->slug = to_slug($request->title[0]['content']);
                $query->author = Auth::user()->name;
                $query->save();
            
        }
        return $query;
    }
    public function deleteBlog($quiz_id)
    {
        $query = Blog::where('quiz_id',$quiz_id)->get();
        foreach($query as $item){
            $data = Blog::find($item->id);
            $file= $data->image;
            $filename = public_path().$file;
            if(file_exists( public_path().$file ) ){
                \File::delete($filename);
            }
            $data->delete();
        }
        
    }
}
