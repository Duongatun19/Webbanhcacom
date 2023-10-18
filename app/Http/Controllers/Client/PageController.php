<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use Session;
use App\models\product\Category;
use App\models\product\TypeProduct;
use DB,stdClass,File;
use App\models\District;
use Goutte\Client;
use App\models\blog\Blog;
use App\models\MessContact;
use App\models\Services;
use App\models\website\Prize;
use App\models\website\Founder;
use App\models\website\Partner;
use App\models\PageContent;
use App\models\product\ProductBrands;
use Illuminate\Support\Facades\Redirect;


class PageController extends Controller
{
    public function orderNow()
    { 
        return view('orderNow');
    }
    public function baogia()
    {
        return view('baogia');
    }
    public function menu()
    {
        
        $data['allproduct'] = Product::where([
            ['status', '=', 1]
        ])->limit(9)->orderBy('id','DESC')->get(['id','name','discount','price','images','slug']);
        $data['hotnews'] = Blog::where([
            ['status','=',1],
            ['type_news','=','tin-hot']
        ])->orderBy('id','DESC')->limit(7)->get(['id','title','slug','created_at','image']);
        return view('menu',$data);
    }
    public function quickview($id){
        $data['product'] = Product::with('cate')->where('id',$id)->first();
        return view('layouts.product.quickview',$data);
    }
    public function aboutUs(){
        $data['partner'] = Partner::where(['status'=>1])->get(['id','image','name','link']);
        $data['founder'] = Founder::where(['status'=>1])->get(['id','name','position','image']);
        $data['album'] = Prize::where(['status'=>1])->get(['id','name','image']);
        $data['pageContent'] = PageContent::where(['type'=>'ve-chung-toi', 'language'=>'vi', 'status'=>1])->first(['id','title','content', 'image', 'description']);
        $data['services'] = Services::where([
            ['status','=',1]
        ])->orderBy('id','DESC')->limit(6)->get(['id','name','slug','description','image']);
        return view('aboutus',$data);
    }
    public function contact()
    {
        return view('contactus');
    }
    public function getPostInfor()
    {
        $data['category_product'] = Category::where('status',1)->get();
        return view('post_info.index',$data);
    }
    public function postPostInfor(Request $request,Product $product )
    {
        $data = $product->createClient($request);
        $data['category'] = Category::where(['status'=> 1])->orderBy('id','ASC')->get();
        $data['categoryFirst'] = Category::where(['status'=> 1])->orderBy('id','ASC')->first();
        $productNewFirstTab = Product::where([
            'category'=> $data['categoryFirst'] ? $data['categoryFirst']->id : 0,
            'status' => 0
        ])->with('customer')
        ->orderBy('id','ASC')
        ->limit(10)->get()->toArray();
        $data['productNewFirstTab'] = array_chunk($productNewFirstTab,2);
        return view('home',$data)->with('success','Tin của bạn đang được xét duyệt!');
    }
    public function typeproduct($id)
    {
        $arr = [];
        $data = TypeProduct::where('cate_id',$id)->get();
        $lang = Session::get('locale');
        foreach($data as $item){
            $obj = new stdClass();
            $obj->name = languageName($item->name);
            $obj->id = $item->id;
            $arr[] = $obj;
        }
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $arr
    	],200);
    }
    public function district($id)
    {
        $data = District::where('_province_id',$id)->get();
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $data
    	],200);
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $code = Session::get('locale');
        $arr = [];
        $arrb = [];
        $arrOpt = [];
        //search option
        $productOpt =  Product::with('cate')
        ->where('status',1)
        ->get();
        foreach($productOpt as $key => $item){
            $fielName = json_decode($item['name']);
            foreach($fielName as $i){
                if(strpos(strtolower(stripVN($i->content)), strtolower(stripVN($keyword))) !== false && $i->lang_code == $code){
                    array_push($arr,$productOpt[$key]);
                }
            }
        }
        $data['keyword'] = $request->keyword;
        $data['countproduct'] = count($arr);
        $data['resultPro'] = $arr;
        $data['brands'] = ProductBrands::where('status', 1)->get();
        return view('search_result',$data);
    }

    public function searchAjax(Request $request){
        $keyword = to_slug($request->keyword);
        $data['result'] = Product::where('slug', 'LIKE', '%' . $keyword . '%')->get(['name','slug','images','cate_slug','type_slug']);
        $view = view('layouts.product.search-ajax',$data)->render();
        return response()->json(['html'=>$view]);
    }

    public function postcontact(Request $request){
        $data = new MessContact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->mess = $request->mess;
        $data->address = $request->address;
        $data->save();
        if($data){

            return back()->with('thanhcong', 'Gửi tin thành công');
            

        }else{
            return back()->with('error', 'Gửi tin thất bại');
        }
        
    }

    public function listService()
    {
        $data['title_page'] = 'Tất cả lĩnh vực';
        $data['services'] = Services::where(['status'=>1])->select()->paginate(12);
        $data['news'] = Blog::where(['status'=>1])->orderBy('id', 'desc')->limit(5)->get(['id', 'title', 'slug', 'image']);
        $data['discountPro'] = Product::where('status', 1)->where('discount', '>', 0)->limit(5)->get(['id', 'name', 'price', 'discount', 'images', 'cate_slug', 'type_slug', 'slug']);
        // dd($data['discountPro']);
        return view('service.list', $data);
    }

    public function serviceDetail($slug)
    {
        $data['news'] = Blog::where(['status'=>1, 'home_status'=>1])->orderBy('id', 'desc')->limit(10)->get(['id', 'title', 'slug', 'image']);
        $data['discountPro'] = Product::where('status', 1)->where('discount', '>', 0)->limit(5)->get(['id', 'name', 'price', 'discount', 'images', 'cate_slug', 'type_slug', 'slug']);
        $data['services'] = Services::where('status', 1)->get();
        $data['detail_service'] = Services::where(['slug'=>$slug , 'status'=>1])->first();
        return view('service.detail',$data);
    }

    public function helpCus($slug)
    {
        $data['helpCus'] = PageContent::where(['status'=>1, 'language'=>'vi', 'type'=>'ho-tro-khach-hang','slug'=>$slug])->first();
        $data['news'] = Blog::where(['status'=>1, 'home_status'=>1])->orderBy('id', 'desc')->limit(10)->get(['id', 'title', 'slug', 'image']);
        return view('helpCus', $data);
    }
    public function recruit($slug){
        $data['tuyendung'] = PageContent::where(['status'=>1,'language'=>'vi', 'type'=>'ve-chung-toi','slug'=>$slug])->get(['title','slug','content','image'])->first();
        return view('recruit', $data);
    }
}
