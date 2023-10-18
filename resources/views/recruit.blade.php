@extends('layouts.main.master')
@section('title')
Tuyển dụng
@endsection
@section('description')
Tuyển dụng
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
				<strong itemprop="name">Tuyển dụng</strong>
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
							<h3>Thông tin {{$tuyendung->title}}</h3>
							<div class="row">
								<div class="col-sm-8 col-xs-12">
									<div class="contact-contens">
										{!!$tuyendung->content!!}
									</div>
								</div>
								<div class="col-sm-4 col-xs-12">
									<ul class="list-menu">
										
										<li><i class="fas fa-map-marker-alt"></i> <span>Địa chỉ:</span><br>{{$setting->address1}}</li>
										<li><i class="fas fa-mobile-alt"></i> <span>Điện thoại:</span><br> <a href="tel:{{$setting->phone1}}" title="{{$setting->phone1}}">{{$setting->phone1}}</a></li>
										<li><i class="fas fa-envelope"></i> <span>Email:</span><br> <a href="mailto:{{$setting->email}}" title="{{$setting->email}}">{{$setting->email}}</a></li>
										
									</ul>
								</div>
							</div>
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
