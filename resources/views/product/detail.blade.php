@extends('layouts.main.master')
@section('title')
{{languageName($product->name)}}
@endsection
@section('description')

@endsection
@section('image')
@php
$imgs = json_decode($product->images);
$discountprice = $product->price - ($product->price * $product->discount/100);
$color = json_decode($product->size);
$promotion =  json_decode($product->preserve);
@endphp
{{url(''.$imgs[0])}}
@endsection
@section('css')
<link href="{{asset('frontend/picbox.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('frontend/css/evo-products.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
<script src="{{asset('frontend/js/picbox.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/js/cart.min.js')}}"></script>	   
@endsection
@section('content')
<link href="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/picbox.scss.css?1663905428530" rel="stylesheet" type="text/css" media="all" />
<script src="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/picbox.js?1663905428530" type="text/javascript"></script>	
<section class="bread-crumb margin-bottom-10">
   <div class="container">
      <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
         <li class="home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{route('home')}}" title="Trang chủ">
               <span itemprop="name">Trang chủ</span>
               <meta itemprop="position" content="1" />
            </a>
            <span><i class="fa fa-angle-right"></i></span>
         </li>
         <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="" title="{{languageName($product->cate->name)}}">
               <span itemprop="name">{{languageName($product->cate->name)}}</span>
               <meta itemprop="position" content="2" />
            </a>
            <span><i class="fa fa-angle-right"></i></span>
         </li>
         <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name">{{languageName($product->name)}}</span>
            <meta itemprop="position" content="3" />
         </li>
      </ul>
   </div>
</section>
<section class="product margin-top-30" itemscope itemtype="http://schema.org/Product">

   <div class="container">
      <div class="row details-product padding-bottom-10">
         <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 product-bottom">
            <div class="row">
               <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
                  <div class="relative product-image-block">
                     <div class="slider-big-video clearfix margin-bottom-10">
                        <div class="slider slider-for">
                           @foreach ($imgs as $item)
                           <a href="{{$item}}" title="Click để xem">
                              <img src="{{$item}}" data-lazy="{{$item}}" alt="" data-image="{{$item}}" class="img-responsive center-block">
                              </a>
                           @endforeach
                        </div>
                     </div>
                     <div class="slider-has-video clearfix">
                        <div class="slider slider-nav">
                           @foreach ($imgs as $item)
                              <div class="fixs">
                                 <img class="lazy" src="{{$item}}" data-src="{{$item}}" alt="" data-image="{{$item}}" />
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               @if ($product->price > 0)
                  <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 details-pro">
                     <div class="product-top clearfix">
                        <h1 class="title-head">{{languageName($product->name)}}</h1>
                        <div class="sku-product clearfix">
                        </div>
                     </div>
                     <div>
                        <div class="price-box clearfix">
                           <div class="special-price">
                              <span class="price product-price">{{number_format($discountprice,0,'','.')}}₫&nbsp;&nbsp;<del style="color: rgb(94, 90, 90)">{{number_format($product->price,0,'','.')}}₫</del></span>
                           </div>
                           <!-- Giá -->
                        </div>
                        <div class="inventory_quantity">
                           <span class="stock-brand-title">Tình trạng:</span>
                           <span class="a-stock a2">Còn hàng</span>
                        </div>
                        <div class="evo-product-summary product_description margin-bottom-10">
                           <a class="evo-product-tabs-header hidden-lg hidden-md" href="javascript:void(0);">
                           
                              <svg xmlns="http://www.w3.org/2000/svg" width="5.658" height="9.903" viewBox="0 0 5.658 9.903">
                                 <path d="M5429 1331.94l4.451 4.451-4.451 4.452" stroke="#1c1c1c" stroke-linecap="round" fill="none" transform="translate(-5428.5 -1331.44)"></path>
                              </svg>
                           </a>
                           <div class=" limit-text-2">
                              {!!languageName($product->description)!!}
                           </div>
                        </div>
                     </div>
                     <div class="form-product">
                        <form  class="clearfix form-inline">
                           <div class="box-variant clearfix  hidden ">
                              <input type="hidden" name="variantId" value="27698917" />
                           </div>
                           <div class="clearfix form-group ">
                              <div class="qty-ant clearfix custom-btn-number">
                                 <label>Số lượng:</label>
                                 <div class="custom custom-btn-numbers form-control">		
                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty) & qty > 1 ) result.value--;return false;" class="btn-minus btn-cts" type="button">–</button>
                                    <input type="text" class="qty input-text" id="qty" name="quantity" size="4" value="1" maxlength="3" />
                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN(qty)) result.value++;return false;" class="btn-plus btn-cts" type="button">+</button>
                                 </div>
                              </div>
                              <div class="btn-mua">
                                 <input type="text" name="id" value="{{$product->id}}" class="hidden-ip" hidden/>
                                 <button  class=" add_tocart button-custom-new" data-url="{{route('addToCart')}}"><span class="txt-sub">&nbsp;</span><span class="txt-main">THÊM VÀO GIỎ</span><span class="txt-sub">&nbsp;</span></button>
                              </div>
                           </div>
                        </form>
                     </div>
               
                  </div>
               @else
                  <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 details-pro">
                     <div class="product-top clearfix">
                        <h1 class="title-head">{{languageName($product->name)}}</h1>
                        <div class="sku-product clearfix">
                        </div>
                     </div>
                     <div>
                        <div class="price-box clearfix">
                           <div class="special-price">
                              Liên Hệ
                           </div>
                           <!-- Giá -->
                        </div>
                        <div class="inventory_quantity">
                           <span class="stock-brand-title">Tình trạng:</span>
                           <span class="a-stock a2">Còn hàng</span>
                        </div>
                        <div class="evo-product-summary product_description margin-bottom-10">
                           <a class="evo-product-tabs-header hidden-lg hidden-md" href="javascript:void(0);">
                           
                              <svg xmlns="http://www.w3.org/2000/svg" width="5.658" height="9.903" viewBox="0 0 5.658 9.903">
                                 <path d="M5429 1331.94l4.451 4.451-4.451 4.452" stroke="#1c1c1c" stroke-linecap="round" fill="none" transform="translate(-5428.5 -1331.44)"></path>
                              </svg>
                           </a>
                           <div class=" limit-text-2">
                              {!!languageName($product->description)!!}
                           </div>
                        </div>
                     </div>
                     <div class="form-product">
                        <form  class="clearfix form-inline">
                           <div class="box-variant clearfix  hidden ">
                              <input type="hidden" name="variantId" value="27698917" />
                           </div>
                           <div class="clearfix form-group ">
                         
                              <div class="btn-mua">
                                 <a href="tel:{{$setting->phone1}}">
                                    <h2 style="color: red">
                                       Liên Hệ
                                    </h2>
                                 </a>
                              </div>
                           </div>
                        </form>
                     </div>
               
                  </div>
               @endif
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-top-20">
            <div class="product-tab e-tabs padding-bottom-10 evo-tab-product-mobile">
               <ul class="tabs tabs-title clearfix hidden-xs">
                  <li class="tab-link" data-tab="tab-1">Mô tả</li>
                  <li class="tab-link" data-tab="tab-2">Giới thiệu</li>
               </ul>
               <div id="tab-1" class="tab-content active">
                  <a class="evo-product-tabs-header hidden-lg hidden-md hidden-sm" href="javascript:void(0);">
                     <span>Mô tả</span>
                     <svg xmlns="http://www.w3.org/2000/svg" width="5.658" height="9.903" viewBox="0 0 5.658 9.903">
                        <path d="M5429 1331.94l4.451 4.451-4.451 4.452" stroke="#1c1c1c" stroke-linecap="round" fill="none" transform="translate(-5428.5 -1331.44)"></path>
                     </svg>
                  </a>
                  <div class="rte">
                    {!!languageName($product->content)!!}
                  </div>
               </div>
               <div id="tab-2" class="tab-content">
                  <a class="evo-product-tabs-header hidden-lg hidden-md hidden-sm" href="javascript:void(0);">
                     <span>Giới thiệu</span>
                     <svg xmlns="http://www.w3.org/2000/svg" width="5.658" height="9.903" viewBox="0 0 5.658 9.903">
                        <path d="M5429 1331.94l4.451 4.451-4.451 4.452" stroke="#1c1c1c" stroke-linecap="round" fill="none" transform="translate(-5428.5 -1331.44)"></path>
                     </svg>
                  </a>
                  <div class="rte">
                    {!!languageName($product->description)!!}
                  </div>
               </div>
            </div>
            
         </div>
      </div>
      @if (count($productlq) > 1)
         <div class="row margin-top-10 margin-bottom-10">
            <div class="col-lg-12">
               <div class="related-product product-white-bg">
                  <div class="home-title text-center">
                     <h2><a  title="Sản phẩm liên quan">Sản phẩm liên quan</a></h2>
                  </div>
                  <div class="evo-owl-product clearfix">
                  
                     @foreach ($productlq as $pro)
                     @if ($product->id != $pro->id)
                     @php
                        $imgs = json_decode($pro->images);
                        $discountprice = $pro->price - ($pro->price * $pro->discount/100);
                     @endphp
                  
                        <div class="evo-slick">
                           <div class="evo-product-block-item">
                              <div class="product-thumb">
                                 <a href="{{route('detailProduct',['cate'=>$pro->cate_slug,'slug'=>$pro->slug])}}" title="{{languageName($pro->name)}}">
                                 <img class="lazy" src="{{$imgs[0]}}" data-src="{{$imgs[0]}}" alt="{{languageName($pro->name)}}" />
                                 </a>
                                 @if ($pro->discount)
                                    <div class="label_product"><span class="label_sale"> {{$pro->discount}}% </span></div> 
                                 @endif
                              </div>
                              <div class="product-content">
                                 <div class="product-desc">
                                    <a class="product-title" href="{{route('detailProduct',['cate'=>$pro->cate_slug,'slug'=>$pro->slug])}}" title="{{languageName($pro->name)}}">{{languageName($pro->name)}}</a>
                                    <span class="product-price">
                                    <del>{{number_format($pro->price,0,'','.')}}₫</del>
                                    {{number_format($discountprice,0,'','.')}}₫
                                    </span>
                                 </div>
                                 <form  class="product-shopping hidden-sm hidden-xs hidden-md variants form-nut-grid form-ajaxtocart" data-id="product-actions-15835385">
                                    <a href="{{route('detailProduct',['cate'=>$pro->cate_slug,'slug'=>$pro->slug])}}">
                                    <button title="Tùy chọn" type="button"class="action cart-button option-icons">Xem chi tiết</button>
                                 </a>
                                 </form>
                              </div>
                           </div>
                        </div>
                     @endif
                     @endforeach
                   
                  </div>
               </div>
            </div>
         </div>
      @endif
   </div>
</section>
<script>
   $(document).on('click', '.btn-buy-now-click', function(e) {
   	e.preventDefault();
   	$('[data-role=addtocart]').click();
   });
   $('.evo-owl-product').slick({
   	dots: true,
   	arrows: false,
   	infinite: false,
   	speed: 300,
   	slidesToShow: 5,
   	slidesToScroll: 5,
   	responsive: [
   		{
   			breakpoint: 1024,
   			settings: {
   				slidesToShow: 5,
   				slidesToScroll: 5
   			}
   		},
   		{
   			breakpoint: 991,
   			settings: {
   				slidesToShow: 3,
   				slidesToScroll: 3
   			}
   		},
   		{
   			breakpoint: 767,
   			settings: {
   				slidesToShow: 3,
   				slidesToScroll: 3
   			}
   		},
   		{
   			breakpoint: 480,
   			settings: {
   				slidesToShow: 2,
   				slidesToScroll: 2
   			}
   		}
   	]
   });
   $('.slider-nav').slick({
   	slidesToShow: 5,
   	slidesToScroll: 1,
   	asNavFor: '.slider-for',
   	dots: false,
   	centerMode: false,
   	infinite: false,
   	focusOnSelect: true,
   	responsive: [
   		{
   			breakpoint: 1025,
   			settings: {
   				slidesToShow: 4,
   				slidesToScroll: 1
   			}
   		},
   		{
   			breakpoint: 991,
   			settings: {
   				slidesToShow: 4
   			}
   		},
   		{
   			breakpoint: 480,
   			settings: {
   				slidesToShow: 4
   			}
   		}
   	]
   });
   $('.slider-for').slick({
   	slidesToShow: 1,
   	slidesToScroll: 1,
   	arrows: false,
   	lazyLoad: 'ondemand',
   	fade: true,
   	infinite: false,
   	asNavFor: '.slider-nav',
   	adaptiveHeight: false,
   	responsive: [
   		{
   			breakpoint: 480,
   			settings:{
   				dots: true
   			}
   		}
   	]
   });
   $('.slider-big-video .slider-for a').each(function() {
   	$(this).attr('rel','lightbox-demo'); 
   });
   
</script>


@endsection








