@extends('layouts.main.master')
@section('title')
Đăng nhập mua hàng tại icongnghe
@endsection
@section('description')
Đăng nhập mua hàng tại icongnghe
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<link rel="preload" as="style" type="text/css" href="{{asset('frontend/css/evo-accounts.scss.css')}}" />
<link href="{{asset('frontend/css/evo-accounts.scss.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('frontend/css/account_oder_style.scss.css')}}" rel="stylesheet" type="text/css" />

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
            <strong itemprop="name">Đăng nhập tài khoản</strong>
            <meta itemprop="position" content="2">
         </li>

      </ul>
   </div>
</section>
<div class="container margin-bottom-20 margin-top-30">
   <div class="d-none">
      <h1 class="title-head">Đăng nhập tài khoản</h1>
   </div>
   <div class="row justify-content-md-center">
      <div class="col-lg-8 col-md-12">
         <div class="page-login account-box-shadow">
            <div id="login" class="row">
               <div class="col-lg-6 col-md-6 account-banner order-lg-first order-md-first order-sm-last order-last">
                  <div class="account_policy_title">Quyền lợi thành viên</div>
                  <div class="account_policy_content">
                     <p>Mua hàng khắp thế giới cực dễ dàng, nhanh chóng</p>
                     <p>Theo dõi chi tiết đơn hàng, địa chỉ thanh toán dễ dàng</p>
                     <p>Nhận nhiều chương trình ưu đãi hấp dẫn từ chúng tôi</p>
                  </div>
               </div>
               <div
                  class="col-lg-6 col-md-6 evo-account-content order-lg-last order-md-last order-sm-first order-first">
                  <ul class="auth-block__menu-list">
                     <li class="active">
                        <a href="javascript:;" title="Đăng nhập">Đăng nhập</a>
                     </li>
                     <li>
                        <a href="{{route('register')}}" title="Đăng ký">Đăng ký</a>
                     </li>
                  </ul>
                  <div id="evo-login">
                     <form accept-charset="utf-8" action="{{route('postlogin')}}" id="customer_login" method="post"
                        class="has-validation-callback" enctype="multipart/form-data">
                        @csrf
                        <div class="form-signup">

                        </div>
                        <div class="form-signup clearfix">
                           <fieldset class="form-group margin-bottom-10">
                              <label>Email<span class="required">*</span></label>
                              <input autocomplete="off" placeholder="Nhập Địa chỉ Email" type="email"
                                 class="form-control form-control-lg" value="" name="email" id="customer_email"
                                 required="" data-validation="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                 data-validation-error-msg="Email sai định dạng">
                           </fieldset>
                           <fieldset class="form-group margin-bottom-0">
                              <label>Mật khẩu<span class="required">*</span></label>
                              <input autocomplete="off" placeholder="Nhập Mật khẩu" type="password"
                                 class="form-control form-control-lg" value="" name="password" id="customer_password"
                                 data-validation-error-msg="Không được để trống" data-validation="required">
                           </fieldset>
                           <div class="clearfix"></div>
                           <div class="pull-xs-left text-center" style="margin-top: 15px;">
                              <button class="btn btn-style btn-blues" type="submit" value="Đăng nhập">Đăng nhập</button>
                           </div>
                           <p class="login--notes">Evo Mobile cam kết bảo mật và sẽ không bao giờ đăng <br>hay chia sẻ
                              thông tin mà chưa có được sự đồng ý của bạn.</p>
                        </div>
                     </form>
                     <div class="clearfix"></div>
                     <div class="line-break">
                        <span>hoặc đăng nhập qua</span>
                     </div>
                     <div class="social-login text-center">
                        <a href="{{route('loginFacebook')}}" class="social-login--facebook"><img
                              width="129px" height="37px" alt="facebook-login-button"
                              src="{{url('frontend/img/fb-btn.svg')}}"></a>
                        <a href="{{route('loginGoogle')}}" class="social-login--google"><img
                              width="129px" height="37px" alt="google-login-button"
                              src="{{url('frontend/img/gp-btn.svg')}}"></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- <div class="page-content-account">
   <div class="container">
      <div class="row">
         <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
            <div class="d-group">
               <div class="left-col">
                  <div class="group-login group-log">
                     <h1>
                        Đăng nhập tài khoản
                     </h1>
                     <form action="{{route('postlogin')}}" id="customer_login" method="post"
enctype="multipart/form-data">
@csrf
<fieldset class="form-group">
   <label>Email <span class="required">*</span></label>
   <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" class="form-control form-control-lg" value=""
      name="email" id="customer_email" placeholder="Email" required="">
</fieldset>
<fieldset class="form-group">
   <label>Mật khẩu <span class="required">*</span> </label>
   <input type="password" class="form-control form-control-lg" value="" name="password" id="customer_password"
      placeholder="Mật khẩu" required="">
</fieldset>
<button class="btn-login" type="submit" value="Đăng nhập">Đăng nhập</button>
</form>
<div class="block social-login--facebooks">
   <p class="a-center">
      <span>Hoặc đăng nhập bằng</span>
   </p>
   <a href="{{route('loginFacebook')}}" class="social-login--facebook"><img width="129px" height="37px"
         alt="facebook-login-button" src="{{url('frontend/images/fb-btn.svg')}}"></a>
   <a href="{{route('loginGoogle')}}" class="social-login--google"><img width="129px" height="37px"
         alt="google-login-button" src="{{url('frontend/images/gp-btn.svg')}}"></a>
</div>
</div>
</div>
<div class="right-col">
   <h4>
      Quyền lợi với thành viên
   </h4>
   <div>
      <p>Vận chuyển siêu tốc</p>
      <p>Sản phẩm đa dạng </p>
      <p>Đổi trả dễ dàng</p>
      <p>Tích điểm đổi quà</p>
      <p>Được giảm giá cho lần mua tiếp theo lên đến 10% </p>
   </div>
   <a href="{{route('register')}}" class="btn-register-default">Đăng ký</a>
</div>
</div>
</div>
</div>
</div>
</div> --}}
@endsection
<script type="text/javascript"></script>