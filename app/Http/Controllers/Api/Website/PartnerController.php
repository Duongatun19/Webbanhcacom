<?php

namespace App\Http\Controllers\Api\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\website\Partner;
use App\models\website\Prize;

class PartnerController extends Controller
{
    public function createOrUpdate(Request $request)
    {
    	if($request->data){
    		Partner::truncate();
	    	foreach ($request->data as $key => $value) {
	    		Partner::updateOrCreate(
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
	public function createOrUpdatePrize(Request $request)
    {
    	if($request->data){
    		Prize::truncate();
	    	foreach ($request->data as $key => $value) {
	    		Prize::updateOrCreate(
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
    public function listPartner()
    {
    	$data = Partner::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
	}
	public function listPrize()
    {
    	$data = Prize::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
    }
}
