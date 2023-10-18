<?php

namespace App\Providers;

use App\models\BannerAds;
use App\models\blog\Blog;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Session,View;
use App\models\website\Setting;
use App\models\website\Banner;
use Cart,Auth;
use App\models\PageContent;
use Laravel\Dusk\DuskServiceProvider;
use App\models\product\Category;
use App\models\language\Language;
use App\models\Province;
use App\models\Services;
use App\models\Promotion;
use App\models\blog\BlogCategory;
use App\models\product\Product;
use App\models\product\ProductBrands;
use App\models\product\TypeProduct;
use App\models\ReviewCus;
use App\models\website\Partner;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            if(Auth::guard('customer')->user() != null){
                $profile = Auth::guard('customer')->user();
            }else{
                $profile = "";
            } 
            $language_current = Session::get('locale');
            $reviews = ReviewCus::where('status', '1')->orderBy('id','DESC')->get();
            $promotio = Promotion::where('status',1)->orderBy('id','DESC')->get();
            $servicehome = Services::where('status',1)->orderBy('id','asc')->get();
            $setting = Setting::first();
            $lang = Language::get();
            $typeCate = TypeProduct::where('status',1)->orderBy('id','asc')->get(['name','slug','cate_slug']);
            $categoryProduct = Category::with([
                'typeCate' => function ($query) {
                    $query->with(['typetwo'])->where('status',1)->orderBy('id','DESC')->select('cate_id','id', 'name','avatar','slug','cate_slug'); 
                }
            ])->where('status',1)->orderBy('id','asc')->get(['id','name','imagehome','avatar','slug'])->map(function ($query) {
                $query->setRelation('product', $query->product->where('status', '=', 1)->take(14));
                return $query;
            });
            $allproducts = Product::where('status', '=', 1)->get();
            $productBrands = ProductBrands::where('status', 1)->get();
            $bannerAds = BannerAds::where('status',2)->get(['name','image','id']);
         
            $bannerPhu = Banner::where(['status'=>2])->limit(4)->get(['id','image','link','title','description']);
            $banners = Banner::where(['status'=>1])->get(['id','image','link','title','description']);
            $cartcontent = session()->get('cart', []);
            $viewold = session()->get('viewoldpro', []);
            $compare = session()->get('compareProduct', []);
            $blogs = Blog::orderby('id','desc')->where(['status'=>1])->get();
            $blogCate = BlogCategory::with([
                'typeCate' => function ($query){
                    $query->select('id','slug','name','avatar','category_slug');
                },
                'listBlog' => function ($query){
                    $query->where(['status'=>1, 'home_status'=>1])->get();
                }
            ])
            ->where('status',1)
            ->orderBy('id','desc')
            ->get(['id','name','slug','avatar']);
            $hotBlogs = Blog::where([
                'status'=>1, 'home_status'=>1
            ])->orderBy('id','DESC')->get(['id','title','slug','image','description','updated_at']);
            $hotProduct = Product::where(['status'=>1, 'discountStatus'=>1])->limit(8)->get(['id', 'name', 'cate_slug', 'slug','images','price','discount']);
            $gioithieu = PageContent::where(['status'=>1,'language'=>'vi', 'type'=>'ve-chung-toi'])->first(['title','slug','content','image']);
            $tuyendung = PageContent::where(['status'=>1,'language'=>'vi', 'type'=>'ho-tro-khach-hang','slug'=>'tuyen-dung'])->first(['title','slug','content','image']);
            $helpCustomer = PageContent::where(['status'=>1,'language'=>'vi', 'type'=>'ho-tro-khach-hang'])->get(['title','slug']);

            $partners = Partner::where(['status'=>1])->get(['id','image','name','link']);
            $view->with([
                'promotio' => $promotio,
                'setting' => $setting,
                'lang' => $lang,
                'banners'=>$banners,
                'profile' =>$profile,
                'categoryProduct'=> $categoryProduct,
                'cartcontent'=>$cartcontent,
                'viewold'=>$viewold,
                'compare'=>$compare,
                'blogCate'=>$blogCate,
                'servicehome'=>$servicehome,
                'hotBlogs'=>$hotBlogs,
                'hotProduct'=>$hotProduct,
                'productBrands'=>$productBrands,
                'helpCustomer'=>$helpCustomer,
                'bannerAds'=>$bannerAds,
                'partners'=>$partners,
                'bannerPhu'=> $bannerPhu,
                'typeCate'=> $typeCate,
                'gioithieu'=> $gioithieu,
                'allproducts'=> $allproducts,
                'blogs'=> $blogs,
                'reviews' => $reviews,
                'tuyendung'=> $tuyendung,
                ]);    
        });  
    }
}
