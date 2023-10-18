$(document).ready(function ($) {
	$('.home-slider').slick({
		lazyLoad: 'ondemand',
		autoplay: true,
		autoplaySpeed: 6000,
		fade: true,
		cssEase:'linear',
		dots: true,
		arrows: false,
		infinite: true
	});
	$('.evo-owl-cate').slick({
		dots: true,
		arrows: false,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 5000,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToScroll: 3,
					slidesToShow: 3,
					centerMode: false
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToScroll: 1,
					centerMode: true,
					centerPadding: '90px',
					slidesToShow: 1
				}
			},
			{
				breakpoint: 325,
				settings: {
					slidesToScroll: 1,
					centerMode: true,
					centerPadding: '70px',
					slidesToShow: 1
				}
			}
		]
	});
	$('.evo-block-product-slick').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
		]
	});
	$('.evo-block-product-slick-new').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
	$('.evo-owl-blog').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 3,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 991,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});
});