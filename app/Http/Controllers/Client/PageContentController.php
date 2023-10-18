<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\PageContent;
use Session;

class PageContentController extends Controller
{
    public function detail($slug)
    {
    	$language_current = Session::get('locale');
    	$data['pagecontentdetail'] = PageContent::where(['language'=>$language_current,'slug'=>$slug])->first();
    	return view('pageContent',$data);
    }
}
