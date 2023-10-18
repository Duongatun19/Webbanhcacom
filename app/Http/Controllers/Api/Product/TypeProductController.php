<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\models\product\TypeProduct;
use File,Validator;

class TypeProductController extends Controller
{
    public function add(Request $request, TypeProduct $category)
    {
        $data = $category->saveTypeCate($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = TypeProduct::leftJoin('product_category', function($join){
                $join->on('product_category.id','=','product_type.cate_id');
            })
            ->select('product_type.*','product_category.name as cate')->
            orderBy('id','DESC')->get();
        }else{
            $data = TypeProduct::where('name', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = TypeProduct::where(['id'=>$id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function delete( $id)
    {
        $query = TypeProduct::find($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success']);
    }
    public function findType($cate_id)
    {
        $query = TypeProduct::where(['cate_id'=>$cate_id,'status'=>1])->get();
        return response()->json([
            'message' => 'success',
            'data' => $query
        ], 200);
    }
}
