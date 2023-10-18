@extends('layouts.main.master')
@section('title')
Quản lý đơn hàng JicaFood
@endsection
@section('description')
Quản lý đơn hàng JicaFood
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
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
            <a itemprop="item" href="/account" title="Trang Tài khoản">
               <span itemprop="name">Trang Tài khoản</span>
               <meta itemprop="position" content="2">
            </a>
         </li>
         <li class="active" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
            <strong itemprop="name">Chi tiết đơn hàng</strong>
            <meta itemprop="position" content="3">
         </li>
      </ul>
   </div>
</section>
<section class="login page_order">
   <div class="container">
      <div class="shadow-sm">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
               <div class="block-account">
                  <h5 class="title-account">Trang tài khoản</h5>
                  <p>Xin chào, <a href="javascript:;" style="color:;">a</a>&nbsp;!</p>
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
            <div class="col-xs-12 col-sm-12 col-lg-9">
               <div class="head-title clearfix">
                  <h1>Chi tiết đơn hàng #{{$bill->code_bill}}</h1>
                  <span class="note order_date">
                  Ngày đặt hàng: {{date_format($bill->created_at,'d/m/Y')}}
                  </span>
               </div>
               <div class="payment_status">
                  <span class="note">Trạng thái thanh toán:</span>
                  <i class="status_pending">
                     <em>
                        @if ($bill->statu == 0)
                        <span class="span_pending" style="color: red"><strong><em>Đang xác nhận thanh toán</em></strong></span>
                        @elseif($bill->statu == 1)
                        <span class="span_pending" style="color: red"><strong><em>Đã thanh toán</em></strong></span>
                        @elseif($bill->statu == 2)
                        <span class="span_pending" style="color: red"><strong><em>Đang vận chuyển</em></strong></span>
                        @elseif($bill->statu == 3)
                        <span class="span_pending" style="color: red"><strong><em>Hoàn thành đơn hàng</em></strong></span>
                        @elseif($bill->statu == 4)
                        <span class="span_pending" style="color: red"><strong><em>Đơn hàng thất bại</em></strong></span>
                        @endif
                       </em>
                  </i>
               </div>
               <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 body_order">
                     <div class="box-address">
                        <h2 class="title-head">Địa chỉ giao hàng</h2>
                        <div class="address box-des">
                           <p> <strong>a</strong></p>
                           <p>
                              Địa chỉ:
                              {{$bill->cus_address}}											
                           </p>
                           <p>Số điện thoại: {{$bill->cus_phone}}</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3 body_order">
                     <div class="box-address">
                        <h2 class="title-head">
                           Thanh toán
                        </h2>
                        <div class="box-des">
                           <a href="" style="color: blue">Xem cách thanh toán</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3 body_order">
                     <div class="box-address">
                        <h2 class="title-head">
                           Ghi chú
                        </h2>
                        <div class="box-des">
                           @if ($bill->note)
                           <p>
                              {{$bill->note}}
                           </p>
                           @else 
                           <p>
                              Không có ghi chú
                           </p>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 margin-top-20">
                     <div class="table-order">
                        <div class="table-responsive table_mobile">
                           <table id="order_details" class="table table-cart">
                              <thead class="thead-default">
                                 <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($billdetail as $item)
                                    <tr>
                                    <td class="link" data-title="Tên">
                                       <div class="image_order">
                                          <a title="{{$item->name}}" href=""><img src="{{url(''.$item->images)}}"></a>
                                       </div>
                                       <div class="content_right">
                                          <a class="title_order" href="" title="{{$item->name}}">{{$item->name}}</a>
                                          <div class="bottom_mb">
                                             <div class="quantity_mb">
                                                x{{$item->qty}}
                                             </div>
                                             <div class="sum_mb">
                                                   {{number_format($item->price - ($item->price*($item->discount/100)))}}₫
                                             </div>
                                          </div>
                                       </div>
                                    </td>
                                    <td data-title="Giá" class="numeric"> {{number_format($item->price - ($item->price*($item->discount/100)))}}₫</td>
                                    <td data-title="Số lượng" class="numeric">{{$item->qty}}</td>
                                    <td data-title="Tổng" class="numeric">{{number_format(($item->price - ($item->price*($item->discount/100)))*$item->qty)}}₫</td>
                                 </tr>
                                    @endforeach
                              </tbody>
                           </table>
                        </div>
                        <table class="table totalorders">
                           <tfoot>
                              <tr class="order_summary discount">
                                 <td>Khuyến mại </td>
                                 <td class="total money right">0₫</td>
                              </tr>
                              <tr class="order_summary ">
                                 <td colspan="">Phí vận chuyển</td>
                                 <td class="total money right">
                                    28.000₫
                                 </td>
                              </tr>
                              <tr class="order_summary order_total">
                                 <td>Tổng tiền</td>
                                 <td class="right"><strong>{{number_format($bill->total_money)}}₫</strong></td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection