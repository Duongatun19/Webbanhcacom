@extends('layouts.main.master')
@section('title')
Liên hệ với chúng tôi
@endsection
@section('description')
Liên hệ với chúng tôi
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link href="{{asset('frontend/css/evo-contacts.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
@endsection
@section('content')
<section class="bread-crumb margin-bottom-10">
	<div class="container">
		<ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">						
			<li class="home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<a itemprop="item" href="{{route('home')}}" title="Trang chủ">
					<span itemprop="name">Trang chủ</span>
					<meta itemprop="position" content="1" />
				</a>
				<span><i class="fa fa-angle-right"></i></span>
			</li>
			
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<strong itemprop="name">Liên hệ</strong>
				<meta itemprop="position" content="2" />
			</li>
			
		</ul>
	</div>
</section>
<div class="contact margin-bottom-20 page-contact">
	<h1 class="title-head text-center hidden">Liên hệ</h1>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-login">
					<div class="row">
						<div class="col-md-12 col-sm-12 contact-info-page">
							@if (Session::has('thanhcong'))
								<div class="alert alert-success">
								{{ Session::get('thanhcong') }}
								</div>
							@endif
							@if (Session::has('error'))
								<div class="alert alert-error">
								{{ Session::get('error') }}
								</div>
							@endif
							
							<h3>Thông tin liên hệ</h3>
							
							<div class="row">
								<div class="col-sm-6 col-xs-12">
									<div class="contact-contens">
										{!!$gioithieu->content!!}
									</div>
								</div>
								<div class="col-sm-6 col-xs-12">
									<ul class="list-menu">
										
										<li><i class="fas fa-map-marker-alt"></i> <span>Địa chỉ:</span><br>{{$setting->address1}}</li>
										<li><i class="fas fa-mobile-alt"></i> <span>Điện thoại:</span><br> <a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}">{{$setting->phone1}}</a></li>
										<li><i class="fas fa-envelope"></i> <span>Email:</span><br> <a href="mailto:{{$setting->email}}" title="{{$setting->email}}">{{$setting->email}}</a></li>
										
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<h3 class="text-contact">Gửi thông tin cho chúng tôi</h3>
							
							<form method="post" action="{{route('postcontact')}}"  accept-charset="UTF-8">
								@csrf
							<div class="form-signup clearfix">
								<div class="row">
									<div class="col-sm-4 col-xs-12">
										<fieldset class="form-group">
											<label>Họ và tên<span class="required">*</span></label>
											<input placeholder="Nhập họ và tên" type="text" name="name" id="name" class="form-control  form-control-lg" data-validation-error-msg= "Không được để trống" data-validation="required" required />
										</fieldset>
									</div>
									<div class="col-sm-4 col-xs-12">
										<fieldset class="form-group">
											<label>Email<span class="required">*</span></label>
											<input placeholder="Nhập địa chỉ Email" type="email" name="email" data-validation="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation-error-msg= "Email sai định dạng" id="email" class="form-control form-control-lg" required />
										</fieldset>
									</div>
									<div class="col-sm-4 col-xs-12">
										<fieldset class="form-group">
											<label>Điện thoại<span class="required">*</span></label>
											<input placeholder="Nhập số điện thoại" type="tel" name="phone" data-validation="tel" data-validation-error-msg= "Không được để trống" id="tel" class="number-sidebar form-control form-control-lg" required />
										</fieldset>
									</div>
									<div class="col-sm-12 col-xs-12">
										<fieldset class="form-group">
											<label>Nội dung<span class="required">*</span></label>
											<textarea placeholder="Nội dung liên hệ" name="mess" id="comment" class="form-control form-control-lg" rows="5" data-validation-error-msg= "Không được để trống" data-validation="required" required></textarea>
										</fieldset>
										<div class="pull-xs-left" style="margin-top:20px;">
											<button type="submit" class="btn btn-blues btn-style btn-style-active">Gửi tin nhắn</button>
										</div> 
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 evo-maps">
				
				{!!$setting->iframe_map!!}
				
			</div>
		</div>
	</div>
</div>
		
		

@endsection
