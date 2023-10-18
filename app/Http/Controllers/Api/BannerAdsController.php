<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\BannerAds;

class BannerAdsController extends Controller
{
    public function create(Request $request, BannerAds $ser)
    {
    	$data = $ser->saveBanner($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
    	$keyword = $request->keyword;
        if($keyword == ""){
            $data = BannerAds::orderBy('id','DESC')->get(['id','name','created_at','image']);
        }else{
            $data = BannerAds::where('title', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function delete($id)
    {
        $query = BannerAds::find($id);
        $file= str_replace('http://localhost:8080','',$query->image);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success'],200);
    }
    public function edit($id)
    {
        $data = BannerAds::where([
            'id'=> $id
        ])
        ->first();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
