<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\blog\Blog;
use App\models\product\Category;
use App\models\blog\BlogCategory;
use App\models\blog\BlogTypeCate;
use App\models\construction\Construction;
use App\models\product\Product;
use Session;

class BlogController extends Controller
{
    public function list()
    {
        $data['blogs'] = Blog::where(['status'=>1])
        ->orderBy('id','DESC')
        ->select(['id','title','image','description','updated_at','slug'])
        ->paginate(10);
        $data['news'] = Blog::where(['status'=>1, 'home_status'=>1])->orderBy('id', 'desc')->limit(10)->get(['id', 'title', 'slug', 'image']);
        $data['title_page'] = 'Tất cả tin tức';
        $data['categoryBlog'] = BlogCategory::with([
            'listBlog' => function ($query){
                $query->where(['status'=>1])->paginate(10);
            }
        ])
        ->where('status',1)
        ->orderBy('id','asc')
        ->get(['id','name','slug','avatar']);
        return view('blog.list',$data);
    }
    public function listCateBlog($slug)
    {
        $data['news'] = Blog::where(['status'=>1])->orderBy('id', 'desc')->limit(5)->get(['id', 'title', 'slug', 'image']);
        $data['discountPro'] = Product::where('status', 1)->where('discount', '>', 0)->limit(5)->get(['id', 'name', 'price', 'discount', 'images', 'cate_slug', 'type_slug', 'slug']);
        $data['blogs'] = Blog::where(['status'=>1,'category'=>$slug])
        ->orderBy('id','DESC')
        ->select(['id','title','image','description','updated_at','slug'])
        ->paginate(12);
        $data['cate'] = BlogCategory::where('slug', $slug)->first(['name']);
        $data['title_page'] = languageName($data['cate']->name);
        return view('blog.list',$data);
    }
    public function listTypeBlog($slug)
    {
        $data['blogs'] = Blog::where(['status'=>1,'type_cate'=>$slug])
        ->orderBy('id','DESC')
        ->select(['id','title','image','description','created_at','slug'])
        ->paginate(12);
        $data['cate'] = BlogTypeCate::where('slug', $slug)->first(['name']);
        $data['title_page'] = languageName($data['cate']->name);
        return view('blog.list',$data);
    }
    public function detailBlog($slug)
    {
        $data['blog_detail'] = Blog::with('cate')->where(['slug' => $slug])->first();
 
        $data['blogs'] = Blog::where(['status'=>1])
        ->orderBy('id','DESC')
        ->select(['id','title','image','description','created_at','slug'])
        ->paginate(12);
        $data['news'] = Blog::where(['status'=>1, 'home_status'=>1])->orderBy('id', 'desc')->limit(10)->get(['id', 'title', 'slug', 'image']);
        $data['discountPro'] = Product::where('status', 1)->where('discount', '>', 0)->limit(5)->get(['id', 'name', 'price', 'discount', 'images', 'cate_slug', 'type_slug', 'slug']);
        return view('blog.detail',$data);
    }
    public function search_blog(Request $request)
    {
        $keyword = $request->keyword;
        $code = Session::get('locale');
        $arr = [];
        $arrb = [];
        $arrOpt = [];
        //search option
        $productOpt =  Blog::where('status',1)
        ->get(['title','image','description','created_at','slug'])
        ->toArray();
        foreach($productOpt as $key => $item){
            $fielName = json_decode($item['title']);
            foreach($fielName as $i){
                if(strpos(strtolower(stripVN($i->content)), strtolower(stripVN($keyword))) !== false && $i->lang_code == $code){
                    array_push($arr,$productOpt[$key]);
                }
            }
        }
        $data['keyword'] = $request->keyword;
        $data['countproduct'] = count($arr);
        $data['resultPro'] = $arr;
        return view('search_result',$data);
    }

    public function getTabBlog(Request $request)
    {
        $id = $request->id;
        $data['cate'] = BlogCategory::findOrFail($id);
        $data['blogs'] = Blog::where(['status'=>1,'category'=>$data['cate']->slug])
        ->orderBy('id','DESC')->get(['id','title','image','description','created_at','slug']);
        $html = view('layouts.blog.ajax-tab-blog', $data)->render();
        return response()->json(['hm'=>$html]);
    }
}
