<div class="sidebar">
    <div class="widget">
        <h5 class="widget_title">Recent Posts</h5>
        <ul class="recent_post border_bottom_dash list_none">
            @foreach ($blog as $item)
            <li>
                <div class="post_content">
                    <div class="post_img">
                        <a href="{{route('detailBlog',['slug'=>$item->slug])}}"><img src="{{url(''.$item->image)}}" alt="letest_post1"></a>
                    </div>
                    <div class="post_info">
                        <h6><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h6>
                        <p class="small m-0">{{date_format($item->created_at,'d-m-Y')}}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>