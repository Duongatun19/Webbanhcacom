<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\models\product\TypeProductTwo;

class TypeTwoProductController extends Controller
{
    public function add(Request $request, TypeProductTwo $category)
    {
        $data = $category->saveTypeTwo($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = TypeProductTwo::with([
                'cate' =>function ($query) {
                    $query->select('id', 'name', 'slug');
                },
                'typeCate' =>function ($query) {
                    $query->select('id', 'name', 'slug');
                },
            ])->get();
        }else{
            $data = TypeProductTwo::with([
                'cate' =>function ($query) {
                    $query->select('id', 'name', 'slug', 'avatar');
                },
                'typeCate' =>function ($query) {
                    $query->select('id', 'name', 'slug');
                },
            ])->where('name', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = TypeProductTwo::where(['id'=>$id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function delete( $id)
    {
        $query = TypeProductTwo::find($id);
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
        $query = TypeProductTwo::where(['type_id'=>$cate_id,'status'=>1])->get();
        return response()->json([
            'message' => 'success',
            'data' => $query
        ], 200);
    }
}
