@extends('layouts.main.master')
@section('title')
{{$title_page}} 
@endsection
@section('description')
{{$title_page}}
@endsection
@section('image')
{{url(''.$banners[0]->image)}}
@endsection
@section('css')
@endsection
@section('content')
<main id="main" class="">
    <div id="content" role="main" class="content-area">
    <div class="slider-wrapper relative" id="slider-660807427" >
        <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal"
            data-flickity-options='{
            "cellAlign": "center",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": false,
            "wrapAround": true,
            "autoPlay": 6000,
            "pauseAutoPlayOnHover" : true,
            "prevNextButtons": true,
            "contain" : true,
            "adaptiveHeight" : true,
            "dragThreshold" : 10,
            "percentPosition": true,
            "pageDots": true,
            "rightToLeft": false,
            "draggable": true,
            "selectedAttraction": 0.1,
            "parallax" : 0,
            "friction": 0.6        }'
            >
            <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_346565048">
                <div class="img-inner dark" >
                <img width="1440" height="410" src="https://deltagroup.vn/wp-content/uploads/2017/03/banner-qhdt.png" class="attachment-large size-large" alt="" loading="lazy" srcset="https://deltagroup.vn/wp-content/uploads/2017/03/banner-qhdt.png 1440w, https://deltagroup.vn/wp-content/uploads/2017/03/banner-qhdt-768x219.png 768w" sizes="(max-width: 1440px) 100vw, 1440px" />						
                </div>
                <style scope="scope">
                #image_346565048 {
                width: 100%;
                }
                </style>
            </div>
        </div>
        <div class="loading-spin dark large centered"></div>
        <style scope="scope">
        </style>
    </div>
    @foreach ($services as $service)
    <div class="row"  id="row-1968063528">
        <div class="col medium-3 small-12 large-3"  >
            <div class="col-inner"  >
                <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_330486320">
                <div class="img-inner dark" >
                    <img width="640" height="426" src="{{$service->image}}" alt="" loading="lazy" srcset="{{$service->image}} 640w, {{$service->image}} 300w" sizes="(max-width: 640px) 100vw, 640px" />						
                </div>
                <style scope="scope">
                    #image_330486320 {
                    width: 100%;
                    }
                </style>
                </div>
            </div>
        </div>
        <div class="col medium-9 small-12 large-9"  >
            <div class="col-inner"  >
                <h3 style="font-weight: 300; color: #173774; font-size: 2.1em;text-transform: capitalize;"><a href="{{route('serviceDetail', ['slug'=>$service->slug])}}">{{$service->name}}</a></h3>
                <p>{!!languageName($service->description)!!}</p>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</main>
@endsection