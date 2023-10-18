<section class="product-special-home mt-2">
    <div class="container">
    <div class="bg-white">
        <div class="h-title">
            <h2 class="position-relative"> 
                    <img src="{{url('frontend/images/christmas-bag.png')}}" alt="Giá sốc quà ngon" style="margin-right: 10px;margin-top: -3px;">
                    Sản Phẩm Khuyến Mãi Cực Sốc
            </h2>
            <div class="sub-category">
                @foreach ($categoryhome as $key=>$category)
                <a href="javascript:void(0)" data-id="{{$category->id}}" class="js-tab">{{languageName($category->name)}}</a>
                @endforeach
            </div>
        </div>
        @foreach ($categoryhome as $category)
        <div class="product-list js-content-tab list-6 w-100" id="category-saleoff-{{$category->id}}">
            @foreach ($category->product as $product)
            @if ($product->discount > 0 && $product->discountStatus == 1)
                @include('layouts.product.item', ['product'=>$product])
            @endif
            @endforeach
        </div>
        @endforeach
        <div class="clearfix"></div>
        </div>
        <!--bg-white-->
        <div class="text-center">
        <a href="{{route('allProduct')}}" class="btn-viewmore">Xem thêm sản phẩm giá sốc <i class="fa fa-caret-down"></i> </a>
        </div>
        </div>
        <!--container-->
</section>