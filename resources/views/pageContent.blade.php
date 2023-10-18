@extends('layouts.main.master')
@section('title')
{{$pagecontentdetail->title}}
@endsection
@section('description')
{{$pagecontentdetail->title}}
@endsection
@section('image')
{{url(''.$banners[0]->image)}}
@endsection
@section('css')
<style>
   .banner-page .content-banner-page h1 {
      position: relative;
      display: inline;
      padding-bottom: 6px;
      text-transform: uppercase;
      font-size: 24px;
      font-weight: 600;
      color: #314e4e;
   }
   .banner-page .content-banner-page h1:after {
      content: '';
      position: absolute;
      width: 100%;
      height: 2px;
      background: #314e4e;
      bottom: 0;
      left: 0;
   }
</style>
@endsection
@section('js')
@endsection
@section('content')
<main class="main">
   <div class="banner-page mt-3">
      <div class="content-banner-page text-center">
         <h1>{{$pagecontentdetail->title}}</h1>
      </div>
   </div>
   <div class="container mt-5">
      <div class="row">
         <div class="col col-lg-12">
            <article class="single-article bg-sm-white pd-sm-30">
               <div class="css-content">
                  {!!$pagecontentdetail->content!!}
               </div>
            </article>
         </div>
      </div>
   </div>
</main>
@endsection