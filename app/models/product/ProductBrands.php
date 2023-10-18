<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;

class ProductBrands extends Model
{
    protected $table = 'product_brands';

    public function createOrEdit($request)
    {
        $id = $request->id;
        if($id){
            $query = ProductBrands::find($id);
            if($query){
                $query->name = $request->name;
                $query->slug = to_slug($request->name);
                $query->image = $request->image;
                $query->cate_id = json_encode($request->cate_id);
                // $query->type_id = json_encode($request->type_id);
                $query->status = $request->status;
                $query->save();
            }
            return $query;
        }else{
            $query = new ProductBrands();
            $query->name = $request->name;
            $query->slug = to_slug($request->name);
            $query->image = $request->image;
            $query->cate_id = json_encode($request->cate_id);
            // $query->type_id = json_encode($request->type_id);
            $query->status = $request->status;
            $query->save();
            return $query;
        }
    }
    public function getAll($request)
    {
        $key = $request->keyword;
        if($key == ""){
            $query = ProductBrands::orderBy('id','DESC')->get();
        }else{
            $query = ProductBrands::where('name', 'LIKE', '%'.$key.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return $query;
    }
    public function find($id)
    {
        $query = ProductBrands::findOrFail($id);
        return $query;
    }
    public function deleteBrands($id)
    {
        $query = ProductBrands::findOrFail($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return $query;
    }
}
