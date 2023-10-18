<nav id="navmobile">
    <ul id="menu-menu-primary-1" class="menu">
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2733"><a rel="nofollow" href="{{route('aboutUs')}}">Giới Thiệu</a></li>
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-132">
        <a href="{{route('allProduct')}}">Sản Phẩm</a>
        <ul class="sub-menu">
            @foreach ($categoryhome as $category)
            <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-120"><a rel="nofollow" href="{{route('allListProCate', ['danhmuc'=>$category->slug])}}">{{languageName($category->name)}}</a></li>
            @endforeach
        </ul>
    </li>
    @foreach ($servicehome as $service)
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5144"><a href="{{route('serviceDetail', ['slug'=>$service->slug])}}">{{$service->name}}</a></li>
    @endforeach
    <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-5063"><a rel="nofollow" href="{{route('allListBlog')}}">Tin tức</a></li>
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51"><a rel="nofollow" href="{{route('lienHe')}}">Liên hệ</a></li>
    </ul>
</nav>