<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\blog\BlogTypeCate;
use App\models\blog\BlogCategory;

class BlogTypegoryController extends Controller
{
    public function add(Request $request, BlogTypeCate $category)
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
            $data = BlogTypeCate::with(['cateBlog'])->orderBy('id','DESC')->get();
        }else{
            $data = BlogTypeCate::with(['cateBlog'])->where('name', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = BlogTypeCate::where(['id'=>$id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function deleteTypeBlog($id)
    {
        $query = BlogTypeCate::find($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success'],200);
    }
    public function findTypeBlog($id){
        $query = BlogTypeCate::where(['category_slug'=>$id,'status'=>1])->get(['id','slug','name']);
        return response()->json([
            'message' => 'success',
            'data' => $query
        ], 200);
    }
}
