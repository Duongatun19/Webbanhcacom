@if (count($cart)>0)
<div class="header-popcart " >
    <div class="top-cart-header">
        <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16">
            <path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" class=""></path>
            </svg>
            Bạn đã thêm [<a class="cart-popup-name" href="">{{languageName($cartItemName)}}</a>] vào giỏ hàng
        </span>
    </div>
    <a class="noti-cart-count" href="/cart" title="Giỏ hàng">
    Giỏ hàng của bạn hiện có <span class="count_item_pr">{{count($cart)}}</span> loại sản phẩm
    </a>
    <a title="Đóng" class="cart_btn-close" href="javascript:;" onclick="removePopup()">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 365.696 365.696" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
            <path xmlns="http://www.w3.org/2000/svg" d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" fill="#ffffff" data-original="#000000" style="" class=""></path>
            </g>
        </svg>
    </a>
</div>
<div class="cartPopupContainer">
    <form  novalidate="" class="cart ajaxcart cartpopup">
        <div class="cart-header-info">
            <div>Thông tin sản phẩm</div>
            <div>Đơn giá</div>
            <div>Số lượng</div>
            <div>Thành tiền</div>
        </div>
        <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
            <div class="ajaxcart__row data-update-cart" data-url="{{route('updateCart')}}">
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($cart as $item)
                    @php
                        $discountPrice = $item['price'] - $item['price'] * ($item['discount'] / 100);
                        $totalPrice += $discountPrice * $item['quantity'];
                    @endphp
                    <div class="ajaxcart__product cart_product" data-line="1">
                        <a href="" class="ajaxcart__product-image cart_image" title="{{languageName($item['name'])}}"><img width="80" height="80" src="{{$item['image']}}" alt="{{languageName($item['name'])}}"></a>
                        <div class="grid__item cart_info">
                            <div class="ajaxcart__product-name-wrapper cart_name">
                                <a href="" class="ajaxcart__product-name h4" title="{{languageName($item['name'])}}">{{languageName($item['name'])}}</a>
                                @if(($item['color']) != '')
                                <span class="ajaxcart__product-meta variant-title">
                                    {{$item['color']}}
                                </span>
                                @endif
                                <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:;" onclick="removeItemCart({{$item['id']}})" data-url="{{route('removeCart')}}">Xóa</a>
                            </div>
                            <div class="grid">
                                <div class="grid__item one-half text-right cart_prices">
                                <span class="cart-price">{{number_format($discountPrice,0,'','.')}}₫</span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="grid__item one-half cart_select">
                                <div class="ajaxcart__qty input-group-btn">
                                    <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count" aria-label="-" onclick="btnMinus({{$item['id']}})">
                                    -
                                    </button>
                                    <input type="text" name="updates[]" id="qty{{$item['id']}}" class="ajaxcart__qty-num number-sidebar qty{{$item['id']}}" maxlength="3" value="{{$item['quantity']}}" min="0" aria-label="quantity" pattern="[0-9]*">
                                    <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count"  aria-label="+" onclick="btnPlus({{$item['id']}})">
                                    +							
                                    </button>
                                </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="grid__item one-half text-right cart_prices">
                                <span class="cart-price">{{number_format($discountPrice*$item['quantity'], 0, '', '.')}}₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
            <div class="row">
            <div class="col-lg-4 col-12 offset-md-8 offset-lg-8 offset-xl-8">
                <div class="ajaxcart__subtotal">
                    <div class="cart__subtotal">
                        <div class="cart__col-6">Tổng tiền:</div>
                        <div class="text-right cart__totle"><span class="total-price">{{number_format($totalPrice,0 ,'','.')}}₫</span></div>
                    </div>
                </div>
                <div class="cart__btn-proceed-checkout-dt">
                    <button onclick="location.href='{{route('checkout')}}'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                </div>
            </div>
            </div>
        </div>
    </form>
</div>      
@else
<div class="header-popcart " >
    <div class="top-cart-header">
        <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16">
            <path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" class=""></path>
            </svg>
            Bạn đã thêm [<a class="cart-popup-name" href="">{{languageName($cartItemName)}}</a>] vào giỏ hàng
        </span>
    </div>
    <a class="noti-cart-count" href="/cart" title="Giỏ hàng">
    Giỏ hàng của bạn hiện có <span class="count_item_pr">{{count($cart)}}</span> loại sản phẩm
    </a>
    <a title="Đóng" class="cart_btn-close" href="javascript:;" onclick="removePopup()">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="512" height="512" x="0" y="0" viewBox="0 0 365.696 365.696" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
            <g>
            <path xmlns="http://www.w3.org/2000/svg" d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" fill="#ffffff" data-original="#000000" style="" class=""></path>
            </g>
        </svg>
    </a>
</div>
@endif



