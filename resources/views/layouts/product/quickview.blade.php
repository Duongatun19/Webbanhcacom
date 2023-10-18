@php
$image = json_decode($product->images);
$discountPrice = $product['price'] - $product['price'] * ($product['discount'] / 100);
$color = json_decode($product->size);
@endphp
<div id="close-qw" class="quickview-overlay "></div>
<div class="quick-view-product">
   <div class="block-quickview primary_block details-product">
      <div class="row">
         <div class="product-left-column product-images col-xs-12 col-sm-4 col-md-4 col-lg-5 col-xl-6">
            <div class="image-block large-image col_large_default">
               <span class="view_full_size">
               <a class="img-product" title="{{languageName($product->name)}}" href="javascript:;">
               <img src="{{$image[0]}}" id="product-featured-image-quickview" class="img-responsive product-featured-image-quickview" alt="quickview">
               </a>
               </span>
               <div class="loading-imgquickview" style="display:none;"></div>
            </div>
            <div class="more-view-wrapper clearfix">
               <div class="thumbs_quickview owl_nav_custome1 swiper-container thumbs_list_quickview swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" id="thumbs_list_quickview">
                  <ul class="product-photo-thumbs quickview-more-views-owlslider not-thuongdq swiper-wrapper" id="thumblist_quickview" style="transform: translate3d(-111.25px, 0px, 0px); transition-duration: 0ms;">
                     @foreach ($image as $img)
                     <li class="swiper-slide swiper-slide-prev" style="width: 96.25px; margin-right: 15px;"><a href="javascript:void(0)" data-zoom-image="{{$img}}"><img src="{{$img}}" alt="Zomart" style="max-width:120px; max-height:120px;"></a>
                     </li>
                     @endforeach
                  </ul>
                  <div class="swiper-button-prev">
                  </div>
                  <div class="swiper-button-next swiper-button-disabled">
                  </div>
               </div>
            </div>
         </div>
         <div class="product-center-column product-info product-item col-xs-12 col-sm-6 col-md-8 col-lg-7 col-xl-6 details-pro style_product style_border" id="product-27357045">
            <div class="head-qv group-status">
               <h3 class="qwp-name title-product"><a class="text2line" href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}" title="{{languageName($product->name)}}">{{languageName($product->name)}}</a></h3>
               <div class="vend-qv group-status">
                  <div class="left_vend">
                    
                        @if ($product->brand != '')
                        <div class="first_status ">Thương hiệu:
                        <span class="vendor_ status_name">{{ $product->brand->name}}</span>
                     </div>
                        
                        @endif

                   
                  </div>
               </div>
            </div>
            @if ($discountPrice > 0 && $product->price > 0)
            <div class="quickview-info">
               <span class="prices price-box">
               <span class="price product-price sale-price on-sale">{{number_format($discountPrice, 0 ,'', '.')}}₫</span>
               <del class="old-price">{{number_format($product->price, 0 ,'', '.')}}₫</del>
               </span>
            </div>
            @else
            <div class="quickview-info">
               <span class="prices price-box">
                  <a href="tel:{{$setting->phone1}}">
                     <span class="price product-price sale-price on-sale">Liên Hệ</span>
                  </a>
             
              
               </span>
            </div>
            @endif
            <div class="product-description product-summary">
               <div class="rte">
                  {!!languageName($product->description)!!}
               </div>
            </div>
            <form class="quick_option variants form-ajaxtocart form-product" id="product-actions-27357045">
               <span class="price-product-detail d-none" style="opacity: 0;">
               <span class=""></span>
               </span>
             
               <div class="swatch clearfix" >
                  <div class="header">Màu sắc: </div>
                  <input class="variant-0" id="swatch-0-den" type="text" name="color" value="" hidden/>
                  @foreach ($color as $item)
                  @if($item->title != '' && $item->image != '')
            
                  <div  data-value="{{$item->title}}"  class="swatch-element vang available click-color">
                     <div class="tooltip"></div>
                   
                     <img src="{{$item->image}}" alt="{{$item->title}}" class="ant-swatch select-imgs" />
                     <span>{{$item->title}}</span>
                  </div>
                  @else
                  Không có màu sắc
                  @endif
                  @endforeach
               </div>
               @if ($discountPrice > 0 && $product->price > 0)
               <div class="form_product_content">
                  <div class="count_btn_style quantity_wanted_p">
                     <div class=" soluong1 clearfix">
                        <span class="soluong_h">Số lượng:</span>									
                        <div class="sssssscustom input_number_product">
                           <a class="btn_num num_1 button button_qty" onclick="var result = document.getElementById('quantity-detail'); var qtyqv = result.value; if( !isNaN( qtyqv ) &amp;&amp; qtyqv > 1 ) result.value--;return false;">-</a>
                           <input type="text" id="quantity-detail" name="quantity" value="1" maxlength="2" class="form-control prd_quantity" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == 0)this.value=1;">
                           <a class="btn_num num_2 button button_qty" onclick="var result = document.getElementById('quantity-detail'); var qtyqv = result.value; if( !isNaN( qtyqv )) result.value++;return false;">+</a>
                        </div>
                     </div>
                      
                     <div class="button_actions clearfix">
                        <button  class="btn_cool btn btn_base fix_add_to_cart ajax_addtocart btn_add_cart btn-cart add_to_cart add_to_cart_detail" data-url="{{route('addToCart')}}"><span class="btn-content text_1 " >Thêm vào giỏ hàng</span></button>
                     </div>
                  </div>
               </div>
               @endif
               <input type="text" name="id" value="{{$product->id}}" hidden/>
            </form>
         </div>
      </div>
   </div>
   <a title="Close" class="quickview-close close-window" href="javascript:;" onclick="removePopupQickview()">
      <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10">
         <path fill="currentColor" d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z" class=""></path>
      </svg>
   </a>
</div>

<link rel="preload" as="script" href="{{ asset('frontend/js/swiper.js') }}" />
<script src="{{ asset('frontend/js/swiper.js') }}" type="text/javascript"></script>
<script>
   $('.add_to_cart').click(function(e){
      e.preventDefault();
      var id = $('input[name=id]').val();
      var quantity = $('input[name=quantity]').val();
    
      var color = $('input[name=color]').val();
      var url = $(this).data('url');
      $('#quick-view-product').css('display', 'none');
      $.ajax({
         type: "POST",
         url: url,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         data: {'id': id, 'quantity': quantity, 'color': color},
         success: function(data){
            $('.top-cart-content').html(data.html1);
            $('.count_item_pr').html(data.html2);
            $('#popup-cart-desktop').html(data.html3)
            $('.backdrop__body-backdrop___1rvky').addClass('active');
            $('#popup-cart-desktop').addClass('active');
         }
      })
   })
</script>
<script>
   $(document).ready(function(){
           $(".click-color").click(function(){ 
              var color = $(this).data('value');
              $(this).parent().find('input[name=color]').val(color);
              $('.click-color').removeClass('active');
              $(this).addClass('active');
           })});
  </script>
<script>
   function removePopupQickview() {
   $('#quick-view-product').css('display', 'none');
   }
   $('.quickview-overlay ').click(function() {
   $('#quick-view-product').css('display', 'none');
   })
   
</script>
<script>
    $(document).on("click", "#thumblist_quickview li", function() {		
		changeImageQuickView($(this).find("img:first-child"), ".product-featured-image-quickview");
		$('#thumblist_quickview li').removeClass('active');
		$(this).addClass('active');
	});
</script>
<script>
   var swiper = new Swiper('#thumbs_list_quickview', {
   slidesPerView: 4,
   spaceBetween: 15,
   slidesPerGroup: 2,
   pagination: {
   el: '#thumbs_list_quickview .swiper-pagination',
   clickable: true,
   },
   navigation: {
   nextEl: '#thumbs_list_quickview .swiper-button-next',
   prevEl: '#thumbs_list_quickview .swiper-button-prev',
   },
   breakpoints: {
   300: {
       slidesPerView: 'auto',
       spaceBetween: 15
   },
   640: {
       slidesPerView: 3,
       spaceBetween: 15
   },
   768: {
       slidesPerView: 2,
       spaceBetween: 30
   },
   1024: {
       slidesPerView: 3,
       spaceBetween: 30
   },
   1200: {
       slidesPerView: 4,
       spaceBetween: 15
   }
   }
   }); 
</script>