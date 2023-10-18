<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;

class ProductController extends Controller
{
    public function create(Request $request, Product $product)
    {
        $data = $product->createOrEdit($request);
        return response()->json([ 'data' => $data, 'message' => 'success'], 200);
    }
    public function list(Request $request)
    {
        $keyword = to_slug($request->keyword);
        if($keyword == ""){
            $data = Product::with([
                'cate'=> function($query) {
                    $query->select('id', 'name', 'slug');
                },
                'typeCate' => function ($query) {
                    $query->select('id','name','slug'); 
                },
                'typeTwo' => function ($query) {
                    $query->select('id','name','slug'); 
                },
                'brand' => function ($query) {
                    $query->select('id','name','slug'); 
                },
            ])->orderBy('category', 'asc')->get();
        }else{
            $data = Product::with([
                'cate'=> function($query) {
                    $query->select('id', 'name', 'slug');
                },
                'typeCate' => function ($query) {
                    $query->select('id','name','slug'); 
                },
                'typeTwo' => function ($query) {
                    $query->select('id','name','slug'); 
                },
                'brand' => function ($query) {
                    $query->select('id','name','slug'); 
                },
            ])->where('slug', 'LIKE', '%'.$keyword.'%')->orderBy('category', 'asc')->get();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = Product::where([
            'id'=> $id
        ])
        ->first();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function delete($id)
    {
        $query = Product::where(['id'=>$id])
        ->first();
        if($query->images){
            $imgArr = json_decode($query->images);
            foreach($imgArr as $i){
                $file= str_replace('http://localhost:8080','',$i);
                $filename = public_path().$file;
                if(file_exists( public_path().$file ) ){
                    \File::delete($filename);
                }
            }
        }
        $query->delete();
        return response()->json([
            'message' => 'Delete success'
        ]); 
    }

    public function changeCombo($id)
    {
        $data = Product::findOrFail($id);
        $data->combo_id = 0;
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
