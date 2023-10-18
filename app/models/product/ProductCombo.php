<?php

namespace App\models\product;

use Illuminate\Database\Eloquent\Model;

class ProductCombo extends Model
{
    protected $table = "product_combos";

    public function products()
    {
        return $this->hasMany(Product::class, 'combo_id', 'id');
    }

    public function createOrEdit($request)
    {
        $id = $request->id;
        if($id){
            $query = ProductCombo::find($id);
            if($query){
                $query->name = $request->name;
                $query->slug = to_slug($request->name);
                $query->image = $request->image;
                $query->status = $request->status;
                $query->save();
            }
            return $query;
        }else{
            $query = new ProductCombo();
            $query->name = $request->name;
            $query->slug = to_slug($request->name);
            $query->image = $request->image;
            $query->status = $request->status;
            $query->save();
            return $query;
        }
    }
    public function getAll($request)
    {
        $key = $request->keyword;
        if($key == ""){
            $query = ProductCombo::orderBy('id','DESC')->get();
        }else{
            $query = ProductCombo::where('name', 'LIKE', '%'.$key.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return $query;
    }
    public function find($id)
    {
        $query = ProductCombo::findOrFail($id);
        return $query;
    }
    public function deleteBrands($id)
    {
        $query = ProductCombo::findOrFail($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return $query;
    } 
}
