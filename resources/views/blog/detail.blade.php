@extends('layouts.main.master')
@section('title')
    {{ languageName($blog_detail->title) }}
@endsection
@section('description')
    {{ languageName($blog_detail->description) }}
@endsection
@section('image')
    {{ url('' . $blog_detail->image) }}
@endsection
@section('css')
<link href="{{asset('frontend/css/evo-article.scss.css')}}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
    <link rel="preload" as="script" href="{{ asset('frontend/js/main.js') }}" />
    <script src="{{ asset('frontend/js/main.js') }}" type="text/javascript"></script>

    <script src="{{ asset('frontend/js/jquery-toc.js') }}" type="text/javascript"></script>
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
                    <a itemprop="item" href="{{ route('allListBlog') }}" title="Tin tức">
                        <span itemprop="name">Tin tức Khuyến Mãi</span>
                        <meta itemprop="position" content="2" />
                    </a>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <strong itemprop="name">{{languageName($blog_detail->title)}}</strong>
                    <meta itemprop="position" content="3" />
                </li>

            </ul>
        </div>
    </section>
    <div class="container article-wraper margin-top-20 margin-bottom-20">
        <div class="row">
            <section class="right-content col-md-9">
               <h2>
                  {{languageName($blog_detail->title)}}
               </h2>
               {!!languageName($blog_detail->content)!!}
            </section>
            <aside class="evo-toc-sidebar evo-sidebar sidebar left-content col-md-3">
                <aside class="aside-item collection-category">
                    <div class="aside-title">
                        <h3 class="title-head margin-top-0">Danh mục</h3>
                    </div>
                    <div class="aside-content">
                     
                        <ul class="nav navbar-pills nav-category">
                           @foreach ($categoryProduct as $cate)
                              <li class="nav-item ">
                                 <a class="nav-link" href="{{route('allListProCate',['cate'=>$cate->slug])}}" title="{{languageName($cate->name)}}">{{languageName($cate->name)}}</a>
                              </li>
                           @endforeach
                        </ul>
                    </div>
                </aside>
                <aside class="aside-item top-news margin-top-20">
                    <div class="aside-title">
                        <h3 class="title-head margin-top-0"><a href="{{route(('allListBlog'))}}" title="Bài viết xem nhiều">Tin Mới Nhất</a></h3>
                    </div>
                    <ul class="listpost">
                     @foreach ($blogs as $item)
                        <li class="clearfix">
                           <div class="colu">
                              <a href="{{route('detailBlog',['slug'=>$item->slug])}}"
                                    title="{{languageName($item->title)}}"
                                    class="linktitle limit-text-2">{{languageName($item->title)}}</a>
                           </div>
                        </li>
                     @endforeach
                    </ul>
        </div>
    </div>
@endsection
