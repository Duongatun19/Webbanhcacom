<?php

namespace App\Http\Controllers\Api\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\website\Banner;

class BannerController extends Controller
{
    public function createOrUpdate(Request $request)
    {
    	if($request->data){
    		Banner::truncate();

	    	foreach ($request->data as $key => $value) {
	    		Banner::updateOrCreate(
				    [
                        'image' => $value['image'],
				        'status' =>$value['status'],
                        'title' => $value['title'],
                        'description' => $value['description'],
				        'link' => $value['link'],
				 	]
				);
	    	}
    	}
    	return response()->json([
            'messenge' => 'success'
        ],200);
    }
    public function list()
    {
    	$data = Banner::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
    }
}
