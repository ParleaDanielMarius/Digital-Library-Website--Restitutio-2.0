@props(['item', 'types'])

<div class="col product">
    <div class="product__inner overflow-hidden p-3 p-md-4">
        <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
            <div class="woocommerce-loop-product__thumbnail">
                <a href="{{route('items.show', $item->slug)}}" class="d-block"><img style="max-height: 150px ; max-width: 150px ; min-height: 150px ; min-width: 150px" src="@if($item->cover_path && file_exists('storage' . '/' . $item->cover_path)){{asset('storage/' . $item->cover_path)}} @else{{asset('/images/no-item-image.png')}}@endif" class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image" alt="image-description"></a>
            </div>
            <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                <div class="text-uppercase font-size-1 mb-1 text-truncate">
                    <a class="text-primary">
                        @switch($item->type)
                            @case('Book')
                            {{__('items')['book']}}
                            @break
                            @case('Old Book')
                            {{__('items')['old book']}}
                            @break
                            @case('Manuscript')
                            {{__('items')['manuscript']}}
                            @break
                            @case('Map')
                            {{__('items')['map']}}
                            @break
                            @case('Serial')
                            {{__('items')['serial']}}
                            @break
                            @case('ex libris')
                            {{__('items')['ex libris']}}
                            @break
                            @case('Photograph')
                            {{__('items')['photograph']}}
                            @break
                            @case('document')
                            {{__('items')['document']}}
                            @break
                            @case('postcard')
                            {{__('items')['postcard']}}
                            @break
                            @case('other')
                            {{__('items')['other']}}
                            @break
                            @default {{__('unknown')}}
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
