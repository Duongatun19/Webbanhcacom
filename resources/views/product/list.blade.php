@extends('layouts.main.master')
@section('title')
{{$title}}
@endsection
@section('description')
Danh sách {{$title}}
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')

<link href="{{asset('frontend/css/evo-collections.scss.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
@endsection
@section('content')
<section class="bread-crumb margin-bottom-10">
   <div class="container">
      <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
         <li class="home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="/" title="Trang chủ">
               <span itemprop="name">Trang chủ</span>
               <meta itemprop="position" content="1" />
            </a>
            <span><i class="fa fa-angle-right"></i></span>
         </li>
         <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <strong itemprop="name">{{$title}}</strong>
            <meta itemprop="position" content="2" />
         </li>
      </ul>
   </div>
</section>
<div class="container">
   <div class="row">
      <aside class="sidebar left-content col-md-3 col-sm-12 col-xs-12">
         <aside class="aside-item collection-category hidden-sm hidden-xs">
            <div class="aside-title">Danh mục</div>
            <div class="aside-content">
               <ul class="nav navbar-pills nav-category">
                  @foreach ($categoryProduct as $cate)
                     <li class="nav-item">
                        <a class= "nav-link" href="{{route('allListProCate',['cate'=>$cate->slug])}}">{{languageName($cate->name)}}</a>
                     </li>
                  @endforeach
               </ul>
            </div>
         </aside>
         <script src="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/search_filter.js?1663905428530" type="text/javascript"></script>
      </aside>
      <section class="main_container collection col-md-9 col-sm-12 col-xs-12">
         <div class="category-products products category-products-grids clearfix">
            <div class="sort-cate clearfix ">
             
            <section class="products-view products-view-grid row">
               @foreach ($list as $product)
               @php
                  $img = json_decode($product->images);
                  $discountprice = $product->price -($product->price * $product->discount/100);
               @endphp
                  <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                     <div class="evo-product-block-item">
                        <div class="product-thumb">
                           <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">
                           <img class="lazy" src="{{$img[0]}}" data-src="{{$img[0]}}" alt="{{languageName($product->name)}}" />
                           </a>
                           @if ($product->discount > 0)
                              <div class="label_product"><span class="label_sale"> {{$product->discount}}% </span></div>
                           @endif
                        </div>
                        @if($product->discount >0 && $product->price >0)
                           <div class="product-content">
                              
                              <div class="product-desc">
                                 <a class="product-title" href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">{{languageName($product->name)}}</a>
                                 <span class="product-price">
                                 <del>{{number_format($product->price,0,'','.')}}₫</del>
                                 {{number_format($discountprice,0,'','.')}}₫
                                 </span>
                              </div>

                              <form  class="product-shopping hidden-sm hidden-xs hidden-md variants form-nut-grid form-ajaxtocart" >
                                 <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}">
                                 <button  title="Tùy chọn" type="button" class="action cart-button option-icons">Xem chi tiết</button>
                                 </a>
                                
                              </form>
                           </div>
                        @elseif($product->price > 0 && $product->discount == 0)
                              <div class="product-content">
                                    
                                 <div class="product-desc">
                                    <a class="product-title" href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">{{languageName($product->name)}}</a>
                                    <span class="product-price">
                                    {{number_format($product->price,0,'','.')}}₫
                                    </span>
                                 </div>

                                 <form  class="product-shopping hidden-sm hidden-xs hidden-md variants form-nut-grid form-ajaxtocart" >
                                    <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}">
                                    <button  title="Tùy chọn" type="button" class="action cart-button option-icons">Xem chi tiết</button>
                                    </a>
                                   
               
                                 </form>
                              </div>
                        @else
                        <div class="product-content">
                                    
                           <div class="product-desc">
                              <a class="product-title" href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">{{languageName($product->name)}}</a>
                              <span class="product-price">
                              Liên hệ
                              </span>
                           </div>

                           <form  class="product-shopping hidden-sm hidden-xs hidden-md variants form-nut-grid form-ajaxtocart" >
                              <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}">
                              <button  title="Tùy chọn" type="button" class="action cart-button option-icons">Xem chi tiết</button>
                              </a>
                           </form>
                        </div>
                        @endif
                     </div>
                  </div>
               @endforeach
               <div class="clearfix"></div>
            </section>
         </div>
      </section>
   </div>
</div>

@endsection