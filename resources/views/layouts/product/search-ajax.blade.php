<ul class="dropdown-search-ajax" style="display:block;">
   @foreach ($result as $item)
   @php
       $img= json_decode($item['images']);
   @endphp
      <li class="li_search_ajax">
         <a href="{{route('detailProduct',['cate'=>$item->cate_slug,'slug'=>$item->slug])}}"><img src="{{$img[0]}}" alt="">{{languageName($item['name'])}}</a>
      </li>
   @endforeach
</ul>