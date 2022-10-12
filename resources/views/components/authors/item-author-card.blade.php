@props(['item'])

<li class="product product__no-border col border-0 mb-2 mb-lg-0">
    <div class="product__inner overflow-hidden p-3 p-md-4d875 mx-1 bg-white" style="height: 300px">
        <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
            <div class="woocommerce-loop-product__thumbnail">
                <a href="{{route('items.show', $item->slug)}}" class="d-block"><img src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('assets/img/items/no-item-image.png')}}@endif" style="height: 150px" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image" alt="image-description"></a>
            </div>
            <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                <div class="text-uppercase font-size-1 mb-1 text-truncate"><a href="{{route('collections.show', ($item->collections->first())->slug)}}">{{($item->collections->first())->title}}</a></div>
                <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="{{route('items.show', $item->slug)}}">{{$item->title}}</a></h2>
                @forelse($item->authors->take(3) as $author)
                    <div class="font-size-2  mb-1 text-truncate"><a href="{{route('authors.show', $author->slug)}}" class="text-gray-700">{{$author->fullname}}</a></div>
                @empty
                    <div class="font-size-2  mb-1 text-truncate"><a class="text-gray-700">Unknown</a></div>
                @endforelse
            </div>

        </div>
    </div>
</li>
