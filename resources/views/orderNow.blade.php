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
@section('content')
<div class="reservation-map clearfix">
    <div class="row gutter-0" style="background: #0b0d0f;">
        <div class="col-sm-12 col-md-6" style="padding: 45px!important;margin-top: 5%!important;">
            <div class="section-title">
                <h2>Bạn muốn đặt hàng</h2>
                <h4 class="white">Điền thông tin hoặc gọi cho chúng tôi</h4>
            </div>
            <form method="post" action="{{route('postBill')}}">
                @csrf
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="exampleInputtext1" style="color: white;">Họ và tên</label>
                            <input type="text" class="form-control" name="billingName" required>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color: white;">Địa chỉ</label>
                            <input type="text" class="form-control" name="billingAddress" required>
                          </div>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="exampleInputtext2" style="color: white;">Số điện thoại</label>
                            <input type="text" class="form-control" name="billingPhone" required>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="js-cf-message"></div>
                        <div class="form-group">
                            <label for="exampleInputtext3" style="color: white;">Ghi chú</label>
                            <textarea class="form-control" rows="7" name="note"></textarea>
                          </div>
                    </div>
                </div>
        

                  <div class="send-message">
                      <button type="submit" class="btn btn-default" style="color: white;">Đặt hàng</button>
                  </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="reservation-block padding-right-155 padding-left-155 display-flex vertical-center">
                <div class="reserv-image-block">
                    <div class="reserv-image"></div>
                    <div class="reserv-overlay"></div>
                </div>
                <div class="reservation-detail flx-align-self">
                    <h3 class="white">GIỜ MỞ CỬA</h3>
                    <p class="white">Thứ 2 – Chủ Nhật hàng tuần

                        10:00 AM – 21:30 PM</p>
                    <h3 class="white">Hotline</h3>
                    <p class="white">{{$setting->phone1}}</p>
                    <a href="#"
                        class="btn btn-secondary">ĐANG MỞ CỬA</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection