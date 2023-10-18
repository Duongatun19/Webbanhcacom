$(window).on('load', function() {
	$('body').addClass('loaded');
});
$(document).ready(function ($) {
	awe_backtotop();
	awe_category();
	awe_tab();
	awe_lazyloadImage();
	$('[data-toggle="tooltip"]').tooltip();
	$('.trigger-mobile').click(function(){
		$(".evo-main-nav").addClass('active');
		$(".backdrop__body-backdrop___1rvky").addClass('active');
	});
	$('.backdrop__body-backdrop___1rvky').click(function(){
		$("body").removeClass('show-search');
		$(".evo-main-nav").removeClass('active');
		$(".backdrop__body-backdrop___1rvky").removeClass('active');
	});
	$('#close-nav').click(function() {
		$(".evo-main-nav").removeClass('active');
		$(".backdrop__body-backdrop___1rvky").removeClass('active');
	});
	$(".evo-main-nav").removeClass('active');
	$(".backdrop__body-backdrop___1rvky").removeClass('active');
	$('.had-click h3').on('click', function(e){
		e.preventDefault();
		var $this = $(this);
		$(this).parent().toggleClass('active');
		return false;
	});
	$('.aside-evo .fa-chevron-down').click(function(e){
		$(this).parent().toggleClass('active');
		return false;
	});
	$('.has-childs .fa-chevron-down').click(function(e){
		$(this).parent().parent().toggleClass('active');
		return false;
	});
	$('.has-childs2 .fa-chevron-right').click(function(e){
		$(this).parent().parent().toggleClass('active');
		return false;
	});
	$('.fix-navs .hmega .fa-chevron-down').click(function(e){
		$(this).parent().toggleClass('active');
		return false;
	});
	$('.open-filters').click(function(e){
		$(this).toggleClass('open');
		$('.evo-sidebar').toggleClass('open');
	});
	$('.site-header-search').click(function(){
		$("body").addClass('show-search');
		$(".backdrop__body-backdrop___1rvky").addClass('active');
	});
	$('.site-header__search').click(function(){
		$("body").removeClass('show-search');
		$(".backdrop__body-backdrop___1rvky").removeClass('active');
	});
});
var placeholderText = ['Bạn muốn tìm gì?','Bánh quy, bánh trứng?', 'Bánh mì tươi?', 'Bánh kem tươi?', 'Khuyến mãi trong ngày?'];
$('.search-auto').placeholderTypewriter({text: placeholderText});
var Ant = {
	clone_item_view: function(product) { 
		var src = Bizweb.resizeImage(product.featured_image, 'small');
		if(src == null){
			src = "//bizweb.dktcdn.net/thumb/medium/assets/themes_support/noimage.gif";
		}
		jQuery('<div class="item">'
			   +'<div class="box-image">'
			   +'<a class="image url-product" href="'+product.url+'" title="'+product.name+'">'
			   +'<img class="image-review lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="' + src +  '" alt="'+product.name+'" />'
			   +'</a>'
			   +'</div>'
			   +'</div>').appendTo('#recent-content');
	},
	setCookiePopup: function (cvalue, exdays, nameCookie) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		$.cookie(nameCookie, cvalue, { expires: d, path: '/' });
	},
	getCookiePopup: function (nameCookie) {
		return $.cookie(nameCookie);
	}
};
$(document).on('click','.overlay, .close-popup, .btn-continue, .fancybox-close', function() {   
	hidePopup('.awe-popup'); 	
	setTimeout(function(){$('.loading').removeClass('loaded-content');},500);
	return false;
})
function awe_lazyloadImage() {
	var ll = new LazyLoad({
		elements_selector: ".lazy",
		load_delay: 500,
		threshold: 0
	});
} window.awe_lazyloadImage=awe_lazyloadImage;
function awe_showNoitice(selector) {
	$(selector).animate({right: '0'}, 500);
	setTimeout(function(){$(selector).animate({right: '-300px'}, 500);}, 3500);
}  window.awe_showNoitice=awe_showNoitice;
function awe_showLoading(selector) {
	var loading = $('.loader').html();
	$(selector).addClass("loading").append(loading); 
}  window.awe_showLoading=awe_showLoading;
function awe_hideLoading(selector) {
	$(selector).removeClass("loading"); 
	$(selector + ' .loading-icon').remove();
}  window.awe_hideLoading=awe_hideLoading;
function awe_showPopup(selector) {
	$(selector).addClass('active');
}  window.awe_showPopup=awe_showPopup;
function awe_hidePopup(selector) {
	$(selector).removeClass('active');
}  window.awe_hidePopup=awe_hidePopup;
function awe_convertVietnamese(str) { 
	str= str.toLowerCase();str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");str= str.replace(/đ/g,"d"); str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");str= str.replace(/-+-/g,"-");str= str.replace(/^\-+|\-+$/g,""); 
	return str; 
} window.awe_convertVietnamese=awe_convertVietnamese;
function awe_category(){
	$('.nav-category .Collapsible__Plus').click(function(e){
		$(this).parent().toggleClass('active');
	});
} window.awe_category=awe_category;
function awe_backtotop() { 
	if ($('.back-to-top').length) {
		var scrollTrigger = 100,
			backToTop = function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('.back-to-top').addClass('show');
				} else {
					$('.back-to-top').removeClass('show');
				}
			};
		backToTop();
		$(window).on('scroll', function () {
			backToTop();
		});
		$('.back-to-top').on('click', function (e) {
			e.preventDefault();
			$('html,body').animate({
				scrollTop: 0
			}, 700);
		});
	}
} 
window.awe_backtotop=awe_backtotop;
function awe_tab() {
	$(".e-tabs:not(.not-dqtab)").each( function(){
		$(this).find('.tabs-title li:first-child').addClass('current');
		$(this).find('.tab-content').first().addClass('current');
		$(this).find('.tabs-title li').click(function(){
			var tab_id = $(this).attr('data-tab');
			var url = $(this).attr('data-url');
			$(this).closest('.e-tabs').find('.tab-viewall').attr('href',url);
			$(this).closest('.e-tabs').find('.tabs-title li').removeClass('current');
			$(this).closest('.e-tabs').find('.tab-content').removeClass('current');
			$(this).addClass('current');
			$(this).closest('.e-tabs').find("#"+tab_id).addClass('current');
		});    
	});
} window.awe_tab=awe_tab;
$('.dropdown-toggle').click(function() {
	$(this).parent().toggleClass('open'); 	
}); 
$('.btn-close').click(function() {
	$(this).parents('.dropdown').toggleClass('open');
}); 
$('body').click(function(event) {
	if (!$(event.target).closest('.dropdown').length) {
		$('.dropdown').removeClass('open');
	};
});
$(document).on('keydown','#qty, #quantity-detail, .number-sidebar',function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
var buy_now = function(id) {
	var quantity = 1;
	var params = {
		type: 'POST',
		url: '/cart/add.js',
		data: 'quantity=' + quantity + '&variantId=' + id,
		dataType: 'json',
		success: function(line_item) {
			window.location = '/checkout';
		},
		error: function(XMLHttpRequest, textStatus) {
			Bizweb.onError(XMLHttpRequest, textStatus);
		}
	};
	jQuery.ajax(params);
}