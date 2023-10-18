@extends('layouts.main.master')
@section('title')
    {{ $setting->company }}
@endsection
@section('description')
    {{ $setting->webname }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image) }}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')

<section class="awe-section-1">
   <div class="home-slider">
      @foreach ($banners as $banner)
      <div class="item">
      
            <picture>
               <source 
                     media="(min-width: 1200px)"
                     srcset="{{$banner->image}}">
               <source 
                     media="(min-width: 992px)"
                     srcset="{{$banner->image}}">
               <source 
                     media="(min-width: 569px)"
                     srcset="{{$banner->image}}">
               <source 
                     media="(min-width: 480px)"
                     srcset="{{$banner->image}}">
               <img 
                     src="{{$banner->image}}" 
                     alt="" class="lazy img-responsive center-block" />
            </picture>
         
      </div>
      @endforeach
   </div>
</section>
{{-- hết banner --}}
<section class="awe-section-4">
   <div class="section_san_pham">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlecp clearfix text-center">
                  <h3><a href="san-pham-moi" title="Sản phẩm bán chạy">Danh Mục Sản Phẩm</a></h3>
                  <p></p>
               </div>
               <div class="evo-index-product-contain  wow fadeInUp">
                  <div class="evo-block-product-slick">
                     @foreach ($categoryProduct as $cate )
                        <div class="evo-product-block-item">
                           <div class="product-thumb">
                              <a href="{{route('allListProCate',['cate'=>$cate->slug])}}" title="{{languageName($cate->name)}}">
                              <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$cate->avatar}}" alt="{{languageName($cate->name)}}" />
                              </a>
                             
                           </div>
                           <div class="product-content">
                              <div class="product-desc">
                                 <a class="product-title" href="{{route('allListProCate',['cate'=>$cate->slug])}}" title="{{languageName($cate->name)}}">{{languageName($cate->name)}}</a>
                                 
                              </div>
                              <form  enctype="multipart/form-data" class="product-shopping hidden-sm hidden-xs hidden-md variants form-nut-grid form-ajaxtocart" data-id="product-actions-15835385">
                                 <a href="{{route('allListProCate',['cate'=>$cate->slug])}}">
                                    <button title="Xem tất cả" type="button" class="action cart-button option-icons">Xem Tất cả</button>
                                 </a>
                              </form>
                           </div>
                        </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
{{-- end section category_product --}}
<section class="awe-section-3">
   <div class="section_about">
      <div class="container-fluid">
         <div class="row fix-flex">
            <div class="col-md-6 col-sm-6 col-xs-12 fix-padding">
               <div class="about-image ">
                  <img class="lazy  "src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$gioithieu->image}}" />
               </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 fix-padding-right">
               <div class="about-content">
                  <h3><span>{{$gioithieu->title}}</span></h3>
                  <p >
                     <div class="limit-text-9">{!!$gioithieu->content!!}</div>
                  </p>
                  <a href="{{route('aboutUs')}}" title="Xem thêm">Xem thêm</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
{{-- end section giới thiệu --}}
<section class="awe-section-5">
   <div class="row">
      <div class="col-md-12 text-center">
         <h3 class="gift-title"><a href="https://bepcacom.com/tat-ca-san-pham.html" title="Sản phẩm nổi bật">Danh sách sản phẩm</a></h3>
         <p>Một số sản phẩm của cửa hàng !</p>
         </div>
   </div>
   <div class="section_gift " data-src="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/evo_gift_bg.jpg?1663905428530">
      <div class="container">
         <section class="main_container collection col-md-12 col-sm-12 col-xs-12">
            <div class="category-products products category-products-grids clearfix">
               <div class="sort-cate clearfix ">
                
               <section class="products-view products-view-grid row">
                  @foreach ($allproducts as $product)
                  @php
                     $img = json_decode($product->images);
                     $discountprice = $product->price -($product->price * $product->discount/100);
                  @endphp
                     <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 pd">
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
</section>
{{-- <section class="awe-section-5">
   <div class="section_gift " data-src="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/evo_gift_bg.jpg?1663905428530">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center">
               <h3 class="gift-title"><a href="{{route('allProduct')}}" title="Sản phẩm nổi bật">Danh sách sản phẩm</a></h3>
               <p>Một số sản phẩm của cửa hàng !</p>
            </div>
         </div>
         <div class="row gift-gallery">
            @foreach ($bannerPhu as $banner)
            <div class="col-md-3 col-sm-3 col-xs-6">
               <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$banner->image}}" alt="Evo Cake" />
            </div>
            @endforeach
         </div>
         <div class="row gift-list-product">
            @foreach ($allproducts as $product)
                     @php
                         $discountprice = $product->price - ($product->price * $product->discount/100);
                         $img = json_decode($product->images);
                     @endphp
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="evo-product-slide-item">
                  <div class="product-img">
                     @if ($product->discount > 0)
                        <div class="label_product"><span class="label_sale"> {{$product->discount}}%</span></div>
                     @endif
                     <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}" class="image-resize">
                     <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$img[0]}}" alt="{{languageName($product->name)}}" />
                     </a>
                  </div>
                  <div class="product-detail clearfix">
                     <h3 class="pro-name">
                        <a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">{{languageName($product->name)}}</a>
                     </h3>
                     @if($product->price > 0 && $product->discount>0)
                        <div class="box-pro-prices">
                           <p class="pro-price">
                           {{number_format($discountprice,0,'','.')}}₫
                              <span class="pro-price-del">
                              <del class="compare-price"> {{number_format($product->price,0,'','.')}}₫</del>
                              </span>
                           </p>
                        </div>
                     @elseif($product->price > 0 && $product->discount==0)
                        <div class="box-pro-prices">
                           <p class="pro-price">
                           {{number_format($product->price,0,'','.')}}₫
                           </p>
                        </div>
                     @else
                        <div class="box-pro-prices">
                           <a href="tel:{{$setting->phone1}}">
                           <p class="pro-price">
                           Liên hệ
                           </p>
                           </a>
                        </div>
                     @endif
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section> --}}
{{-- end section sản phẩm --}}
<section class="awe-section-4">
   <div class="bg-custom">
      <img src="{{asset('frontend/images/banh-dua-dai-loan-ngon.png')}}" alt="" srcset="">
   </div>
   <div class="section_san_pham maunen">
      
      <div class="container">
        
         <div class="row">
            <div class="col-md-6">
               <div class="titlecp clearfix text-center">
                  <h3><a href="{{route('allProduct')}}" title="Sản phẩm bán chạy">FeedBack Khách Hàng</a></h3>
                 
               </div>
               <div class="evo-index-product-contain">
                  <div class="evo-block-product-slick-new">
                   
                    @foreach ($reviews as $item)
                    <div class="evo-product-block-item maunen">
                       <div class="product-thumb custom-fb">
                        <div class="form-fb">
                          <div class="ctimg">
                             <img src="{{$item->avatar}}" alt="" srcset="">
                           </div>
                           <div class="name-kh">
                              {{languageName($item->name)}}
                          </div>
                          <div class="content-fb">
                            <i>{!!languageName($item->content)!!}</i>
                          </div>
                          <div class="svg-fb">
                           <svg style="color: white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="50px" height="50px"><path d="M96 96C42.98 96 0 138.1 0 192s42.98 96 96 96c11.28 0 21.95-2.305 32-5.879V288c0 35.3-28.7 64-64 64c-17.67 0-32 14.33-32 32s14.33 32 32 32c70.58 0 128-57.42 128-128V192C192 138.1 149 96 96 96zM448 192c0-53.02-42.98-96-96-96s-96 42.98-96 96s42.98 96 96 96c11.28 0 21.95-2.305 32-5.879V288c0 35.3-28.7 64-64 64c-17.67 0-32 14.33-32 32s14.33 32 32 32c70.58 0 128-57.42 128-128V192z"></path></svg>
                          </div>
                          <div class="lopphu"></div>
                       </div>
                       </div>
                    </div>
                    @endforeach
               
                  </div>
               </div>
            </div>
            <div class="col-md-6">

            </div>
         </div>
      </div>
   </div>
</section>
{{-- end section feeedback --}}
<section class="awe-section-6">
   <div class="container section_blogs">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h3 class="new_title"><a href="{{route('allListBlog')}}" title="Tin ẩm thực">Tin Khuyến mãi Hàng tuần</a></h3>
               <div class="evo-owl-blog evo-slick">
                  @foreach ($blogs as $blog)
                     <div class="news-items">
                        <div class="clearfix evo-item-blogs">
                           <div class="evo-article-image">
                              <a href="{{route('detailBlog',['slug'=>$blog->slug])}}">
                                 <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$blog->image}}" alt="" class="lazy img-responsive center-block" />
                                 <div class="blog-date">{{ $blog->updated_at->format('d/m/Y')}}</div>
                              </a>
                           </div>
                           <div class="evo-article-content">
                              <h3 class="line-clamp"><a href="{{route('detailBlog',['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a></h3>
                              <p class="limit-text-5">
                              {{languageName($blog->description)}}
                              </p>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
{{-- end section tin khuyến mãi hàng tuần --}}
<script>
   $(document).ready(function(){
       var name_pro = '';
       var alias_pro = '';
       var featured_image_pro = '';
       var url_pro = '';
       var variant_id_pro = '';
       
       var price_pro = 'Liên hệ';
       
       
       var price_sale_pro = '';
       var hasSale_pro = 'false';
       var percent_sale_pro = '';
       
       var array_list = [{
           'name':name_pro,'alias':alias_pro,'featured_image':featured_image_pro,'url':url_pro,'variant_id':variant_id_pro,'price':price_pro,'compare_at_price':price_sale_pro,'hasSale':hasSale_pro,'percent_sale':percent_sale_pro
       }];
       var list_viewed_pro_old = localStorage.getItem('last_viewed_products');
       var last_viewed_pro_new = "";
       if(list_viewed_pro_old == null || list_viewed_pro_old == '')
           last_viewed_pro_new = array_list;
       else{
           var list_viewed_pro_old = JSON.parse(localStorage.last_viewed_products);
           list_viewed_pro_old.splice(20, 1);
           for (i = 0; i < list_viewed_pro_old.length; i++) {
               if ( list_viewed_pro_old[i].alias == alias_pro ) {
                   list_viewed_pro_old.splice(i,1);
                   break;
               }
           }
           list_viewed_pro_old.unshift(array_list[0]);
           last_viewed_pro_new = list_viewed_pro_old;
       }
       localStorage.setItem('last_viewed_products',JSON.stringify(last_viewed_pro_new));
       var last_viewd_pro_array = JSON.parse(localStorage.last_viewed_products);
   
       var size_pro_review = last_viewd_pro_array.length;
       if ( size_pro_review >= 14 ) {
           size_pro_review = 14;
       } else {
           size_pro_review = last_viewd_pro_array.length;
       }
       if (size_pro_review < 2 ) {
           jQuery('.recent_products-row').addClass('hidden');
       }else{
           jQuery('.no-recently').addClass('hidden');
       }
       if (size_pro_review > 0 ) {
           for (i = 0; i < size_pro_review; i++){
               var alias_product = last_viewd_pro_array[i];
               if (!!alias_product.alias){
                   Ant.clone_item_view(alias_product);
               }
           }
       }
       $('#recent-content').slick({
           dots: true,
           arrows: false,
           infinite: false,
           speed: 300,
           slidesToShow: 10,
           slidesToScroll: 10,
           responsive: [
               {
                   breakpoint: 1024,
                   settings: {
                       slidesToShow: 10,
                       slidesToScroll: 10
                   }
               },
               {
                   breakpoint: 991,
                   settings: {
                       slidesToShow: 7,
                       slidesToScroll: 7
                   }
               },
               {
                   breakpoint: 767,
                   settings: {
                       slidesToShow: 5,
                       slidesToScroll: 5,
                       dots: true
                   }
               },
               {
                   breakpoint: 480,
                   settings: {
                       slidesToShow: 3,
                       slidesToScroll: 3,
                       dots: true
                   }
               }
           ]
       });
   });
</script>
@endsection
