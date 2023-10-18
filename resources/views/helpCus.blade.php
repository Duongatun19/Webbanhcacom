@extends('layouts.main.master')
@section('title')
{{$helpCus->title}}
@endsection
@section('description')
@endsection
@section('css')
<link href="{{ asset('frontend/css/breadcrumb_style.scss.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/css/blog_article_style.scss.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('frontend/css/sidebar_style.scss.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
@endsection
@section('content')
<div class="bodywrap">
	<section class="bread-crumb">
	   <div class="container">
		  <ul class="breadcrumb">
			 <li class="home">
				<a href="{{route('home')}}"><span>Trang chủ</span></a>
				<span class="mr_lr">&nbsp;/&nbsp;</span>
				{{-- @dd($detail_service) --}}
			 </li>
				<li><strong><span>{{$helpCus->title}}</span></strong>
		  </ul>
	   </div>
	</section>
	<section class="blogpage">
	   <div class="container layout-article" itemscope itemtype="https://schema.org/Article">
		  
			 <article class="article-main">
				<div class="row">
				   <div class="right-content col-lg-9 col-12">
					  <div class="article-details clearfix">
						 <h1 class="article-title">{{$helpCus->title}}</h1>
						 <div class="posts">
							<div class="time-post f">
							   <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14"
								  viewBox="0 0 13 14" fill="none">
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M6.19926 4.25024C6.49268 4.25024 6.73054 4.48811 6.73054 4.78153V8.051C6.73054 8.34442 6.49268 8.58228 6.19926 8.58228C5.90583 8.58228 5.66797 8.34442 5.66797 8.051V4.78153C5.66797 4.48811 5.90583 4.25024 6.19926 4.25024Z"
									 fill="#7B7B7B" />
								  <path
									 d="M7.26187 8.32356C7.26187 8.91041 6.78614 9.38614 6.19929 9.38614C5.61245 9.38614 5.13672 8.91041 5.13672 8.32356C5.13672 7.73672 5.61245 7.26099 6.19929 7.26099C6.78614 7.26099 7.26187 7.73672 7.26187 8.32356Z"
									 fill="#7B7B7B" />
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M4.20142 1.75332C5.44136 1.05586 6.95535 1.05586 8.19529 1.75332L10.3204 2.94872C11.603 3.67016 12.3967 5.02729 12.3967 6.49883V8.73132C12.3967 10.2029 11.603 11.56 10.3204 12.2814L8.19529 13.4768C6.95535 14.1743 5.44136 14.1743 4.20142 13.4768L2.07627 12.2814C0.793712 11.56 0 10.2029 0 8.73132V6.49883C0 5.02729 0.793712 3.67016 2.07627 2.94872L4.20142 1.75332ZM7.67435 2.67944C6.75788 2.16392 5.63884 2.16392 4.72236 2.67944L2.59721 3.87484C1.64923 4.40807 1.06258 5.41117 1.06258 6.49883V8.73132C1.06258 9.81898 1.64923 10.8221 2.59721 11.3553L4.72236 12.5507C5.63884 13.0662 6.75788 13.0662 7.67435 12.5507L9.7995 11.3553C10.7475 10.8221 11.3341 9.81898 11.3341 8.73132V6.49883C11.3341 5.41117 10.7475 4.40807 9.79951 3.87484L7.67435 2.67944Z"
									 fill="#7B7B7B" />
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M4.51457 0.236639C4.67733 0.480781 4.61136 0.810641 4.36722 0.973403L2.24207 2.39017C1.99792 2.55293 1.66806 2.48696 1.5053 2.24282C1.34254 1.99868 1.40851 1.66881 1.65265 1.50605L3.77781 0.0892861C4.02195 -0.0734752 4.35181 -0.00750317 4.51457 0.236639Z"
									 fill="#7B7B7B" />
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M7.88225 0.236639C8.04502 -0.00750317 8.37488 -0.0734752 8.61902 0.0892861L10.7442 1.50605C10.9883 1.66881 11.0543 1.99868 10.8915 2.24282C10.7288 2.48696 10.3989 2.55293 10.1548 2.39017L8.02961 0.973403C7.78547 0.810641 7.71949 0.480781 7.88225 0.236639Z"
									 fill="#7B7B7B" />
							   </svg>
							   {{date('d-m-Y', strtotime($helpCus->updated_at))}}
							</div>
							<div class="time-post">
							   <svg xmlns="http://www.w3.org/2000/svg" width="11" height="13"
								  viewBox="0 0 11 13" fill="none">
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M5.49918 1.06452C4.61731 1.06452 3.90241 1.77942 3.90241 2.66129C3.90241 3.54316 4.61731 4.25806 5.49918 4.25806C6.38106 4.25806 7.09596 3.54316 7.09596 2.66129C7.09596 1.77942 6.38106 1.06452 5.49918 1.06452ZM2.83789 2.66129C2.83789 1.1915 4.02939 0 5.49918 0C6.96897 0 8.16047 1.1915 8.16047 2.66129C8.16047 4.13108 6.96897 5.32258 5.49918 5.32258C4.02939 5.32258 2.83789 4.13108 2.83789 2.66129Z"
									 fill="#7B7B7B" />
								  <path fill-rule="evenodd" clip-rule="evenodd"
									 d="M5.4958 7.45146C4.07636 7.44025 2.82529 7.85563 1.87218 8.21234C1.38538 8.39454 1.06452 8.8791 1.06452 9.4449V11.887C1.06452 12.1809 0.826216 12.4192 0.532258 12.4192C0.2383 12.4192 0 12.1809 0 11.887V9.4449C0 8.48202 0.554151 7.56901 1.49905 7.21537C2.47721 6.84927 3.88055 6.37415 5.5042 6.38697C6.9418 6.39832 8.08405 6.78769 9.0795 7.12702C9.18426 7.16273 9.28739 7.19788 9.38906 7.23199C10.3852 7.56609 11 8.50832 11 9.5239V11.887C11 12.1809 10.7617 12.4192 10.4677 12.4192C10.1738 12.4192 9.93548 12.1809 9.93548 11.887V9.5239C9.93548 8.9302 9.58017 8.41888 9.05056 8.24125C8.94767 8.20674 8.84527 8.17196 8.74304 8.13723C7.73957 7.79637 6.75338 7.46138 5.4958 7.45146Z"
									 fill="#7B7B7B" />
							   </svg>
							   <span>Innovac</span>
							</div>
						 </div>
						 <div class="content-mucluc auto_get">
						{!!$helpCus->content!!}
						 </div>
					  </div>
				   </div>
				   @include('blog.menublog');
				</div>

			 </article>
		  </div>
	   </div>
	</section>
	<script>
	   var swiperwish = new Swiper('.blog-relate-swiper', {
		   slidesPerView: 4,
		   loop: false,
		   grabCursor: true,
		   spaceBetween: 20,
		   roundLengths: true,
		   slideToClickedSlide: false,
		   navigation: {
			   nextEl: '.blog-relate-swiper .swiper-button-next',
			   prevEl: '.blog-relate-swiper .swiper-button-prev',
		   },
		   pagination: {
			   el: '.blog-relate-swiper .swiper-pagination',
			   clickable: true,
		   },
		   autoplay: false,
		   breakpoints: {
			   300: {
				   slidesPerView: 1,
				   spaceBetween: 0
			   },
			   500: {
				   slidesPerView: 1,
				   spaceBetween: 0
			   },
			   640: {
				   slidesPerView: 2,
				   spaceBetween: 20
			   },
			   768: {
				   slidesPerView: 2,
				   spaceBetween: 20
			   },
			   991: {
				   slidesPerView: 3,
				   spaceBetween: 20
			   },
			   1200: {
				   slidesPerView: 3,
				   spaceBetween: 20
			   }
		   }
	   });
	</script>
	<script>
	   (function($) {
		   "use strict";
		   $.ajaxChimp = {
			   responses: {
				   "We have sent you a confirmation email": 0,
				   "Please enter a valueggg": 1,
				   "An email address must contain a single @": 2,
				   "The domain portion of the email address is invalid (the portion after the @: )": 3,
				   "The username portion of the email address is invalid (the portion before the @: )": 4,
				   "This email address looks fake or invalid. Please enter a real email address": 5
			   },
			   translations: {
				   en: null
			   },
			   init: function(selector, options) {
				   $(selector).ajaxChimp(options)
			   }
		   };
		   $.fn.ajaxChimp = function(options) {
			   $(this).each(function(i, elem) {
				   var form = $(elem);
				   var email = form.find("input[type=email]");
				   var label = form.find("label[for=" + email.attr("id") + "]");
				   var settings = $.extend({
					   url: form.attr("action"),
					   language: "en"
				   }, options);
				   var url = settings.url.replace("/post?", "/post-json?").concat("&c=?");
				   form.attr("novalidate", "true");
				   email.attr("name", "EMAIL");
				   form.submit(function() {
					   var msg;
	   
					   function successCallback(resp) {
						   if (resp.result === "success") {
							   msg = "We have sent you a confirmation email";
							   label.removeClass("error").addClass("valid");
							   email.removeClass("error").addClass("valid")
						   } else {
							   email.removeClass("valid").addClass("error");
							   label.removeClass("valid").addClass("error");
							   var index = -1;
							   try {
								   var parts = resp.msg.split(" - ", 2);
								   if (parts[1] === undefined) {
									   msg = resp.msg
								   } else {
									   var i = parseInt(parts[0], 10);
									   if (i.toString() === parts[0]) {
										   index = parts[0];
										   msg = parts[1]
									   } else {
										   index = -1;
										   msg = resp.msg
									   }
								   }
							   } catch (e) {
								   index = -1;
								   msg = resp.msg
							   }
						   }
						   if (settings.language !== "en" && $.ajaxChimp.responses[msg] !==
							   undefined && $.ajaxChimp.translations && $.ajaxChimp.translations[
								   settings.language] && $.ajaxChimp.translations[settings
								   .language][$.ajaxChimp.responses[msg]]) {
							   msg = $.ajaxChimp.translations[settings.language][$.ajaxChimp
								   .responses[msg]
							   ]
						   }
						   label.html(msg);
						   label.show(2e3);
						   if (settings.callback) {
							   settings.callback(resp)
						   }
					   }
					   var data = {};
					   var dataArray = form.serializeArray();
					   $.each(dataArray, function(index, item) {
						   data[item.name] = item.value
					   });
					   $.ajax({
						   url: url,
						   data: data,
						   success: successCallback,
						   dataType: "jsonp",
						   error: function(resp, text) {
							   console.log("mailchimp ajax submit error: " + text)
						   }
					   });
					   var submitMsg = "Submitting...";
					   if (settings.language !== "en" && $.ajaxChimp.translations && $.ajaxChimp
						   .translations[settings.language] && $.ajaxChimp.translations[settings
							   .language]["submit"]) {
						   submitMsg = $.ajaxChimp.translations[settings.language]["submit"]
					   }
					   label.html(submitMsg).show(2e3);
					   return false
				   })
			   });
			   return this
		   }
	   })(jQuery);
	</script>
@endsection