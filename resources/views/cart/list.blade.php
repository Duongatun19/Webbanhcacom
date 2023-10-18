@extends('layouts.main.master')
@section('title')
    Giỏ hàng của bạn
@endsection
@section('description')
@endsection
@section('image')
    {{ url('' . $banners[0]->image) }}
@endsection
@section('css')
    <link href="{{ asset('frontend/css/evo-carts.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
    <script src="{{ asset('frontend/js/cart.min.js') }}"></script>
    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }
        $('.cart-product-quantity .qty').on('click', function() {
            var quantity = $(this).val();
            var id = $(this).data('id');
            var url = $('.list-cart').data('url-update');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    id: id,
                    quantity: quantity
                },
                success: function(data) {
                    let cart = data;
                    let totalPrice = 0;
                    $.each(cart, function(index, value) {
                        totalPrice += (value.price - value.price * (value.discount / 100)) *
                            value.quantity;
                    })
                    var total = formatNumber(totalPrice);
                    $('.table-cart .total-price').html(total + '₫');
                },
                error: function(data) {
                    console.log('lỗi');
                }
            })
        })
    </script>
@endsection
@section('content')
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="{{ route('home') }}" title="Trang chủ">
                        <span itemprop="name">Trang chủ</span>
                        <meta itemprop="position" content="1" />
                    </a>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>

                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <strong itemprop="name">Giỏ hàng</strong>
                    <meta itemprop="position" content="2" />
                </li>

            </ul>
        </div>
    </section>
    <div class="container white collections-container margin-bottom-20 margin-top-30">
        <div class="white-background">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        @if(count($cartcontent)>0)
                            <div class="visible-md visible-lg">
                                <div class="shopping-cart-table">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 class="lbl-shopping-cart lbl-shopping-cart-gio-hang">Giỏ hàng
                                                <span>(<span class="count_item_pr">{{count($cartcontent)}}</span> sản phẩm)</span></h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-main cart_desktop_page cart-page">
                                            <form id="shopping-cart" novalidate="" class="has-validation-callback">
                                                <div class="cart page_cart cart_des_page hidden-xs-down">
                                                    <div class="col-xs-9 cart-col-1">
                                                        <div class="cart-tbody">
                                                            @php
                                                                $totalPrice = 0;
                                                            @endphp
                                                            @foreach ($cartcontent as $item)
                                                                @php
                                                                    $discountPrice = $item['price'] - $item['price'] * ($item['discount'] / 100);
                                                                    $totalPrice += $discountPrice * $item['quantity'];
                                                                @endphp
                                                                <div class="row shopping-cart-item productid-27698914">
                                                                    <div class="col-xs-3 img-thumnail-custom">
                                                                        <p class="image">
                                                                            <a href="{{ route('detailProduct', ['cate' => $item['cate_slug'], 'slug' => $item['slug']]) }}"
                                                                                title="{{ languageName($item['name']) }}">
                                                                                <img class="img-responsive"
                                                                                    src="{{ $item['image'] }}"
                                                                                    alt="{{ languageName($item['name']) }}">
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-right col-xs-9">
                                                                        <div class="box-info-product">
                                                                            <p class="name"><a
                                                                                    href="{{ route('detailProduct', ['cate' => $item['cate_slug'], 'slug' => $item['slug']]) }}"
                                                                                    title="{{ languageName($item['name']) }}">{{ languageName($item['name']) }}</a>
                                                                            </p>

                                                                            <p class="action">
                                                                                <a href="javascript:void(0);"
                                                                                    class="btn btn-link remove-item-cart"
                                                                                    onclick="removeItemCart('{{ $item['id'] }}','{{ route('removeCart') }}')">Xóa</a>
                                                                            </p>

                                                                        </div>
                                                                        <div class="box-price">
                                                                            <p class="price pricechange">
                                                                                {{ number_format($discountPrice, 0, '', '.') }}₫
                                                                            </p>
                                                                        </div>
                                                                        <div class="quantity-block">
                                                                            <div class="input-group bootstrap-touchspin">
                                                                                <div class="input-group-btn">
                                                                                    <input class="variantID" type="hidden"
                                                                                        name="variantId"
                                                                                        value="27698914"><button
                                                                                        onclick="btnPlus('{{ $item['id'] }}','{{ route('updateCart') }}')"
                                                                                        class="increase_pop items-count btn-plus btn btn-default bootstrap-touchspin-up"
                                                                                        type="button">+</button><input
                                                                                        type="text" maxlength="12"
                                                                                        min="1" disabled=""
                                                                                        class="form-control quantity-r2 quantity js-quantity-product input-text number-sidebar input_pop input_pop qtyItem27698914"
                                                                                        id="qty{{ $item['id'] }}"
                                                                                        name="Lines" size="4"
                                                                                        value="{{ $item['quantity'] }}">
                                                                                    <button
                                                                                        onclick="btnMinus('{{ $item['id'] }}','{{ route('updateCart') }}')"
                                                                                        class="reduced_pop items-count btn-minus btn btn-default bootstrap-touchspin-down"
                                                                                        type="button">–</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3 cart-col-2 cart-collaterals cart_submit">
                                                        <div id="right-affix">
                                                            <div class="each-row">
                                                                <div class="box-style fee">
                                                                    <p class="list-info-price"><span>Tạm tính: </span><strong
                                                                            class="totals_price price _text-right text_color_right1">{{ number_format($totalPrice, 0, '', '.') }}₫</strong>
                                                                    </p>
                                                                </div>
                                                                <div class="box-style fee">
                                                                    <div class="total2 clearfix">
                                                                        <span class="text-label">Thành tiền: </span>
                                                                        <div class="amount">
                                                                            <p><strong
                                                                                    class="totals_price">{{ number_format($totalPrice, 0, '', '.') }}₫</strong>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button
                                                                    class="button btn btn-large btn-block btn-danger btn-checkout evo-button"
                                                                    title="Thanh toán ngay" type="button"
                                                                    onclick="window.location.href='{{route('checkout')}}'">Thanh toán
                                                                    ngay</button>
                                                                <button
                                                                    class="button btn-proceed-checkout btn btn-large btn-block btn-danger btn-checkouts"
                                                                    title="Tiếp tục mua hàng" type="button"
                                                                    onclick="window.location.href='{{ route('home') }}'">Tiếp
                                                                    tục
                                                                    mua hàng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="visible-sm visible-xs">
                                <div class="cart-mobile">
                                    <form class="margin-bottom-0 has-validation-callback">
                                        <div class="header-cart">
                                            <div class="title-cart clearfix">
                                                <h3>Giỏ hàng của bạn</h3>
                                            </div>
                                        </div>
                                        <div class="header-cart-content">
                                            <div class="cart_page_mobile content-product-list">
                                                @foreach ($cartcontent as $item)
                                                    @php
                                                        $discountPrice = $item['price'] - $item['price'] * ($item['discount'] / 100);
                                                        $totalPrice += $discountPrice * $item['quantity'];
                                                    @endphp
                                                    <div class="item-product item ">
                                                        <div class="item-product-cart-mobile"><a class="product-images1"
                                                                href="{{ route('detailProduct', ['cate' => $item['cate_slug'], 'slug' => $item['slug']]) }}"
                                                                title="{{ languageName($item['name']) }}"><img width="80"
                                                                    height="150" alt=""
                                                                    src="{{ $item['image'] }}"></a>
                                                        </div>
                                                        <div class="title-product-cart-mobile">
                                                            <h3><a href="{{ route('detailProduct', ['cate' => $item['cate_slug'], 'slug' => $item['slug']]) }}"
                                                                    title="{{ languageName($item['name']) }}">{{ languageName($item['name']) }}</a>
                                                            </h3>
                                                            <p>Giá: <span
                                                                    class="pricechange">{{ number_format($discountPrice, 0, '', '.') }}₫</span>
                                                            </p>
                                                        </div>
                                                        <div class="select-item-qty-mobile">
                                                            <div class="txt_center"><input class="variantID" type="hidden"
                                                                    name="variantId" value="27698914">
                                                                <button
                                                                    onclick="btnMinus('{{$item['id']}}','{{route('updateCart')}}')"
                                                                    class="reduced items-count btn-minus"
                                                                    type="button">–</button>
                                                                    <input type="text"
                                                                    maxlength="12" min="0"
                                                                    class="input-text number-sidebar qtyMobile27698914"
                                                                    id="qty{{$item['id']}}"  name="Lines" size="4"
                                                                    value="{{ $item['quantity'] }}">
                                                                <button
                                                                    onclick="btnPlus('{{$item['id']}}','{{route('updateCart')}}')"
                                                                    class="increase items-count btn-plus"
                                                                    type="button">+</button>
                                                            </div>
                                                            <a class="button remove-item remove-item-cart"
                                                                href="javascript:void(0);"
                                                                onclick="removeItemCart('{{ $item['id'] }}','{{ route('removeCart') }}')"
                                                                title="Xóa">Xoá</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="header-cart-price" style="">
                                                <div class="title-cart clearfix">
                                                    <h3 class="text-xs-left">Tổng tiền</h3>
                                                    <a class="text-xs-right totals_price_mobile"
                                                        title="{{ number_format($totalPrice, 0, '', '.') }}₫">{{ number_format($totalPrice, 0, '', '.') }}₫</a>
                                                </div>
                                                <div class="checkout"><button class="btn-proceed-checkout-mobile"
                                                        title="Thanh toán ngay" type="button"
                                                        onclick="window.location.href='{{ route('checkout') }}'"><span>Thanh
                                                            toán
                                                            ngay</span></button></div>
                                                <button class="btn btn-proceed-continues-mobile" title="Tiếp tục mua hàng"
                                                    type="button" onclick="window.location.href='{{ route('home') }}'">Tiếp
                                                    tục
                                                    mua hàng</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                        <div class="CartHeaderContainer css-card pad-20" >
                            <div class="cart--empty-message">
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" width="30px" height="30px" viewBox="0 0 201.387 201.387" style="enable-background:new 0 0 201.387 201.387;" xml:space="preserve">
                                  <g>
                                  <g>
                                        <path d="M129.413,24.885C127.389,10.699,115.041,0,100.692,0C91.464,0,82.7,4.453,77.251,11.916    c-1.113,1.522-0.78,3.657,0.742,4.77c1.517,1.109,3.657,0.78,4.768-0.744c4.171-5.707,10.873-9.115,17.93-9.115    c10.974,0,20.415,8.178,21.963,19.021c0.244,1.703,1.705,2.932,3.376,2.932c0.159,0,0.323-0.012,0.486-0.034    C128.382,28.479,129.679,26.75,129.413,24.885z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M178.712,63.096l-10.24-17.067c-0.616-1.029-1.727-1.657-2.927-1.657h-9.813c-1.884,0-3.413,1.529-3.413,3.413    s1.529,3.413,3.413,3.413h7.881l6.144,10.24H31.626l6.144-10.24h3.615c1.884,0,3.413-1.529,3.413-3.413s-1.529-3.413-3.413-3.413    h-5.547c-1.2,0-2.311,0.628-2.927,1.657l-10.24,17.067c-0.633,1.056-0.648,2.369-0.043,3.439s1.739,1.732,2.97,1.732h150.187    c1.231,0,2.364-0.662,2.97-1.732S179.345,64.15,178.712,63.096z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M161.698,31.623c-0.478-0.771-1.241-1.318-2.123-1.524l-46.531-10.883c-0.881-0.207-1.809-0.053-2.579,0.423    c-0.768,0.478-1.316,1.241-1.522,2.123l-3.509,15c-0.43,1.835,0.71,3.671,2.546,4.099c1.835,0.43,3.673-0.71,4.101-2.546    l2.732-11.675l39.883,9.329l-6.267,26.795c-0.43,1.835,0.71,3.671,2.546,4.099c0.263,0.061,0.524,0.09,0.782,0.09    c1.55,0,2.953-1.062,3.318-2.635l7.045-30.118C162.328,33.319,162.176,32.391,161.698,31.623z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M102.497,39.692l-3.11-26.305c-0.106-0.899-0.565-1.72-1.277-2.28c-0.712-0.56-1.611-0.816-2.514-0.71l-57.09,6.748    c-1.871,0.222-3.209,1.918-2.988,3.791l5.185,43.873c0.206,1.737,1.679,3.014,3.386,3.014c0.133,0,0.27-0.009,0.406-0.024    c1.87-0.222,3.208-1.918,2.988-3.791l-4.785-40.486l50.311-5.946l2.708,22.915c0.222,1.872,1.91,3.202,3.791,2.99    C101.379,43.261,102.717,41.564,102.497,39.692z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M129.492,63.556l-6.775-28.174c-0.212-0.879-0.765-1.64-1.536-2.113c-0.771-0.469-1.696-0.616-2.581-0.406L63.613,46.087    c-1.833,0.44-2.961,2.284-2.521,4.117l3.386,14.082c0.44,1.835,2.284,2.964,4.116,2.521c1.833-0.44,2.961-2.284,2.521-4.117    l-2.589-10.764l48.35-11.626l5.977,24.854c0.375,1.565,1.775,2.615,3.316,2.615c0.265,0,0.533-0.031,0.802-0.096    C128.804,67.232,129.932,65.389,129.492,63.556z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M179.197,64.679c-0.094-1.814-1.592-3.238-3.41-3.238H25.6c-1.818,0-3.316,1.423-3.41,3.238l-6.827,133.12    c-0.048,0.934,0.29,1.848,0.934,2.526c0.645,0.677,1.539,1.062,2.475,1.062h163.84c0.935,0,1.83-0.384,2.478-1.062    c0.643-0.678,0.981-1.591,0.934-2.526L179.197,64.679z M22.364,194.56l6.477-126.293h143.701l6.477,126.293H22.364z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M126.292,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C136.532,79.686,131.939,75.093,126.292,75.093z M126.292,88.747c-1.883,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    c1.882,0,3.413,1.531,3.413,3.413S128.174,88.747,126.292,88.747z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M75.092,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C85.332,79.686,80.739,75.093,75.092,75.093z M75.092,88.747c-1.882,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    s3.413,1.531,3.413,3.413S76.974,88.747,75.092,88.747z"></path>
                                  </g>
                                  </g>
                                  <g>
                                  <g>
                                        <path d="M126.292,85.333h-0.263c-1.884,0-3.413,1.529-3.413,3.413c0,0.466,0.092,0.911,0.263,1.316v17.457    c0,12.233-9.953,22.187-22.187,22.187s-22.187-9.953-22.187-22.187V88.747c0-1.884-1.529-3.413-3.413-3.413    s-3.413,1.529-3.413,3.413v18.773c0,15.998,13.015,29.013,29.013,29.013s29.013-13.015,29.013-29.013V88.747    C129.705,86.863,128.176,85.333,126.292,85.333z"></path>
                                  </g>
                                  </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                                  <g> </g>
                               </svg>
                               <p>Không có sản phẩm nào trong giỏ hàng</p>
                            </div>
                      </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var name_pro = '';
            var alias_pro = '';
            var featured_image_pro = '';
            var url_pro = '';
            var variant_id_pro = '';

            var price_pro = 'Liên hệ';


            var price_sale_pro = '';
            var hasSale_pro = 'false';
            var percent_sale_pro = '';

            var array_list = [{
                'name': name_pro,
                'alias': alias_pro,
                'featured_image': featured_image_pro,
                'url': url_pro,
                'variant_id': variant_id_pro,
                'price': price_pro,
                'compare_at_price': price_sale_pro,
                'hasSale': hasSale_pro,
                'percent_sale': percent_sale_pro
            }];
            var list_viewed_pro_old = localStorage.getItem('last_viewed_products');
            var last_viewed_pro_new = "";
            if (list_viewed_pro_old == null || list_viewed_pro_old == '')
                last_viewed_pro_new = array_list;
            else {
                var list_viewed_pro_old = JSON.parse(localStorage.last_viewed_products);
                list_viewed_pro_old.splice(20, 1);
                for (i = 0; i < list_viewed_pro_old.length; i++) {
                    if (list_viewed_pro_old[i].alias == alias_pro) {
                        list_viewed_pro_old.splice(i, 1);
                        break;
                    }
                }
                list_viewed_pro_old.unshift(array_list[0]);
                last_viewed_pro_new = list_viewed_pro_old;
            }
            localStorage.setItem('last_viewed_products', JSON.stringify(last_viewed_pro_new));
            var last_viewd_pro_array = JSON.parse(localStorage.last_viewed_products);

            var size_pro_review = last_viewd_pro_array.length;
            if (size_pro_review >= 14) {
                size_pro_review = 14;
            } else {
                size_pro_review = last_viewd_pro_array.length;
            }
            if (size_pro_review < 2) {
                jQuery('.recent_products-row').addClass('hidden');
            } else {
                jQuery('.no-recently').addClass('hidden');
            }
            if (size_pro_review > 0) {
                for (i = 0; i < size_pro_review; i++) {
                    var alias_product = last_viewd_pro_array[i];
                    if (!!alias_product.alias) {
                        Ant.clone_item_view(alias_product);
                    }
                }
            }
            $('#recent-content').slick({
                dots: true,
                arrows: false,
                infinite: false,
                speed: 300,
                slidesToShow: 10,
                slidesToScroll: 10,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 10,
                            slidesToScroll: 10
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            dots: true
                        }
                    }
                ]
            });
        });
    </script>
@endsection
