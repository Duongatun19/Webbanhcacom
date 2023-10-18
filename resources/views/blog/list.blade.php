@extends('layouts.main.master')
@section('title')
    {{ $title_page }}
@endsection
@section('description')
    {{ $title_page }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image) }}
@endsection
@section('css')
    <link href="{{ asset('frontend/css/evo-blogs.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
@endsection
@section('js')
@endsection
@section('content')
    <section class="bread-crumb margin-bottom-10">
        <div class="container">
            <ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="home" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="{{route('home')}}" title="Trang chủ">
                        <span itemprop="name">Trang chủ</span>
                        <meta itemprop="position" content="1" />
                    </a>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>


                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <strong itemprop="name">Tất cả tin tức</strong>
                    <meta itemprop="position" content="2" />
                </li>


            </ul>
        </div>
    </section>
    <div class="container margin-top-10" itemscope itemtype="http://schema.org/Blog">
        <meta itemprop="name" content="Tất cả tin tức">
        <meta itemprop="description" content="Chủ đề không có mô tả">
        <div class="row">
            <div class="col-md-12">
                <div class="evo-list-blog-page margin-top-30">
                    <h1 class="title-head hidden">Tất cả tin tức</h1>


                    <section class="list-blogs blog-main">
                        <div class="row">
                        @foreach ($blogs as $blog)
                           <div class="col-md-4 col-sm-6 col-xs-12 clearfix">
                              <article class="blog-item">
                                 <div class="blog-item-thumbnail">
                                       <a href="{{route('detailBlog',['slug' => $blog->slug])}}"
                                          title="{{languageName($blog->title)}}">

                                          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                             data-src="{{$blog->image}}"
                                             alt="{{languageName($blog->title)}}"
                                             class="lazy img-responsive center-block" />

                                       </a>
                                 </div>
                                 <div class="blog-item-mains">
                                       <div class="post-time">{{$blog->updated_at->format('d/m/Y')}}</div>
                                       <h3 class="blog-item-name limit-text-2"><a
                                             href="{{route('detailBlog',['slug'=>$blog->slug])}}"
                                             title="{{languageName($blog->title)}}">{{languageName($blog->title)}}</a></h3>
                                       <p class="blog-item-summary margin-bottom-5 limit-text-5">{!!languageName($blog->description)!!}</p>
                                 </div>
                              </article>
                           </div>
                        @endforeach
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </div>
@endsection
