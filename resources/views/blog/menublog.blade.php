<div class="blog_left_base col-lg-3 col-12">
    <div class="position-sticky">
       <div class="aside-content aside-content-blog">
          <div class="title-head">
             Danh mục tin tức
          </div>
          <nav class="nav-category">
             <ul class="nav navbar-pills">
                <li class="nav-item  relative">
                   <a title="Trang chủ" class="nav-link" href="{{route('home')}}">Trang chủ</a>
                </li>
                <li class="nav-item  relative">
                   <a title="Giới thiệu" class="nav-link" href="{{route('aboutUs')}}">Giới thiệu</a>
                </li>
               
                <li class="nav-item  relative">
                   <a title="Sản phẩm" href="#" class="nav-link pr-5">Sản phẩm</a>
                   <i class="open_mnu down_icon"></i>
                   <ul class="menu_down" style="display:none;">
                      @foreach ($categoryProduct as $cate)
                      <li class="dropdown-submenu nav-item  relative">
                         <a title="Điện thoại" class="nav-link pr-5" href="{{route('allListProCate',['cate'=>$cate->slug])}}">{{languageName($cate->name)}}</a>
                         <i class="open_mnu down_icon"></i>
                         <ul class="menu_down" style="display:none;">
                            @foreach ($cate->typeCate as $type)
                            <li class="nav-item">
                               <a title="Samsung" class="nav-link pl-4" href="{{route('allListProType',['cate'=>$type->cate_slug,'type'=>$type->slug])}}">{{languageName($type->name)}}</a>
                            </li>
                            @endforeach
                       
                             
                            </li>
                         </ul>
                      </li>
                      @endforeach
                   </ul>
                </li>    
            
                <li class="nav-item active relative">
                   <a title="Tin tức" class="nav-link" href="{{'allListBlog'}}">Tin tức</a>
                </li>
                <li class="nav-item  relative">
                   <a title="Liên hệ" class="nav-link" href="#">Chính sách đổi trả</a>
                </li>
             </ul>
          </nav>
       </div>
       <script>
          $(".open_mnu").click(function(){
             $(this).toggleClass('cls_mn').next().slideToggle();
          });
       </script>	
       <div class="blog_noibat">
          <h2 class="h2_sidebar_blog">
             <a href="/tin-tuc" title="Tin tức nổi bật">Tin tức nổi bật</a>
          </h2>
          <div class="blog_content">
             @foreach ($news as $blognew)
             <div class="item clearfix">
                <div class="contentright">
                   <h3><a title="{{languageName($blognew->title)}}" href="{{route('detailBlog',['slug'=>$blognew->slug])}}">{{languageName($blognew->title)}}</a></h3>
                </div>
             </div>
             @endforeach
          
          </div>
       </div>
    </div>
 </div>