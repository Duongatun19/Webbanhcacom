@foreach ($list as $product)
@php
    $img = json_decode($product->images);
@endphp
<div class="col" >
    <div class="col-inner" >
        <a href="{{route('detailProduct', ['cate'=>$product->cate_slug, 'slug'=>$product->slug])}}" class="plain ">
        <div class="portfolio-box box has-hover box-shade dark">
            <div class="box-image" >
                <div class="image-cover" style="padding-top:100%;">
                    <img width="1200" height="671" src="{{$img[0]}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="{{$img[0]}} 1200w, {{$img[0]}} 768w" sizes="(max-width: 1200px) 100vw, 1200px" />                                
                    <div class="shade"></div>
                </div>
            </div>
            <div class="box-text text-center" >
                <div class="box-text-inner">
                    <h6 class="uppercase portfolio-box-title">{{languageName($product->name)}}</h6>
                    <p class="uppercase portfolio-box-category is-xsmall op-6">
                    <span class="show-on-hover">
                    {{languageName($product->cate->name)}}</span>
                    </p>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
@endforeach
{{$list->links()}}