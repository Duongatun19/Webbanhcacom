<div class="swiper-container">
    <div class="swipertab swiper-tab-top swiper_blog_two">
    <div class="swiper-wrapper">
        @foreach ($blogs as $blog)
            <div class="swiper-slide">
                <div class="item_blog_base">
                <a class="thumb" href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}">
                <img src="{{$blog->image}}" alt="{{languageName($blog->title)}}" class="lazy img-responsive" loading="lazy" />
                </a>
                <div class="content_blog clearfix">
                    <div class="time-post">
                        {{date('d/m/Y', strtotime($blog->created_at))}}
                    </div>
                    <h3><a href="{{route('detailBlog', ['slug'=>$blog->slug])}}" title="{{languageName($blog->title)}}" class="a-title">{{languageName($blog->title)}}</a></h3>
                    <p>
                        {{languageName($blog->description)}}
                    </p>
                </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</div>
<a class="view_all" href="{{route('listCateBlog', ['slug'=>$cate->slug])}}" title="Tất cả bài viết">
Tất cả bài viết
</a>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>