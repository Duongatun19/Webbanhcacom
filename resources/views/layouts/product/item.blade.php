
@php
$img = json_decode($product->images);
$discountPrice = $product->price - ($product->price * ($product->discount / 100));
@endphp
<div class="item_product_main">
   <form 
       class="variants product-action " data-cart-form
       data-id="product-actions-27357045" enctype="multipart/form-data">
       <div class="product-thumbnail">
           <a class="image_thumb scale_hover"
               href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}"
               title="iPhone 13 Pro Max 256GB">
               <img class="lazyload"
                   src="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA="
                   data-src="{{$img[0]}}"
                   alt="iPhone 13 Pro Max 256GB">
           </a>
           @if ($product->discount > 0)
           <span class="smart">-
               {{$product->discount}}%
           </span>
           @endif
           <div class="actions-primary">
                <input type="text" name="id" value="{{$product->id}}" hidden/>
                <button class="btn-cart add_to_cart" title="Thêm giỏ hàng" type="button" data-url="{{route('addToCart')}}">
                   Thêm giỏ hàng
               </button>
           </div>
       </div>
       <div class="product-info">
           <h3 class="product-name"><a href="{{route('detailProduct',['cate'=>$product->cate_slug,'slug'=>$product->slug])}}"
                   title="iPhone 13 Pro Max 256GB">{{languageName($product->name)}}</a>
           </h3>
           @if ($product->discount > 0 && $product->price > 0)
               <div class="price-box">
                     {{number_format($discountPrice,0,'','.')}}₫&nbsp;
                     <span class="compare-price">{{number_format($product->price,0,'','.')}}₫</span>
               </div>
           @elseif($product->discount == 0 && $product->price > 0)
               <div class="price-box">
                     {{number_format($product->price,0,'','.')}}₫&nbsp;
               </div>
            @elseif($product->discount == 0 && $product->price == 0)
               <div class="price-box">
                  Liên hệ&nbsp;
               </div>
           @endif
       </div>
       <div class="action d-xl-block d-none">
           <div class="actions-secondary">
               <a title="Xem nhanh" href="javascript:void(0)"
                   data-id="{{$product->id}}"
                   data-url ="{{route('quickview',['id'=>$product->id])}}"
                   class="quick-view-pro btn-views">
                   <svg class="icon">
                       <use xmlns:xlink="http://www.w3.org/1999/xlink"
                           xlink:href="#icon-quickview"></use>
                   </svg>
               </a>
           </div>
       </div>
   </form>
</div>
