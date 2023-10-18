@extends('layouts.main.master')
@section('title')
Kết quả tìm kiếm
@endsection
@section('description')
Đã tìm thấy {{$countproduct}} kết quả phù hợp cho từ khóa "{{$keyword}}"
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link href="{{asset('frontend/css/breadcrumb_style.scss.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('frontend/css/sidebar_style.scss.css')}}" rel="stylesheet" type="text/css" />	
<link href="{{asset('frontend/css/collection_style.scss.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('js')
@endsection
@section('content')
<div class="bodywrap">
	<div class="layout-collection">
	   <section class="bread-crumb">
		  <div class="container">
			 <ul class="breadcrumb" >
				<li class="home">
				   <a  href="/" ><span >Trang chủ</span></a>						
				   <span class="mr_lr">&nbsp;/&nbsp;</span>
				</li>
	
			 <li><strong ><span>Kết quả</span></strong></li>
  
 
			 </ul>
		  </div>
	   </section>
	   <div class="container">
		  <div class="row margin-10-">
			 <aside class="dqdt-sidebar sidebar col-lg-3 col-12 padding-10">
				<div class="aside-content aside-cate">
				   <div class="title-head">
					  Danh mục sản phẩm
				   </div>
				   <nav class="nav-category">
					  <ul class="nav navbar-pills">
						 @foreach ($categoryProduct as $cate)
							<li class="nav-item  relative">
							   <a title="{{languageName($cate->name)}}" class="nav-link" href="{{route('allListProCate',['cate'=>$cate->slug])}}">{{languageName($cate->name)}}</a>
							</li>   
						 @endforeach
					  </ul>
				   </nav>
				</div>
				<script>
				   $(".open_mnu").click(function(){
					  $(this).toggleClass('cls_mn').next().slideToggle();
				   });
				</script>
				<link rel="preload" as="script" href="//bizweb.dktcdn.net/100/449/923/themes/875305/assets/search_filter.js?1670831590614" />
				<script src="//bizweb.dktcdn.net/100/449/923/themes/875305/assets/search_filter.js?1670831590614" type="text/javascript"></script>
				<div class="aside-filter clearfix">
				   <div class="aside-hidden-mobile">
					  <div class="filter-container">
					   
						 <div class="clearfix"></div>
						 <aside class="aside-item filter-vendor">
							<div class="aside-title">Thương hiệu 
							   <span class="nd-svg collapsible-plus">
							   </span>
							</div>
							<div class="aside-content filter-group">
							   <ul class="filter-vendor">
								  @foreach ($brands as $brand)
									 <li class="filter-item filter-item--check-box filter-item--green ">
										<label data-filter="apple" for="filter-apple" class="apple">
										<input type="checkbox" id="filter-apple" onchange="toggleFilter(this)"  data-group="Hãng" data-field="vendor.filter_key" data-text="Apple" value="(&#34;Apple&#34;)" data-operator="OR">
										<i class="fa"></i>
										{{ $brand->name}}
										</label>
									 </li>
								  @endforeach
							   
							   </ul>
							</div>
						 </aside>
						 <aside class="aside-item filter-tag-style-1 tag-color">
							<div class="aside-title">Màu sắc 
							   <span class="nd-svg collapsible-plus">
							   </span>
							</div>
							<div class="aside-content filter-group">
							   <ul>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-trang">
									 <input type="checkbox" id="filter-trang"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Trắng" value="(&#34;Trắng&#34;)" data-operator="OR">
									 <i class="fa trang" style="background-color:#ffffff;border:1px solid #ebebeb;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-vang">
									 <input type="checkbox" id="filter-vang"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Vàng" value="(&#34;Vàng&#34;)" data-operator="OR">
									 <i class="fa vang" style="background-color:#F1C40F;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-tim">
									 <input type="checkbox" id="filter-tim"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Tím" value="(&#34;Tím&#34;)" data-operator="OR">
									 <i class="fa tim" style="background-color:#9B59B6;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-do">
									 <input type="checkbox" id="filter-do"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Đỏ" value="(&#34;Đỏ&#34;)" data-operator="OR">
									 <i class="fa do" style="background-color:#E74C3C;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-xanh">
									 <input type="checkbox" id="filter-xanh"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Xanh" value="(&#34;Xanh&#34;)" data-operator="OR">
									 <i class="fa xanh" style="background-color:#2ECC71;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-hong">
									 <input type="checkbox" id="filter-hong"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Hồng" value="(&#34;Hồng&#34;)" data-operator="OR">
									 <i class="fa hong" style="background-color:#FF00CC;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-cam">
									 <input type="checkbox" id="filter-cam"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Cam" value="(&#34;Cam&#34;)" data-operator="OR">
									 <i class="fa cam" style="background-color:#E67E22;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-den">
									 <input type="checkbox" id="filter-den"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Đen" value="(&#34;Đen&#34;)" data-operator="OR">
									 <i class="fa den" style="background-color:#333333;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-ghi">
									 <input type="checkbox" id="filter-ghi"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Ghi" value="(&#34;Ghi&#34;)" data-operator="OR">
									 <i class="fa ghi" style="background-color:#bcbbc0;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-xanh-bien">
									 <input type="checkbox" id="filter-xanh-bien"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Xanh biển" value="(&#34;Xanh biển&#34;)" data-operator="OR">
									 <i class="fa xanh-bien" style="background-color:#0082be;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-tim-than">
									 <input type="checkbox" id="filter-tim-than"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Tím than" value="(&#34;Tím than&#34;)" data-operator="OR">
									 <i class="fa tim-than" style="background-color:#2c3552;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-xanh-reu">
									 <input type="checkbox" id="filter-xanh-reu"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Xanh rêu" value="(&#34;Xanh rêu&#34;)" data-operator="OR">
									 <i class="fa xanh-reu" style="background-color:#8b9d5f;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-xanh-da-troi">
									 <input type="checkbox" id="filter-xanh-da-troi"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Xanh da trời" value="(&#34;Xanh da trời&#34;)" data-operator="OR">
									 <i class="fa xanh-da-troi" style="background-color:#88c9dd;"></i>
									 </label>
									 </span>
								  </li>
								  <li class="filter-item color filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-hong-sen">
									 <input type="checkbox" id="filter-hong-sen"  onchange="toggleFilter(this)" data-group="tag1" data-field="tags" data-text="Hồng sen" value="(&#34;Hồng sen&#34;)" data-operator="OR">
									 <i class="fa hong-sen" style="background-color:#e67d9e;"></i>
									 </label>
									 </span>
								  </li>
							   </ul>
							</div>
						 </aside>
						 <aside class="aside-item filter-price">
							<div class="aside-title">Chọn mức giá 
							   <span class="nd-svg collapsible-plus">
							   </span>
							</div>
							<div class="aside-content filter-group">
							   <ul>
								  <li class="filter-item filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-duoi-2-000-000d">
									 <input type="checkbox" id="filter-duoi-2-000-000d" onchange="toggleFilter(this);" data-group="Khoảng giá" data-field="price_min" data-text="Dưới 2.000.000đ" value="(<2000000)" data-operator="OR">
									 <i class="fa"></i>
									 Giá dưới 2.000.000đ
									 </label>
									 </span>
								  </li>
								  <li class="filter-item filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-2-000-000d-4-000-000d">
									 <input type="checkbox" id="filter-2-000-000d-4-000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="price_min" data-text="2.000.000đ - 4.000.000đ" value="(>2000000 AND <4000000)" data-operator="OR">
									 <i class="fa"></i>
									 2.000.000đ - 4.000.000đ							
									 </label>
									 </span>
								  </li>
								  <li class="filter-item filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-4-000-000d-7-000-000d">
									 <input type="checkbox" id="filter-4-000-000d-7-000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="price_min" data-text="4.000.000đ - 7.000.000đ" value="(>4000000 AND <7000000)" data-operator="OR">
									 <i class="fa"></i>
									 4.000.000đ - 7.000.000đ							
									 </label>
									 </span>
								  </li>
								  <li class="filter-item filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-7-000-000d-13-000-000d">
									 <input type="checkbox" id="filter-7-000-000d-13-000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="price_min" data-text="7.000.000đ - 13.000.000đ" value="(>7000000 AND <13000000)" data-operator="OR">
									 <i class="fa"></i>
									 7.000.000đ - 13.000.000đ							
									 </label>
									 </span>
								  </li>
								  <li class="filter-item filter-item--check-box filter-item--green">
									 <span>
									 <label for="filter-tren13-000-000d">
									 <input type="checkbox" id="filter-tren13-000-000d" onchange="toggleFilter(this)" data-group="Khoảng giá" data-field="price_min" data-text="Trên 13.000.000đ" value="(>13000000)" data-operator="OR">
									 <i class="fa"></i>
									 Giá trên 13.000.000đ
									 </label>
									 </span>
								  </li>
							   </ul>
							</div>
						 </aside>
					  </div>
				   </div>
				</div>
				<script>
				   var Ego = {};
				   var selectedSortby;
				   var tt = 'Thứ tự';
				   var selectedViewData = "data";
				   var filter = new Bizweb.SearchFilter()
				   
				   filter.addValue("collection", "collections", "2906169", "AND");
							   
							   function toggleFilter(e) {
					  _toggleFilter(e);
					  renderFilterdItems();
					  doSearch(1);
				   }
				   function _toggleFilterdqdt(e) {
					  var $element = $(e);
					  var group = 'Khoảng giá';
					  var field = 'price_min';
					  var operator = 'OR';	 
					  var value = $element.attr("data-value");	
					  filter.deleteValuedqdt(group, field, value, operator);
					  filter.addValue(group, field, value, operator);
					  renderFilterdItems();
					  doSearch(1);
				   }
				   function _toggleFilter(e) {
					  var $element = $(e);
					  var group = $element.attr("data-group");
					  var field = $element.attr("data-field");
					  var text = $element.attr("data-text");
					  var value = $element.attr("value");
					  var operator = $element.attr("data-operator");
					  var filterItemId = $element.attr("id");
				   
					  if (!$element.is(':checked')) {
						 filter.deleteValue(group, field, value, operator);
					  }
					  else{
						 filter.addValue(group, field, value, operator);
					  }
				   
					  $(".catalog_filters li[data-handle='" + filterItemId + "']").toggleClass("active");
				   }
				   function renderFilterdItems() {
					  var $container = $(".filter-container__selected-filter-list ul");
					  $container.html("");
				   
					  $(".filter-container input[type=checkbox]").each(function(index) {
						 if ($(this).is(':checked')) {
							var id = $(this).attr("id");
							var name = $(this).closest("label").text();
							addFilteredItem(name, id);
						 }
					  });
				   
					  if($(".aside-content input[type=checkbox]:checked").length > 0)
						 $(".filter-container__selected-filter").show();
					  else
						 $(".filter-container__selected-filter").hide();
				   }
				   function addFilteredItem(name, id) {
					  var filteredItemTemplate = "<li class='filter-container__selected-filter-item' for='{3}'><a href='javascript:void(0)' onclick=\"{0}\"><i class='fa'></i> {1}</a></li>";
					  filteredItemTemplate = filteredItemTemplate.replace("{0}", "removeFilteredItem('" + id + "')");
					  filteredItemTemplate = filteredItemTemplate.replace("{1}", name);
					  filteredItemTemplate = filteredItemTemplate.replace("{3}", id);
					  var $container = $(".filter-container__selected-filter-list ul");
					  $container.append(filteredItemTemplate);
				   }
				   function removeFilteredItem(id) {
					  $(".filter-container #" + id).trigger("click");
				   }
				   function filterItemInList(object) {
					  q = object.val().toLowerCase();
					  object.parent().next().find('li').show();
					  if (q.length > 0) {
						 object.parent().next().find('li').each(function() {
							if ($(this).find('label').attr("data-filter").indexOf(q) == -1)
							   $(this).hide();
						 })
					  }
				   }
				   
				   function clearAllFiltered() {
					  filter = new Bizweb.SearchFilter();
					  
					  filter.addValue("collection", "collections", "2906169", "AND");
								  
				   
								  $(".filter-container__selected-filter-list ul").html("");
					  $(".filter-container input[type=checkbox]").attr('checked', false);
					  $(".filter-container__selected-filter").hide();
				   
					  doSearch(1);
				   }
				   function doSearch(page, options) {
					  if(!options) options = {};
					  //NProgress.start();
					  $('.aside.aside-mini-products-list.filter').removeClass('active');
					  awe_showPopup('.loading');
					  filter.search({
						 view: selectedViewData,
						 page: page,
						 sortby: selectedSortby,
						 success: function (html) {
							var $html = $(html);
							// Muốn thay thẻ DIV nào khi filter thì viết như này
							var $categoryProducts = $($html[0]); 
							$(".category-products").html($categoryProducts.html());
							pushCurrentFilterState({sortby: selectedSortby, page: page});
							awe_hidePopup('.loading');
							awe_lazyloadImage();
							Ego.Wishlist.wishlistProduct();
				   
							var modal = $('.quickview-product');
							var btn = $('.quick-view');
							var span = $('.quickview-close');
				   
							btn.click(function () {
							   modal.show();
							});
				   
							span.click(function () {
							   modal.hide();
							});
				   
							$(window).on('click', function (e) {
							   if ($(e.target).is('.modal')) {
								  modal.hide();
							   }
							});
				   
							$(".swatch").each(function(index, elem) {
							   var scrapImg = $(this).find(".swatch-element");
							   if(scrapImg.length > 3 ) {
								  var number = scrapImg.length-3;
								  $(this).attr('number',number);
								  $(this).append('<span class="btn-num">+'+ number +'</span>');
								  console.log($(this), number);
							   }
				   
							});
							$(".col-item .thumbs-list .thumbs-list-item img").hover(function () {
							   var t = $(this).attr("data-img");
							   $(this).parent().siblings().removeClass("active"), $(this).parent().addClass("active");
							   var e = $(this).parents(".col-item").find(".product-thumb img");
							   e && $(e).attr("src", t);
							});
							$('.add_to_cart').click(function(e){	
							   e.preventDefault();		
							   var $this = $(this);
							   var form = $this.parents('form');	
							   $.ajax({
								  type: 'POST',
								  url: '/cart/add.js',
								  async: false,
								  data: form.serialize(),
								  dataType: 'json',
								  beforeSend: function() { },
								  success: function(line_item) {
									 $('.cart-popup-name').html(line_item.title).attr('href', line_item.url, 'title', line_item.title);
									 ajaxCart.load();
									 $('#popup-cart-desktop, .cart-sidebar, .backdrop__body-backdrop___1rvky').addClass('active');
								  },
								  cache: false
							   });
							});
							$('html, body').animate({
							   scrollTop: $('.category-products').offset().top
							}, 0);
							resortby(selectedSortby);
							if (window.BPR !== undefined){
							   return window.BPR.initDomEls(), window.BPR.loadBadges();
							}
						 }
					  });		
				   }
				   function sortby(sort) {		
					  $('.sort-cate-left li').removeClass('active');
					  switch(sort) {
						 case "price-asc":
							selectedSortby = "price_min:asc";					   
							break;
						 case "price-desc":
							selectedSortby = "price_min:desc";
							break;
						 case "alpha-asc":
							selectedSortby = "name:asc";
							break;
						 case "alpha-default":
							selectedSortby = "name:default";
							break;
						 case "alpha-desc":
							selectedSortby = "name:desc";
							break;
						 case "created-desc":
							selectedSortby = "created_on:desc";
							break;
						 case "created-asc":
							selectedSortby = "created_on:asc";
							break;
						 default:
							selectedSortby = "";
							break;
					  }
				   
					  doSearch(1);
				   }
				   function resortby(sort) {
					  switch(sort) {				  
						 case "price_min:asc":
							tt = "Giá tăng dần";
							$('.sort-cate-left .price-asc').addClass("active");
							break;
						 case "price_min:desc":
							tt = "Giá giảm dần";
							$('.sort-cate-left .price-desc').addClass("active");
							break;
						 case "name:asc":
							tt = "A → Z";
							$('.sort-cate-left .alpha-asc').addClass("active");
							break;
						 case "name:default":
							tt = "Mặc định";
							$('.sort-cate-left .alpha-default').addClass("active");
							break;
						 case "name:desc":
							tt = "Z → A";
							$('.sort-cate-left .alpha-desc').addClass("active");
							break;
						 case "created_on:desc":
							tt = "Hàng mới nhất";
							$('.sort-cate-left .position-desc').addClass("active");
							break;
						 case "created_on:asc":
							tt = "Hàng cũ nhất";
							break;
						 default:
							tt = "Mặc định";
							$('.sort-cate-left .default').addClass("active");
							break;
					  }			   
					  $('#sort-by > ul > li > span').html(tt);
				   }
				   function _selectSortby(sort) {			 
					  resortby(sort);
					  switch(sort) {
						 case "price-asc":
							selectedSortby = "price_min:asc";
							break;
						 case "price-desc":
							selectedSortby = "price_min:desc";
							break;
						 case "alpha-asc":
							selectedSortby = "name:asc";
							break;
						 case "alpha-default":
							selectedSortby = "name:default";
							break;
						 case "alpha-desc":
							selectedSortby = "name:desc";
							break;
						 case "created-desc":
							selectedSortby = "created_on:desc";
							break;
						 case "created-asc":
							selectedSortby = "created_on:asc";
							break;
						 default:
							selectedSortby = sort;
							break;
					  }
				   }
				   function toggleCheckbox(id) {
					  $(id).click();
				   }
				   function pushCurrentFilterState(options) {
					  if(!options) options = {};
					  var url = filter.buildSearchUrl(options);
					  var queryString = url.slice(url.indexOf('?'));			  
					  if(selectedViewData == 'data_list'){
						 queryString = queryString + '&view=list';				 
					  }
					  else{
						 queryString = queryString + '&view=grid';				   
					  }
					  pushState(queryString);
				   }
				   function pushState(url) {
					  window.history.pushState({
						 turbolinks: true,
						 url: url
					  }, null, url)
				   }
				   function switchView(view) {			  
					  switch(view) {
						 case "list":
							selectedViewData = "data_list";					   
							break;
						 default:
							selectedViewData = "data";
							break;
					  }			   
					  var url = window.location.href;
					  var page = getParameter(url, "page");
					  if(page != '' && page != null){
						 doSearch(page);
					  }else{
						 doSearch(1);
					  }
				   }
				   function selectFilterByCurrentQuery() {
					  awe_lazyloadImage();
					  var isFilter = false;
					  var url = window.location.href;
					  var queryString = decodeURI(window.location.search);
					  var filters = queryString.match(/\(.*?\)/g);
					  var page = 0;
					  if(queryString) {
						 isFilter = true;
						 $.urlParam = function(name){
							var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
							return results[1] || 0;
						 }
						 page = $.urlParam('page');
					  }
					  if(filters && filters.length > 0) {
						 filters.forEach(function(item) {
							item = item.replace(/\(\(/g, "(");
							var element = $(".aside-content input[value='" + item + "']");
							element.attr("checked", "checked");
							_toggleFilter(element);
						 });
				   
						 isFilter = true;
					  }
					  var sortOrder = getParameter(url, "sortby");
					  if(sortOrder) {
						 _selectSortby(sortOrder);
					  }
					  if(isFilter) {
						 doSearch(page);
						 renderFilterdItems();
					  }
				   }
				   function getParameter(url, name) {
					  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
					  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
						 results = regex.exec(url);
					  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
				   }
				   
				   $(document).ready(function(){
					  $(window).on('popstate', function(){
						 location.reload(true);
					  });
					  selectFilterByCurrentQuery();
					  $('.filter-container .aside-item').click( function(){
						 if ($(this).hasClass('active')){
							$(this).removeClass('active');
						 }else{
							$('.filter-container .aside-item.active').removeClass('active');
							$(this).addClass('active');    
						 }
					  });
				   
					  $('#show-admin-bar').click(function(e){
						 $('.aside.aside-mini-products-list.filter').toggleClass('active');
					  });
					  $('.filter-container__selected-filter-header-title').click(function(e){
						 $('.aside.aside-mini-products-list.filter').toggleClass('active');
					  });
				   
					  $('.aside-filter .aside-hidden-mobile .aside-item .aside-title').on('click', function(e){
						 e.preventDefault();
						 var $this = $(this);
						 $this.parents('.aside-filter .aside-hidden-mobile .aside-item').find('.aside-content').stop().slideToggle();
						 $(this).toggleClass('active');
						 return false;
					  });
					  $('.open-filters').click(function(e){
						 e.stopPropagation();
						 $(this).toggleClass('openf');
						 $('.dqdt-sidebar').toggleClass('openf');
						 $('.opacity_sidebar').toggleClass('openf');
					  });
					  $('.opacity_sidebar').click(function(e){
						 $('.opacity_sidebar').removeClass('openf');
						 $('.dqdt-sidebar, .open-filters').removeClass('openf')
					  });
					  
				   
				   });
				   
				   
				</script>			
			 </aside>
			 <div class="block-collection col-lg-9 col-12 padding-10">
				
				<div class="banner-collection">
					<h3>Kết quả tìm kiếm :</h3>
				</div>
				<div class="category-products">
				   <div class="products-view products-view-grid list_hover_pro">
					  <div class="row margin">
						 @foreach ($resultPro as $pro)
						 <div class="col-6 col-xl-3 col-lg-4 col-md-4 padding">
							@include('layouts.product.item',['product'=>$pro])
						 </div>
						 @endforeach
						 
				   
					  </div>
				   </div>
				   
				</div>
			 </div>
		  </div>
		  <div id="open-filters" class="open-filters d-lg-none d-xl-none">
			 <i class="fa fa-filter"></i>
			 <span>Lọc</span>
		  </div>
	   </div>
	</div>
	<div class="opacity_sidebar"></div>
	<script>
	   var colName = "Điện thoại";
	   
	   var colId = 2906169;
	   
	   var selectedViewData = "data";
	</script>
	<script>
	   (function($){"use strict";$.ajaxChimp={responses:{"We have sent you a confirmation email":0,"Please enter a valueggg":1,"An email address must contain a single @":2,"The domain portion of the email address is invalid (the portion after the @: )":3,"The username portion of the email address is invalid (the portion before the @: )":4,"This email address looks fake or invalid. Please enter a real email address":5},translations:{en:null},init:function(selector,options){$(selector).ajaxChimp(options)}};$.fn.ajaxChimp=function(options){$(this).each(function(i,elem){var form=$(elem);var email=form.find("input[type=email]");var label=form.find("label[for="+email.attr("id")+"]");var settings=$.extend({url:form.attr("action"),language:"en"},options);var url=settings.url.replace("/post?","/post-json?").concat("&c=?");form.attr("novalidate","true");email.attr("name","EMAIL");form.submit(function(){var msg;function successCallback(resp){if(resp.result==="success"){msg="We have sent you a confirmation email";label.removeClass("error").addClass("valid");email.removeClass("error").addClass("valid")}else{email.removeClass("valid").addClass("error");label.removeClass("valid").addClass("error");var index=-1;try{var parts=resp.msg.split(" - ",2);if(parts[1]===undefined){msg=resp.msg}else{var i=parseInt(parts[0],10);if(i.toString()===parts[0]){index=parts[0];msg=parts[1]}else{index=-1;msg=resp.msg}}}catch(e){index=-1;msg=resp.msg}}if(settings.language!=="en"&&$.ajaxChimp.responses[msg]!==undefined&&$.ajaxChimp.translations&&$.ajaxChimp.translations[settings.language]&&$.ajaxChimp.translations[settings.language][$.ajaxChimp.responses[msg]]){msg=$.ajaxChimp.translations[settings.language][$.ajaxChimp.responses[msg]]}label.html(msg);label.show(2e3);if(settings.callback){settings.callback(resp)}}var data={};var dataArray=form.serializeArray();$.each(dataArray,function(index,item){data[item.name]=item.value});$.ajax({url:url,data:data,success:successCallback,dataType:"jsonp",error:function(resp,text){console.log("mailchimp ajax submit error: "+text)}});var submitMsg="Submitting...";if(settings.language!=="en"&&$.ajaxChimp.translations&&$.ajaxChimp.translations[settings.language]&&$.ajaxChimp.translations[settings.language]["submit"]){submitMsg=$.ajaxChimp.translations[settings.language]["submit"]}label.html(submitMsg).show(2e3);return false})});return this}})(jQuery);
	</script>
@endsection