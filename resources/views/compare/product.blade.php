@extends('layouts.main.master')
@section('title')
So sánh sản phẩm thông minh
@endsection
@section('description')
Chức năng so sánh sản phẩm thông minh chỉ có tại icongnghe
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link rel="preload" as="style" type="text/css" href="{{asset('frontend/css/evo-compare.scss.css')}}" />
<link href="{{asset('frontend/css/evo-compare.scss.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
<script src="{{asset('frontend/js/compareProduct.js')}}" type="text/javascript"></script>
@endsection
@section('content')
<section class="bread-crumb">
   <div class="container">
      <ul class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
         <li class="home" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="/" title="Trang chủ">
               <span itemprop="name">Trang chủ</span>
               <meta itemprop="position" content="1">
            </a>
         </li>
         <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <strong itemprop="name">So sánh sản phẩm</strong>
            <meta itemprop="position" content="2">
         </li>
      </ul>
   </div>
</section>
<section class="page margin-top-10 container compare">
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="shadow-sm margin-bottom-10">
            <h1 class="title-head">So sánh sản phẩm</h1>
         </div>
         <div class="shadow-sm margin-bottom-10 fix-padding-mobile" id="compare-list">
            <div class="js-compare-content">
               <div class="compare-product row">
                   @foreach ($list as $item)
                   <div class="compare-item col col-6 col-lg-3 col-md-4 padding-2"></div>
                   <div class="compare-item col col-6 col-lg-3 col-md-4 padding-2">
                      <div class="compage-image"><button class="js-remove-compare" onclick="removeCompare({{$item['idpro']}})" title="Xóa"><span>x</span></button>	<a href="/iphone-12-pro-max-256gb-chinh-hang-vn-a" title="iPhone 12 Pro Max 256GB Chính Hãng (VN/A)">		<img src="//bizweb.dktcdn.net/thumb/large/100/415/483/products/iphone-12-pro-max-xanh-duong-new-600x600-600x600-d4f1f529-b76d-4a27-b5fb-671f597248f9.jpg" alt="iPhone 12 Pro Max 256GB Chính Hãng (VN/A)">	</a></div>
                      <h5><a href="{{route('detailProduct',['id'=>$item['idpro']])}}" title="{{languageName($item['name'])}}">{{languageName($item['name'])}}</a></h5>
                      <div class="group-price">
                          <span class="price"> {{$item['discount']>0 ? number_format($item['price']-($item['price']*($item['discount']/100))) : number_format($item['price'])}}₫</span>	
                          @if ($item['discount']>0)
                          <s class="old-price">{{number_format($item['price'])}}₫</s>
                          @endif
                          
                    </div>
                      <div class="clearfix"></div>
                      <span class="alert-success"> Còn hàng</span>
                   </div>
                   @endforeach
               </div>
               <div class="big-compare-specification">
                  <h2 class="compare-table-title">Cấu hình sản phẩm</h2>
                  <div class="compare-specification row" id="compare-specification">
                    @foreach ($list as $item)
                     <div class="compare-item col col-6 col-lg-3 col-md-4 padding-2">
                        <table id="tskt">
                           <tbody>
                               @php
                                   $size = json_decode($item['size']);
                               @endphp
                               @foreach ($size as $i)
                               <tr style="height: 36px;">
                                    <td>{{$i->title}}</td>
                                    <td>{{$i->detail}}</td>
                                </tr>
                               @endforeach
                           </tbody>
                        </table>
                     </div>
                     @endforeach
                  </div>
                  <div class="compare-specification2 row">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection