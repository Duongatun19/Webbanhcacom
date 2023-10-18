@extends('layouts.main.master')
@section('title')
Giới thiệu về {{$setting->company}}
@endsection
@section('description')
@endsection
@section('css')
<link href="{{asset('frontend/css/breadcrumb_style.scss.css')}}" rel="stylesheet" type="text/css" />
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
				<strong itemprop="name">Giới thiệu</strong>
				<meta itemprop="position" content="2" />
			</li>
			
		</ul>
	</div>
</section>
<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="page-title category-title">
					<h1 class="title-head"><a href="#" title="Giới thiệu">Giới thiệu</a></h1>
               <h3 style="font-size:15px">
                  {{$setting->company}}
               </h3>
				</div>
				<div class="content-page rte">
					{!!($gioithieu->content)!!}
				</div>
            <hr>
            <div>
               {!!$setting->iframe_map!!}
            </div>
            <br>
            <br>
			</div>
		</div>
	</div>
</section>
		
		
@endsection