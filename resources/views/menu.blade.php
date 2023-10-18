@extends('layouts.main.master')
@section('title')
Đặt bàn tại Lynh
@endsection
@section('description')
Đặt bàn tại Lynh
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('js')
<script src="{{asset('frontend/js/getprobycate.js')}}"></script>
@endsection
@section('content')
<div class="todays-specialties">
    <div class="parallax-window" data-parallax="scroll"
       data-image-src="{{url('frontend/images//bun-dau-mam-tom-ha-noi-1.jpg')}}"></div>
    <div class="overlay"></div>
    <div class="specialties-detail">
       <div class="section-title">
          <h2 style="color: #fcfd00!important;">Thực đơn hôm nay</h2>
          <h3 class="white">Món ngon luôn sẵn sàng</h3>
       </div>
    </div>
 </div>
<div id="menulist" class="menu-list clearfix">
    <div class="container">
       <div class="row gutter-0">
          <div class="col-sm-12 col-md-3">
             <div class="menu-list-left">
                <div class="menu-list-title">
                   <h4>Lynh Bún Đậu</h4>
                   <h2>menu</h2>
                </div>
                <ul>
                   <li class="active ed tatca" onclick="getProByCate(0)"><a href="#menulist" class="scroll">Tất cả</a></li>
                   @foreach ($categoryhome as $item)
                   <li onclick="getProByCate('cate_{{$item->id}}')" class="ed cate_{{$item->id}}">
                      <input type="hidden" id="cate_{{$item->id}}" value="{{$item->id}}">
                      <a href="#menulist" class="scroll">{{languageName($item->name)}}</a>
                   </li>
                   @endforeach
                </ul>
             </div>
          </div>
          <div class="col-sm-12 col-md-9">
             <div class="menu-list-right">
                <ul class="products-list product-list-by-cate">
                   @foreach ($allproduct as $item)
                      @include('layouts.product.item',['pro'=>$item])
                   @endforeach
                </ul>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection