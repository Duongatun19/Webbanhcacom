<div class="post-sidebar large-3 col">
   <div id="secondary" class="widget-area " role="complementary">
   <aside id="flatsome_recent_posts-4" class="widget flatsome_recent_posts">
      <span class="widget-title "><span>Bài viết mới cập nhật</span></span>
      <div class="is-divider small"></div>
      <ul>
         @foreach ($news as $new)
               <li class="recent-blog-posts-li">
                  <div class="flex-row recent-blog-posts align-top pt-half pb-half">
                  <div class="flex-col mr-half">
                     <div class="badge post-date  badge-outline">
                           <div class="badge-inner bg-fill" style="background: url({{$new->image}}); border:0;">
                           </div>
                     </div>
                  </div>
                  <div class="flex-col flex-grow">
                     <a href="{{route('detailBlog', ['slug'=>$new->slug])}}" title="{{languageName($new->title)}}">{{languageName($new->title)}}</a>
                     <span class="post_comments op-7 block is-xsmall"><a href="{{route('detailBlog', ['slug'=>$new->slug])}}"></a></span>
                  </div>
                  </div>
               </li>
         @endforeach
      </ul>
   </aside>
   <aside id="woocommerce_products-3" class="widget woocommerce widget_products">
      <span class="widget-title "><span>Sản phẩm đang giảm giá</span></span>
      <div class="is-divider small"></div>
      <ul class="product_list_widget">
         @foreach ($discountPro as $product)
               <li>
                  @php
                     $img = json_decode($product->images);
                     $discountPrice = $product->price - $product->price * ($product->discount / 100);
                  @endphp
                  <a href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'type'=>$product->type_slug, 'slug'=>$product->slug])}}">
                  <img width="100" height="100" src="{{$img[0]}}" class="attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail" alt="{{languageName($product->name)}}" loading="lazy" srcset="{{$img[0]}} 100w, {{$img[0]}} 600w, {{$img[0]}} 300w" sizes="(max-width: 100px) 100vw, 100px" />		<span class="product-title">{{languageName($product->name)}}</span>
                  </a>
                  <del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>{{number_format($product->price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi>{{number_format($discountPrice)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></ins>
               </li>
         @endforeach
      </ul>
   </aside>
   </div>
</div>