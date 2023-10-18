@extends('layouts.main.master')
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
            <strong itemprop="name">Đăng ký tài khoản</strong>
            <meta itemprop="position" content="2">
         </li>
      </ul>
   </div>
</section>
<div class="container margin-bottom-20 margin-top-30">
   <h1 class="d-none">Đăng ký tài khoản</h1>
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
               <div class="col-lg-6 col-md-6 evo-account-content order-lg-last order-md-last order-sm-first order-first">
                  <ul class="auth-block__menu-list">
                     <li>
                        <a href="{{route('login')}}" title="Đăng nhập">Đăng nhập</a>
                     </li>
                     <li class="active">
                        <a href="javascript:;" title="Đăng ký">Đăng ký</a>
                     </li>
                  </ul>
                  <form accept-charset="utf-8" action="{{route('postRegister')}}" id="customer_register" method="post" enctype="multipart/form-data" class="has-validation-callback">
                     @csrf
                     <div class="form-signup">
                     </div>
                     <div class="form-signup clearfix">
                        <div class="row">
                           <div class="col-md-12">
                              <fieldset class="form-group">
                                 <label>Họ và tên<span class="required">*</span></label>
                                 <input placeholder="Nhập Họ" type="text" class="form-control form-control-lg" value="{{ old('name') ? old('name') : '' }}" name="name" id="lastName" required="">
                                 @error('name') <i class="noti_error">{{$message }}</i> @enderror
                              </fieldset>
                           </div>
                           <div class="col-md-12">
                              <fieldset class="form-group">
                                 <label>Số điện thoại<span class="required">*</span></label>
                                 <input placeholder="Nhập Số điện thoại" type="tel" class="number-phone form-control form-control-lg" value="{{ old('phone') ? old('phone') : '' }}" name="phone" required="">
                                 @error('phone') <i class="noti_error">{{$message }}</i> @enderror
                              </fieldset>
                           </div>
                           <div class="col-md-12">
                              <fieldset class="form-group">
                                 <label>Email<span class="required">*</span></label>
                                 <input placeholder="Nhập Địa chỉ Email" type="email" class="form-control form-control-lg" value="{{ old('email') ? old('email') : '' }}" name="email" id="email" placeholder="Email" required="">
                                 @error('email') <i class="noti_error">{{$message }}</i> @enderror
                              </fieldset>
                           </div>
                           <div class="col-md-12">
                              <fieldset class="form-group">
                                 <label>Mật khẩu<span class="required">*</span></label>
                                 <input placeholder="Nhập Mật khẩu" type="password" class="form-control form-control-lg" value="{{ old('password') ? old('password') : '' }}" name="password" id="password" required="">
                                 @error('password') <i class="noti_error">{{$message }}</i> @enderror
                              </fieldset>
                           </div>
                           <div class="col-md-12 text-center margin-top-10">
                              <button type="submit" value="Đăng ký" class="btn btn-style btn-blues">Tạo tài khoản</button>
                           </div>
                        </div>
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
@endsection
<script type="text/javascript"></script>