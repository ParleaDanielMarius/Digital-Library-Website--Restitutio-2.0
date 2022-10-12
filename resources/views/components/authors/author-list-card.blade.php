@props(['author'])
<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
            <div class="text-uppercase font-size-1 mb-1 text-truncate"><a>{{__('authors')['items_count']}} {{$author->items_count}}</a></div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2"><a href="{{route('authors.show', $author->slug)}}" tabindex="0">{{$author->fullname}}</a></h2>
            <p class="font-size-2 mb-2 crop-text-2">{{$author->description}}</p>
        </div>
    </div>
</div>
