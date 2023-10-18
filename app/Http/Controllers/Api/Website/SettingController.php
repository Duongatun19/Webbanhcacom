<?php

namespace App\Http\Controllers\Api\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\website\Setting;
use DB;

class SettingController extends Controller
{
	public function setting()
	{
		$data = Setting::first();
		return response()->json([
    		'message' => 'get Success',
    		'data'=> $data
    	],200);
	}
    public function postsetting(Request $request)
    {
    	if (Setting::count() < 1 )
        {
        	$setting = new Setting();
        
	    	$setting->webname = $request->webname;
	    	$setting->company = $request->company;
	    	$setting->address1 = $request->address1;
	    	$setting->address2 = $request->address2;
	    	$setting->phone1 = $request->phone1;
	    	$setting->phone2 = $request->phone2;
	    	$setting->phone3 = $request->phone3;
	    	$setting->fax = $request->fax;
            $setting->email  = $request->email;
	    	$setting->facebook = $request->facebook;
            $setting->google   = $request->google;
            $setting->GA = $request->GA;
            $setting->fbPixel  = $request->fbPixel;
	    	$setting->iframe_map  = $request->iframe_map;
	    	$setting->favicon  = $request->favicon;
	    	$setting->logo  = $request->logo;
			$setting->popupimage  = $request->popupimage;
			$setting->statusPopup  = $request->statusPopup;
			$setting->linkpopup  = $request->linkpopup;
			$setting->footer_content  = $request->footer_content;
	    	$setting->save();
        }else {

        	$setting = Setting::find(1);
	    	$setting->webname = $request->webname;
	    	$setting->company = $request->company;
	    	$setting->address1 = $request->address1;
	    	$setting->address2 = $request->address2;
	    	$setting->phone1 = $request->phone1;
	    	$setting->phone2 = $request->phone2;
	    	$setting->phone3 = $request->phone3;
	    	$setting->fax = $request->fax;
            $setting->email  = $request->email;
	    	$setting->facebook = $request->facebook;
            $setting->google   = $request->google;
            $setting->GA = $request->GA;
            $setting->fbPixel  = $request->fbPixel;
	    	$setting->iframe_map  = $request->iframe_map;
	    	$setting->favicon  = $request->favicon;
	    	$setting->logo  = $request->logo;
			$setting->popupimage  = $request->popupimage;
			$setting->linkpopup  = $request->linkpopup;
			$setting->statusPopup  = $request->statusPopup;
			$setting->footer_content  = $request->footer_content;
	    	$setting->save();
        }
        return response()->json([
    		'message' => 'save Success'
    	],200);
    }
}
