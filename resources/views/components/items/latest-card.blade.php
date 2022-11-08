@props(['item'])

<div class="col product">
    <div class="product__inner overflow-hidden p-3 p-md-4">
        <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
            <div class="woocommerce-loop-product__thumbnail mx-auto my-auto d-block" style="height: 150px">
                <a href="{{route('items.show', $item->slug)}}"><img style="height:100%" src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid mx-auto my-auto d-block attachment-shop_catalog size-shop_catalog wp-post-image" alt="image-description"></a>
            </div>
            <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
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
                <h2 class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark"><a href="{{route('items.show', $item->slug)}}">{{$item->title}}</a></h2>
                @forelse($item->authors->take(3) as $author)
                    <div class="font-size-2  mb-1 text-truncate"><a href="{{route('authors.show', $author->slug)}}" class="text-gray-700">{{$author->fullname}}</a></div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>
