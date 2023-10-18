<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\models\website\Video;

class VideoController extends Controller
{
    public function createOrUpdateVideo(Request $request)
    {
    	if($request->data){
    		Video::truncate();
	    	foreach ($request->data as $key => $value) {
	    		Video::updateOrCreate(
				    ['image' => $value['image'],
				     'status' =>$value['status'],
				     'name' =>$value['name'],
					 'link' => $value['link']
				 	]
				);
	    	}
    	}
    	return response()->json([
            'messenge' => 'success'
        ],200);
    }
    public function listVideo()
    {
    	$data = Video::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
	}
}
