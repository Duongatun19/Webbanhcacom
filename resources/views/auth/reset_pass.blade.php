@extends('layouts.master')
@section('css')
<link href="{{asset('frontend/asset/css/evo-accounts.scss.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<section class="bread-crumb margin-bottom-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">					
                        <li class="home"><a itemprop="url" href="/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a><span><i class="fa fa-angle-right"></i></span></li>
                        <li><strong itemprop="title">Đặt lại mật khẩu</strong></li>
                    </ul>
                </div>
            </div>
        </div>
   </section>
    <div class="container margin-bottom-20 margin-top-30">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                  <div class="page-login account-box-shadow">
                     <div id="login">
                        <div class="text-center margin-bottom-30">
                           <h1 class="title-head">Đặt lại mật khẩu</h1>
                           <p>
                              Nhập mật khẩu mới của bạn
                           </p>
                        </div>
                    <form accept-charset="UTF-8" action="" id="recover_customer_password" method="post" class="has-validation-callback">
                          @csrf
                           @if(Session::has('message'))
                                <div class="form-signup" style="color:red">
                                    Chúng tôi sẽ gửi thông báo về email của bạn <br>
                                </div>
                            @elseif(Session::has('errors'))
                                <div class="form-signup" style="color:red">
                                    Email không tồn tại <br>
                                </div>
                            @endif
                            <div class="form-signup clearfix">
                              <fieldset class="form-group">
                                 <label>Email<span class="required">*</span></label>
                                 <input type="text" class="form-control form-control-lg" value="{{$email}}" name="email" id="recover-email" placeholder="email" required="" disabled="">
                              </fieldset>
                            </div>
                           <div class="form-signup clearfix">
                              <fieldset class="form-group">
                                 <label>Mật khẩu mới<span class="required">*</span></label>
                                 <input type="password" class="form-control form-control-lg" value="" name="new_password" id="recover-email" placeholder="Nhập mật khẩu mới" required="">
                              </fieldset>
                           </div>
                           <div class="action_bottom text-center">
                              <button class="btn btn-style btn-blues" style="margin-top: 15px;" type="submit">Thay đổi mật khẩu</button>
                           </div>
                           <div class="text-login text-center">
                              <p>Quay lại <a href="javascript:;" class="btn-link-style btn-register" onclick="hideRecoverPasswordForm();" title="Quay lại">tại đây.</a></p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
@endsection