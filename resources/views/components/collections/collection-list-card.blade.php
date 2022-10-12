@props(['collection'])
<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col woocommerce-loop-product__thumbnail mb-3 mb-md-0" style='max-height: 30%; max-width: 30%; display: table'>
            <a href="{{route('collections.show', $collection->slug)}}" class="d-block"><img style='height: 50%; width: 50%; object-fit: contain' src="@if($collection->cover_path && file_exists('storage' . '/' . $collection->cover_path)){{asset('storage/' . $collection->cover_path)}} @else{{asset('/assets/img/collections/no-collection-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <div class="text-uppercase font-size-1 mb-1 text-truncate"><a>{{__('collections')['items_count']}} {{$collection->items_count}}</a></div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2"><a href="{{route('collections.show', $collection->slug)}}" tabindex="0">{{$collection->title}}</a></h2>
            <p class="font-size-2 mb-2 crop-text-2">{{$collection->description}}</p>
        </div>
    </div>
</div>
