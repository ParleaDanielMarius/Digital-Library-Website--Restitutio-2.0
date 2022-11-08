@props(['item'])

<div class="product__inner overflow-hidden p-3 p-md-4d875">
    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
        <div class="col woocommerce-loop-product__thumbnail mb-3 mb-md-0 d-block" style='max-height: 250px; width:68px;'>
            <a href="{{route('items.show', $item->slug)}}"><img style='height: 100%;' src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto my-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid" alt="image-description"></a>
        </div>
        <div class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0 text-truncate">
            <div class="text-uppercase font-size-1 mb-1 text-truncate">
                <a class="text-primary">
                    @switch($item->type)
                        @case('Carte')
                        {{__('items')['book']}}
                        @break
                        @case('Carte Veche')
                        {{__('items')['old book']}}
                        @break
                        @case('Manuscris')
                        {{__('items')['manuscript']}}
                        @break
                        @case('Hartă')
                        {{__('items')['map']}}
                        @break
                        @case('Serial')
                        {{__('items')['serial']}}
                        @break
                        @case('Ex Libris')
                        {{__('items')['ex libris']}}
                        @break
                        @case('Fotografie')
                        {{__('items')['photograph']}}
                        @break
                        @case('Document')
                        {{__('items')['document']}}
                        @break
                        @case('Carte Poștală')
                        {{__('items')['postcard']}}
                        @break
                        @case('Other')
                        {{__('items')['other']}}
                        @break
                        @default {{$item->type}}
                    @endswitch
                </a>
            </div>
            <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark"><a href="{{route('items.show', $item->slug)}}" tabindex="0">{{$item->title}}</a></h2>
            @forelse($item->authors->take(3) as $author)
                <div class="font-size-2  mb-2 text-truncate"><a href="{{route('authors.show', $author->slug)}}" class="text-gray-700">{{$author->fullname}}</a></div>
            @empty
                <div class="font-size-2  mb-2 text-truncate"><a class="text-gray-700">Unknown</a></div>
            @endforelse
        </div>
    </div>
</div>
