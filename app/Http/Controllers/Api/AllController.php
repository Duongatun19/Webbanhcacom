<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Librarys;
use App\models\MessContact;

class AllController extends Controller
{
    public function uploadImage(Request $request)
    {
        if($imgAvatar = $request->file('img')){
            $nameAvatar = $imgAvatar->getClientOriginalName();
            $fintimg = strpos($nameAvatar, '.jpg');
            if($fintimg == true){
                $nameImg = $request->title_post.'-'.rand().'.jpg';
            }else{
                $nameImg = $request->title_post.'-'.rand().'.png';
            }
            $imgAvatar->move('uploads/images/', $nameImg);
            return response()->json([
                'messenge' => 'success',
                'path' => url('/').'/uploads/images/'.$nameImg
            ],200);
        }else{
            return response()->json([
                'data' => 'fail'
            ],500);
        }
        
    }
    public function uploadImageMulti(Request $request)
    {
        $uploadId = [];
        if($files = $request->file('file')){
            foreach($request->file('file') as $key => $file){
                $name = rand().$file->getClientOriginalName();
                $fielname = $file->move('uploads/imagesMuli/', $name);
                $uploadId[] = url('/').'/uploads/images/'.$name;
            }
        }
        return response()->json([
            'messenge' => 'success',
            'path' => $uploadId
        ],200);
    }
    public function fileStore(Request $request)
    {
        $upload_path = public_path('upload');
        $file_name = $request->file->getClientOriginalName();
        $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($upload_path, $generated_new_name);
         
        $insert['title'] = $generated_new_name;
        return response()->json([
            'messenge' => 'success',
            'path' => $insert
        ],200);
    }
    public function listMesscontact(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = MessContact::orderBy('id','DESC')->get();
        }else{
            $data = MessContact::where('title', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }

    public function deleteMesscontact($id)
    {
        $data = MessContact::find($id);
        $data->delete();
        return response()->json(['message'=>'Delete Success'],200);
    }
}
