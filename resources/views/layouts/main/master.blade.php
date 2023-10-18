<!DOCTYPE html>
<html lang="vi">
   <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="@yield('title')" />
    <meta name="robots" content="noodp,index,follow" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ url()->current() }}" />
    <meta property="og:updated_time" content="2021-08-28T22:06:30+07:00" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:secure_url" content="@yield('image')" />
    <meta property="og:image:width" content="598" />
    <meta property="og:image:height" content="333" />
    <meta property="og:image:alt" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="@yield('image')" />
    <!-- Fav Icon -->
    @yield('css')

    <link href="{{asset('frontend/css/evo-collections.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ url('' . $setting->favicon) }}" type="image/x-icon"> 
    <link href="{{asset('frontend/css/plugin.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('frontend/css/evo-main.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('frontend/css/evo-index.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
 
    <script src="{{asset('frontend/js/jquery-2.2.3.min.js')}}" type="text/javascript"></script>
   </head>
   <body class="  index">
      <script src="{{asset('frontend/js/option-selectors.js')}}" type="text/javascript"></script>
      <script src="{{asset('frontend/js/api.jquery.js')}}" type="text/javascript"></script>
      <script src="{{asset('frontend/js/evo-index-js.js')}}" type="text/javascript"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
      <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
      <div class="evo-search-bar">
 

      </div>
      <div class="lopgia">
         <div class="modal-thongbao">
            <p class="dong-modal">
               <i class="fa-solid fa-xmark close-custom"></i>
               </p>
               <p class="icon-ctt"><img src="{{asset('frontend/images/tichxanh.gif')}}" alt="" srcset=""></p>
             <p class="nd-modal">Thêm vào giỏ hàng thành công !<br> </p>
               
         </div>
     </div>
     <script>
            $('.close-custom').click(function(e){
            $('.lopgia').attr('style', 'display:none;');
            })
            $('.lopgia').click(function(e){
            $('.lopgia').attr('style', 'display:none;');
            })

     </script>
     @include('layouts.header.index')
        @yield('content')
      @include('layouts.footer.index')
      <div class="backdrop__body-backdrop___1rvky"></div>
   	
      <div id="popup-cart" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <button type="button" class="close" data-dismiss="modal" data-backdrop="false" aria-label="Close" style="position: relative; z-index: 9;"><span aria-hidden="true">×</span></button>
               <div class="row-noGutter">
                  <div class="modal-left">
                     <h3 class="title"><i class="fa fa-check"></i> Sản phẩm vừa được thêm <span class="hidden-xs">vào giỏ hàng</span></h3>
                     <div class="modal-body">
                        <div class="media">
                           <div class="media-left thumb_img">
                              <div class="thumb-1x1">
                                 <img src="//bizweb.dktcdn.net/100/366/378/themes/736342/assets/logo.png?1663905428530" alt="Evo Cake" />
                              </div>
                           </div>
                           <div class="media-body body_content">
                              <div class="product-title"></div>
                              <div class="product-new-price"><span></span></div>
                              <div class="variant_title"><span></span></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-right">
                     <h4 class="title right_title">
                        <a href="{{route('listCart')}}"><i class="fa fa-caret-right"></i> Giỏ hàng hiện có (<span class="cart-popup-count"></span>) sản phẩm </a>
                     </h4>
                     <a title="Tiến hành thanh toán" href="{{route('checkout')}}" class="btn btn-primary checkout_button btn-full">Tiến hành thanh toán <i class="fa fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script src="{{asset('frontend/js/jquery.cookie.min.js')}}"></script>
      <script src="{{asset('frontend/js/main.js')}}" type="text/javascript"></script>
      @yield('js')
      <script src="{{asset('frontend/js/scroll-top.min.js')}}"></script>
      <div id="loader-wrapper">
         <div class="loader-section section-left"></div>
         <div class="loader-section section-right"></div>
      </div>
   </body>
</html>