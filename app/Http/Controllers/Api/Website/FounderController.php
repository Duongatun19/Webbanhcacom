<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\website\Founder;

class FounderController extends Controller
{
    public function createOrUpdate(Request $request)
    {
    	if($request->data){
    		Founder::truncate();

	    	foreach ($request->data as $key => $value) {
	    		Founder::updateOrCreate(
				    [
                        'image' => $value['image'],
				        'status' =>$value['status'],
                        'name' => $value['name'],
                        'position' => $value['position']
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
    	$data = Founder::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
    }
}
