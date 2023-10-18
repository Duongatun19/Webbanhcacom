@extends('layouts.main.master')

@section('css')
<link href="{{asset('frontend/css/account_order_style.scss.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('frontend/css/evo-accounts.scss.css')}}" rel="stylesheet" type="text/css" />
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
            <a itemprop="item" href="" title="Trang Tài khoản">
               <span itemprop="name">Trang Tài khoản</span>
               <meta itemprop="position" content="2">
            </a>
         </li>
         <li class="active" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <strong itemprop="name">Trang đơn hàng</strong>
            <meta itemprop="position" content="3">
         </li>
      </ul>
   </div>
</section>
<section class="signup page_customer_account">
   <div class="container">
      <div class="shadow-sm">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
               <div class="block-account">
                  <h5 class="title-account">Trang tài khoản</h5>
                  <p>
                     Xin chào, <span style="color:;">a</span>&nbsp;!
                  </p>
                  <ul>
                     <li>
                        <a class="title-info active" href="{{route('accoungOrder')}}" title="Đơn hàng của bạn">Đơn hàng của bạn</a>
                     </li>
                     <li>
                        <a class="title-info" href="{{route('logout')}}" title="Sổ địa chỉ">Đăng xuất</a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
               <h1 class="title-head margin-top-0">Đơn hàng của bạn</h1>
               <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                  <div class="my-account">
                     <div class="dashboard">
                        <div class="recent-orders">
                           <div class="table-responsive tab-all">
                              <table class="table table-cart table-order" id="my-orders-table">
                                 <thead class="thead-default">
                                    <tr>
                                       <th>Đơn hàng</th>
                                       <th>Ngày</th>
                                       <th>Địa chỉ</th>
                                       <th>Giá trị đơn hàng</th>
                                       <th>TT thanh toán</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($bill as $item)
                                    <tr class="first odd">
                                      <td><a href="{{route('accoungOrderDetail',['billid'=>$item->code_bill])}}">#{{$item->code_bill}}</a></td>
                                      <td>{{date_format($item->created_at,'d/m/Y')}}</td>
                                      <td>
                                          {{$item->cus_address}}
                                      </td>
                                      <td>
                                         <span class="price">{{number_format($item->total_money)}}₫</span>
                                      </td>
                                      <td>
                                          @if ($item->statu == 0)
                                          <span class="span_pending">Đang xác nhận thanh toán</span>
                                          @elseif($item->statu == 1)
                                          <span class="span_pending">Đã thanh toán</span>
                                          @elseif($item->statu == 2)
                                          <span class="span_pending">Đang vận chuyển</span>
                                          @elseif($item->statu == 3)
                                          <span class="span_pending">Hoàn thành đơn hàng</span>
                                          @elseif($item->statu == 4)
                                          <span class="span_pending">Đơn hàng thất bại</span>
                                          @endif
                                         
                                      </td>
                                   </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                           <div class="paginate-pages pull-right page-account text-right col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection